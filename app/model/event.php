<?php
namespace app\model;
use myclass\Val;


class event extends basis {

	public function allWithUsers($id = 0) {
		if($id == 0) {
		return $this->db->query("SELECT * FROM event 
     		JOIN user ON user.userId = event.created_by;")->fetch_all(MYSQLI_ASSOC);
		} else {
			return $this->db->query("SELECT * FROM user 
     		JOIN user_has_event ON user_has_event.user_id = user.userId
     		JOIN event ON eventId = user_has_event.event_id WHERE eventId = '$id';")->fetch_all(MYSQLI_ASSOC);
		}

	}

	public function own($id) {
		$result = $this->db->query("SELECT * FROM event WHERE created_by = '$id';")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function joined($id) {
		$result = $this->db->query("SELECT * FROM event
			JOIN user_has_event ON user_has_event.event_id = event.eventId
			JOIN user ON userId = user_has_event.user_id WHERE user_id = '$id';")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function take($user_id,$event_id) {
		$this->db->query("UPDATE event SET `created_by` = '$user_id' WHERE `eventId` = '$event_id';");
	}

	public function store($user_id = null, $event = null) {
		$error = [];

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$name = $f_name;
		$description = $f_description;
		$date = $f_date;
		$start = $f_start;
		$end = $f_end;
		$size = $f_size;
		$category = $f_category;
		$level = $f_level;
		$location = $f_location;

		if(!Val::name($name)) {
			$error['name'] = "Name cannot be empty!";
		}
		if(!Val::date($date)) {
			$error['date'] = "Date format is not correct!";
		}
		if(!Val::name($size) || !is_numeric($size)) {
			$error['size'] = "Size must be a number!";
		}
		
		// Check if selected category is present in category table
		$c_names = $this->db->query("SELECT name FROM category;")->fetch_all(MYSQLI_ASSOC);
		foreach($c_names as $c_name) {
			if($location != $c_name) {
			$error['category'] = "Undefined category!";
			}	
		}
		if(!is_numeric($level)) {
			$error['level'] = "Undefined level!";
		}
		
		// Check if selected location is present in location table
		$l_names = $this->db->query("SELECT name FROM location;")->fetch_all(MYSQLI_ASSOC);
		foreach($l_names as $l_name) {
			if($location != $l_name) {
			$error['location'] = "Undefined location!";
			}	
		}
		
	
		if(!$error && $event == null) {
			// Save event details
			$this->db->query("INSERT INTO event (`name`, `description`, `date`, `start`, `end`, `size`, `location_idlocation`, `category_id`, `level`, `created_by`) VALUES ('$name', '$description', '$date', '$start', '$end', '$size', '$location', '$category', '$level', '$user_id');");

			// Last inserted id
			$event_id = $this->db->insert_id;

			// Save user_id to the created event
			$result = $this->db->query("INSERT INTO user_has_event (user_id, event_id) VALUES ('$user_id','$event_id');");
		
		} elseif (!$error && $event != null) {
			$this->db->query("UPDATE event SET `name` = '$name', `description` = '$description', `date` = '$date', `start` = '$start', `end` = '$end', `size` = '$size', `location_idlocation` = '$location', `category_id` = '$category', `level` = '$level' WHERE `eventId` = '$event';");
		} else {
			return $error;
		}
	}

	public function join($user_id,$event_id) {
		$result = $this->db->query("INSERT INTO user_has_event (user_id, event_id) VALUES ('$user_id','$event_id');");	
	}

	public function leave($user_id,$event_id) {
		$result = $this->db->query("DELETE FROM user_has_event WHERE user_id = '$user_id' AND event_id = '$event_id';");
	
	}

	public function userHasEvent($user) {
		return $this->db->query("SELECT event_id FROM user_has_event WHERE user_id = '$user';")->fetch_all(MYSQLI_ASSOC);
	}

}