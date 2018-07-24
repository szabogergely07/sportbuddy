<?php
namespace app\model;

class basis {
	protected $db;
	protected $reg;
	
	public function __construct() {
		$this->register();
		$this->connect();
	}

	public function connect() {
		$this->db = new \mysqli($this->reg->dbhost, $this->reg->dbuser, $this->reg->dbpass, $this->reg->dbname);
	}

	protected function register(){
        $this->reg = \app\lib\config::inst();
    }


	public function all($table) {
		$result = $this->db->query("SELECT * FROM $table")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function show($id,$table) {
		$result = $this->db->query("SELECT * FROM $table WHERE ".$table."Id = '$id'")->fetch_object();
		if(!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	public function delete($id,$table) {
		$result = $this->db->query("DELETE FROM $table WHERE ".$table."Id = '$id'");
		if (!$result) {
			return mysqli_error($this->db);	
		} else {
			return false;
		}
	}
}