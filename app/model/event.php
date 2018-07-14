<?php
namespace app\model;
use myclass\Val;


class event extends basis {

	public function allWithUsers() {
		return $this->db->query("SELECT * FROM event 
     		JOIN user_has_event ON user_has_event.event_id = event.id
     		JOIN user ON user.id = user_has_event.user_id;")->fetch_all(MYSQLI_ASSOC);
	}

	public function store($user_id) {
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
		if(!is_numeric($category)) {
			$error['category'] = "Undefined category!";
		}
		if(!is_numeric($level)) {
			$error['level'] = "Undefined level!";
		}
		if(!is_numeric($location)) {
			$error['location'] = "Undefined location!";
		}
	
		if(!$error) {
			// Save event details
			$this->db->query("INSERT INTO event (`name`, `description`, `date`, `start`, `end`, `size`, `location_idlocation`, `category_id`, `level_id`) VALUES ('$name', '$description', '$date', '$start', '$end', '$size', '$location', '$category', '$level');");

			// Last inserted id
			$event_id = $this->db->insert_id;

			// Save user_id to the created event
			$result = $this->db->query("INSERT INTO user_has_event (user_id, event_id) VALUES ('$user_id','$event_id');");
		
		} else {
			return $error;
		}
	}

}