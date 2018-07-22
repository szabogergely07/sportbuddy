<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\basis;
use app\lib\session;

class basisController {

 	public function __construct() {
 	
	 	$objSess = session::inst();
		
		// set SESSION variables for unauthorized users
		if(isset($_SESSION['admin'])) {
			return $_SESSION['admin'];
		} else {
			$_SESSION['admin'] = null;
		}

		if(isset($_SESSION['user_id'])) {
			return $_SESSION['user_id'];
		} else {
			$_SESSION['user_id'] = null;
		}
 	}



}