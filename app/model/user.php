<?php

namespace app\model;
use myclass\Val;

class user {

	private $error = [];
	private $db;
	
	public function __construct() {
		return $this->connect();
	}

	public function connect() {
		$this->db = new \mysqli('localhost', 'root', '', 'mydb');
	}

	public function all() {
		$result = $this->db->query('SELECT * FROM user')->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function show($id) {
		$result = $this->db->query("SELECT * FROM user WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function showRow($id) {
		$result = $this->db->query("SELECT * FROM user WHERE id = '$id'")->fetch_row();
		return $result;
	}

	public function store($id = null) {
		
		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$first_name = $f_first_name;
		$last_name = $f_last_name;
		$email = $f_email;
		$birthday = $f_birthday;
		$password = $f_password;
		
		// Takes the user's password from database to compare it when updates details 	
		$pass = $this->db->query("SELECT password FROM user WHERE id = '$id'")->fetch_row();

		// Validations for register and update user details.
		// $id=0 => register user
		// $id!=0 => update user
	    if( Val::valName($f_first_name) && Val::valName($f_last_name) ) {

	    	if(!Val::valEmailValid($f_email)) {
	    		$this->error['email'] = "Email is not valid!";
	    	}
	    	if(($id == null) && !Val::valEmailExist($f_email)) {
	    		$this->error['email'] = "Email exists already!";
	    	}
	    	if(!Val::valPassword($f_password)) {
	    		$this->error['password'] = "Password must be at least 6 characters!";
	    	} elseif (($id != 0) && !empty($f_password_new) && !Val::valPassword($f_password_new)) {
	    		$this->error['password_new'] = "Password must be at least 6 characters!";
	    	} elseif (($id == 0) && ($f_password != $f_password2)) {
	    		$this->error['password2'] = "Passwords do not match, please retype!";
	    	} elseif ($id != 0 && !password_verify($f_password, $pass[0])) {
	    		$this->error['password'] = "Password is not correct, please try again!";
	    	} else {
	    		$f_password = password_hash($f_password, PASSWORD_BCRYPT);
	    		if(($id != 0) && !empty($f_password_new)) {
	    			$f_password_new = password_hash($f_password_new, PASSWORD_BCRYPT);
	    		}
	    	}
	    	if(!Val::valDate($f_birthday)) {
	    		$this->error['birthday'] = "Date is not valid!";
	    	}
	    }

	    // If there is no error, then run database queries
	    if(!$this->error) {

            // R::exec("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
	    	if ($id == null) {
				$this->db->query("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
			} elseif (($id != null) && !empty($f_password_new)) {
				$this->db->query("UPDATE user SET first_name = '$f_first_name', last_name = '$f_last_name', email = '$f_email', password = '$f_password_new', birthday = '$f_birthday' WHERE id = '$id';");	
			} else {
				$this->db->query("UPDATE user SET first_name = '$f_first_name', last_name = '$f_last_name', email = '$f_email', password = '$f_password', birthday = '$f_birthday' WHERE id = '$id';");	
			}
	    } else {
	    	return $this->error;
	    }
		
	} 

	public function delete($id) {
		$result = $this->db->query("DELETE FROM user WHERE id = '$id'");
		if (!$result) {
			return mysqli_error($this->db);	
		} else {
			return false;
		}
	}


}