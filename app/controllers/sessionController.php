<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\basis;
use app\lib\session;

class sessionController {
	private $user;
	private $basis;


	public function __construct() {
		$this->user = new user;
		$this->basis = new basis;
	}

	public function login() {
		
		$view = new view('users/login');
	}

	public function loginuser() {
		// Model
		$data = $this->user->login();

		if(!$data) {
			$objSess = session::inst();
			$objSess = session::setLogin();
			$login = "You have logged in!";
			$view = new view('home');
			$view->assign('login',$login);
		} else {
			$view = new view('users/login');
			$view->assign('error', $data);
		}

		
	}

	public function logout() {
		$objSess = session::inst();
		$objSess = session::logout();
		$logout = "You have logged out!";

		$view = new view('home');
		$view->assign('logout',$logout);
	}


}