<?php
namespace app\model;

class basis {
	private $db;
	
	public function __construct() {
		return $this->connect();
	}

	public function connect() {
		$this->db = new \mysqli('localhost', 'root', '', 'mydb');
	}


	public function basisAll($table) {
		$result = $this->db->query("SELECT * FROM $table")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

}