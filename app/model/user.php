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

	public function store() {
		
		//$invalid = "is-invalid";

		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$first_name = $f_first_name;
		$last_name = $f_last_name;
		$email = $f_email;
		$birthday = $f_birthday;
		    
	    if( Val::valName($f_first_name) && Val::valName($f_last_name) ) {

	    	if(!Val::valEmailValid($f_email)) {
	    		$this->error['email'] = "Email is not valid!";
	    	}
	    	if(!Val::valEmailExist($f_email)) {
	    		$this->error['email'] = "Email exists already!";
	    	}
	    	if(!Val::valPassword($f_password)) {
	    		$this->error['password'] = "Password must be at least 6 characters!";
	    	} else {
	    		$f_password = password_hash($f_password, PASSWORD_BCRYPT);	
	    	}
	    	if(!Val::valDate($f_birthday)) {
	    		$this->error['birthday'] = "Date is not valid!";
	    	}
	    }

	    if(!$this->error) {

            // R::exec("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");

			$this->db->query("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
	    } else {
	    	return $this->error;
	    }
		
	} 

}