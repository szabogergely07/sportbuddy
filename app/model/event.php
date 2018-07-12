<?php
namespace app\model;


class event extends basis {

	public function allWithUsers() {
		return $this->db->query("SELECT * FROM event 
     		JOIN user_has_event ON user_has_event.event_id = event.id
     		JOIN user ON user.id = user_has_event.user_id;")->fetch_all(MYSQLI_ASSOC);
	}

	public function store($id = null) {

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
	

		$this->db->query("INSERT INTO event (`name`, `description`, `date`, `start`, `end`, `size`, `location_idlocation`, `category_id`, `level_id`) VALUES ('$name', '$description', '$date', '$start', '$end', '$size', '$location', '$category', '$level');");

		// Last inserted id
		$event_id = $this->db->insert_id;

		$user = intval(implode($_SESSION['user_id']));

		// Query with manual user_id, has to be changed when session is ready
		$result = $this->db->query("INSERT INTO user_has_event (user_id, event_id) VALUES ('$user','$event_id');");
		

	}

}