<?php
namespace app\model;

class basis {
	protected $db;
	
	public function __construct() {
		return $this->connect();
	}

	public function connect() {
		$this->db = new \mysqli('localhost', 'root', '', 'mydb');
	}


	public function all($table) {
		$result = $this->db->query("SELECT * FROM $table")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function show($id,$table) {
		$result = $this->db->query("SELECT * FROM $table WHERE id = '$id'")->fetch_object();
		return $result;
	}

	public function delete($id,$table) {
		$result = $this->db->query("DELETE FROM $table WHERE id = '$id'");
		if (!$result) {
			return mysqli_error($this->db);	
		} else {
			return false;
		}
	}
}