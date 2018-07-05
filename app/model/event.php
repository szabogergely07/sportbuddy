<?php
namespace app\model;

class event {

	// public function __construct() {
	// 	parent::__construct();
	// }
	private $db;
	
	public function __construct() {
		return $this->connect();
	}

	public function connect() {
		$this->db = new \mysqli('localhost', 'root', '', 'mydb');
	}

	public function all($table) {
		return $this->basisAll($table);
	}

	public function allWithUsers() {
		return $this->db->query("SELECT name, description, date, start, size, first_name FROM event 
     		JOIN user_has_event ON user_has_event.event_id = event.id
     		JOIN user ON user.id = user_has_event.user_id;")->fetch_all(MYSQLI_ASSOC);
	}

}