<?php

namespace app\controllers;
use app\view\view;
use app\model\user;

class userController {

	public function index() {
		
		$conn = new user;
		$names = $conn->all();
		
		$view = new view('users/users');
		$view->assign('names', $names);
	}

	public function register() {
		
		$view = new view('users/register');
	}

	public function store() {
		
		// $error = [];
		// $error['name'] = "It cannot be empty!";
		// $error['email'] = "";
		// $error['date'] = "Date is not valid";
		// $error['password'] = "Password must be at least 6 characters";

		// $invalid = "is-invalid";

		// extract($_REQUEST, EXTR_PREFIX_ALL, "f");

		// @$first_name = $f_first_name;
		// @$last_name = $f_last_name;
		// @$email = $f_email;
		// @$birthday = $f_birthday;


		// if (isset($f_submit)) {
		    
		//     if( Val::valName($f_first_name) && Val::valName($f_last_name) && Val::valEmailValid($f_email) && Val::valEmailExist($f_email) && Val::valName($f_password) && Val::valDate($f_birthday) ) {


		//             $f_password = password_hash($f_password, PASSWORD_BCRYPT);
		//             // R::exec("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");

		             $conn = new user;
		             $data = $conn->store();
		        if($data) {
		        	$view = new view('users/register');
		        	$view->assign('data', $data);
		    	} else {
		    		$success = "You have registered successfully!";
		    		$view = new view('index');
		    		$view->assign('success', $success);
		        }

		//     } elseif( !Val::valEmailValid($f_email) ) {
		//         $error['email'] = "Email is not valid!";
		//     } elseif( !Val::valEmailExist($f_email) ) {
		//         $error['email'] = "Email exists already!";
		//     }
		// } else {
		//     $error = null;
		//     $invalid = null;
		// }
					
		        	
			}

	public function show($id) {

		$db = new \mysqli('localhost', 'root', '', 'mydb');
        	$sql = $db->query("SELECT * from user WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
        	$view = new view('users/show');
			$view->assign('sql', $sql);
        //	$db->close();
	}
	

	public function delete() {
		
		$view = new view('r');
	}

	public function update() {
		
		$view = new view('r');
	}
}