<?php
namespace app\model;
use myclass\Val;


class category extends basis {

	public function store($category = null) {
		$error = [];

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$name = mysqli_real_escape_string($this->db, $f_name);
		

		if(!Val::name($name)) {
			$error['name'] = "Name cannot be empty!";
		}
	
		if(!$error && $category == null) {
			// Save event details
			$this->db->query("INSERT INTO category (`name`) VALUES ('$name');");
		
		} elseif (!$error && $category != null) {
			$this->db->query("UPDATE category SET `name` = '$name' WHERE `categoryId` = '$category';");
		} else {
			return $error;
		}
	}


}