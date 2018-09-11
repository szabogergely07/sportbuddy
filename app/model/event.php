<?php
namespace app\model;
use myclass\Val;


class event extends basis {

	public function allWithUsers($id = 0) {
		
		// Events index page
		if($id == 0) {
		return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		left JOIN category ON category.name = event.category_id
     		WHERE `date` >= CURRENT_DATE();")->fetch_all(MYSQLI_ASSOC);
		
		// Event show page joined users
		} else {
			return $this->db->query("SELECT * FROM user 
     		JOIN user_has_event ON user_has_event.user_id = user.userId
     		JOIN event ON eventId = user_has_event.event_id WHERE eventId = '$id';")->fetch_all(MYSQLI_ASSOC);
		}

	}

	public function own($id) {
		$result = $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event
			JOIN user ON user.userId = event.created_by WHERE created_by = '$id' AND `date` >= CURRENT_DATE();")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function joined($id) {
		$result = $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event
			JOIN user_has_event ON user_has_event.event_id = event.eventId
			JOIN user ON user.userId = event.created_by WHERE user_id = '$id' AND `date` >= CURRENT_DATE();")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	// Past events only for admin
	public function pastEvents() {
		return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		left JOIN category ON category.name = event.category_id
     		WHERE `date` <= CURRENT_DATE();")->fetch_all(MYSQLI_ASSOC);
	}

	public function take($user_id,$event_id) {
		$this->db->query("UPDATE event SET `created_by` = '$user_id' WHERE `eventId` = '$event_id';");
	}

	public function showDetails($event_id) {
		
		// Only admin can see past events
		if ($_SESSION['admin'] != 2) {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		WHERE eventId = '$event_id' AND `date` >= CURRENT_DATE();")->fetch_object();
		} else {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		WHERE eventId = '$event_id';")->fetch_object();
		}

	}

	public function store($user_id = null, $event = null) {
		$error = [];

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$name = mysqli_real_escape_string($this->db, $f_name);
		$description = mysqli_real_escape_string($this->db, $f_description);
		$date = $f_date;
		$start = $f_start;
		$end = $f_end;
		$size = $f_size;
		$category = $f_category;
		$level = $f_level;
		$location = $f_location;
		$lat = $f_lat;
		$lng = $f_lng;

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
		$cat = [];
		foreach($c_names as $c_name) {
			if(in_array($category,$c_name)) {
				$cat[] = 1; 
			}
		}
		if(empty($cat)) {
			$error['category'] = "Undefined category!";
		}
		
		if(!is_numeric($level)) {
			$error['level'] = "Undefined level!";
		}
		
		// Check if selected location is present in location table
		$l_names = $this->db->query("SELECT name FROM location;")->fetch_all(MYSQLI_ASSOC);
		$loc = [];
		foreach($l_names as $l_name) {
			if(in_array($location,$l_name)) {
				$loc[] = 1;
			}	
		}
		if(empty($loc)) {
			$error['location'] = "Undefined location!";
		}
	
		// Create new event if there is no error and no eventid
		if(!$error && $event == null) {
			// Save event details
			$this->db->query("INSERT INTO event (`name`, `description`, `date`, `start`, `end`, `size`, `location_idlocation`, `category_id`, `level`, `created_by`, `lat`, `lng`) VALUES ('$name', '$description', '$date', '$start', '$end', '$size', '$location', '$category', '$level', '$user_id', '$lat', '$lng');");

			// Last inserted id
			$event_id = $this->db->insert_id;

			// Save user_id to the created event
			$result = $this->db->query("INSERT INTO user_has_event (user_id, event_id) VALUES ('$user_id','$event_id');");
		
		// Update an event if there is no error
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

	// Get all comments for the event with the user created the comment
	public function commentByUser($id) {
		return $this->db->query("SELECT *, comment.created_at AS created FROM comment
			JOIN user ON comment.user_iduser = user.userId
			WHERE event_id = '$id';")->fetch_all(MYSQLI_ASSOC);
	}

	public function search() {

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$location = $f_location;
		$category = $f_category;
		$level = $f_level;
		
		// Results when all set
		if($location != 'All' && $category != 'All' && $level != '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE location.name = '$location' AND category.name = '$category' AND level = '$level' 
     		 ;")->fetch_all(MYSQLI_ASSOC);

		// Results when nothing set (show all)
		} elseif($location == 'All' && $category == 'All' && $level == '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		 ;")->fetch_all(MYSQLI_ASSOC);

		// Results when only level is not set
     	} elseif($category != 'All' && $location != 'All' && $level == '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE location.name = '$location' AND category.name = '$category' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		

		// Results when only category is not set
     	} elseif($category == 'All' && $location != 'All' && $level != '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE location.name = '$location' AND level = '$level' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		

		// Results when only location is not set
     	} elseif($category != 'All' && $location == 'All' && $level != '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE category.name = '$category' AND level = '$level' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		

		// Results when only location is set
     	} elseif($category == 'All' && $location != 'All' && $level == '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE location.name = '$location' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		

		// Results when only category is set
     	} elseif($category != 'All' && $location == 'All' && $level == '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE category.name = '$category' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		

		// Results when only level is set
     	} elseif($category == 'All' && $location == 'All' && $level != '1') {
			return $this->db->query("SELECT *, event.name AS event_name, event.created_at AS created FROM event 
     		JOIN user ON user.userId = event.created_by
     		JOIN location ON location.name = event.location_idlocation
     		JOIN category ON category.name = event.category_id
     		WHERE level = '$level' 
     		 ;")->fetch_all(MYSQLI_ASSOC);
		}
	}
	

	public function gmaps() {
		$data = $_POST['data'];
		$result = $this->db->query("SELECT lat, lng FROM event WHERE eventId = '$data';")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

}