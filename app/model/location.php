<?php
namespace app\model;
use myclass\Val;


class location extends basis {

	public function store($location = null) {
		$error = [];

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$name = mysqli_real_escape_string($this->db, $f_name);
		

		if(!Val::name($name)) {
			$error['name'] = "Name cannot be empty!";
		}
	
		if(!$error && $location == null) {
			// Save event details
			$this->db->query("INSERT INTO location (`name`) VALUES ('$name');");
		
		} elseif (!$error && $location != null) {
			$this->db->query("UPDATE location SET `name` = '$name' WHERE `locationId` = '$location';");
		} else {
			return $error;
		}
	}


}