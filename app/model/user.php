<?php

namespace app\model;

use app\model\mailer;
use myclass\Val;

class user extends basis {

	public $confirm_id;

	private $error = [];

	public function __construct() {
		parent::__construct();
		$this->confirm_id = bin2hex(openssl_random_pseudo_bytes(16));
	}


	// Stores or updates user details
	// $id=0 => register user
	// $id!=0 => update user
	public function store($id = null) {
		
		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$first_name = mysqli_real_escape_string($this->db, $f_first_name);
		$last_name = mysqli_real_escape_string($this->db, $f_last_name);
		$email = mysqli_real_escape_string($this->db, $f_email);
		$birthday = $f_birthday;
		$password = mysqli_real_escape_string($this->db, $f_password);
		
		// Takes the user's password from database to compare it when updates details 	
		$pass = $this->db->query("SELECT password FROM user WHERE userId = '$id'")->fetch_row();

		$result = $this->db->query("SELECT email from user WHERE email = '$email'")->fetch_all();

		// Validations for register and update user details.
	    if( Val::name($f_first_name) && Val::name($f_last_name) ) {

	    	if(!Val::emailValid($f_email)) {
	    		$this->error['email'] = "Email is not valid!";
	    	}
	    	if(($id == null) && !Val::emailExist($result)) {
	    		$this->error['email'] = "Email exists already!";
	    	}
	    	// Not Admin password
	    	if($_SESSION['admin'] != 2 || ($_SESSION['admin'] == 2 && $_SESSION['user_id'] == $id) ) {
		    	if(!Val::password($f_password)) {
		    		$this->error['password'] = "Password must be at least 6 characters!";
		    	} elseif (($id != 0) && !empty($f_password_new) && !Val::password($f_password_new)) {
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
	    	} else {
	    		if(!empty($f_password) && !Val::password($f_password)) {
		    		$this->error['password'] = "Password must be at least 6 characters!";
		    	} elseif (!empty($f_password_new) && !Val::password($f_password_new)) {
		    		$this->error['password_new'] = "Password must be at least 6 characters!";
		    	} elseif ($f_password != $f_password_new) {
		    		$this->error['password'] = "Passwords do not match, please retype!";
		    	} else {
		    		$f_password_new = password_hash($f_password_new, PASSWORD_BCRYPT);
		    	}
	    	}
	    	if(!Val::date($f_birthday)) {
	    		$this->error['birthday'] = "Date is not valid!";
	    	}
	    }

	    // If there is no error, then run database queries
	    if(!$this->error) {

	    	if ($id == null) {
				$this->db->query("INSERT INTO user (first_name, last_name, email, password, birthday, confirm_id) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday', '$this->confirm_id');");


	// Send a welcome email after registration
	$name = $f_first_name.' '.$f_last_name;
    $subject = 'Hi '.$name.'! Welcome to SportBuddy!';
    
    $body = 'Thank you for registering on SportBuddy! Please click to confirm your registration: <a href="https://gergely-szabo.000webhostapp.com/sportbuddy/confirm/'.$this->confirm_id.'">CONFIRM</a>';

	$mail = new mailer($f_email, $name, $subject, $body);
    





			} elseif (($id != null) && !empty($f_password_new)) {
				$this->db->query("UPDATE user SET first_name = '$f_first_name', last_name = '$f_last_name', email = '$f_email', password = '$f_password_new', birthday = '$f_birthday' WHERE userId = '$id';");	
			} else {
				$this->db->query("UPDATE user SET first_name = '$f_first_name', last_name = '$f_last_name', email = '$f_email', password = '$f_password', birthday = '$f_birthday' WHERE userId = '$id';");	
			}
	    } else {
	    	return $this->error;
	    }
		
	} 

	public function confirm($confirmed) {
		$result = $this->db->query("SELECT confirm_id FROM user WHERE confirm_id = '$confirmed'")->fetch_row();

		if(!empty($result)) {
			$this->db->query("UPDATE user SET is_confirmed = '1' WHERE confirm_id = '$confirmed';");
			return true;
		} else {
			return false;
		}
	}

	public function login() {
		extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		$email = mysqli_real_escape_string($this->db, $f_email);
		$password = mysqli_real_escape_string($this->db, $f_password);

		$exist = $this->db->query("SELECT email FROM user WHERE email = '$email'")->fetch_row();

		$pass = $this->db->query("SELECT password FROM user WHERE email = '$email'")->fetch_row();

		$result = $this->db->query("SELECT userId, first_name, is_admin FROM user WHERE email = '$email'")->fetch_row();

		$confirmed = $this->db->query("SELECT is_confirmed FROM user WHERE email = '$email'")->fetch_row();

		if ($confirmed[0] != '1' || empty($exist) || !password_verify($password, $pass[0])) {
			return false;
		} else {
			return $result;
		}
			
	}

	public function deleteOwn($id) {
		$result = $this->db->query("DELETE FROM user WHERE userId = '$id'");
		if (!$result) {
			return mysqli_error($this->db);	
		} else {
			return false;
		}
	}

}