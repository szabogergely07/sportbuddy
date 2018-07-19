<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\basis;
use app\lib\session;

class sessionController extends basisController {
	private $user;
	private $basis;


	public function __construct() {
		parent::__construct();
		$this->user = new user;
		$this->basis = new basis;
	}

	public function register() {
		
		$view = new view('users/register');
	}

	public function store() {
		//Model
     	$data = $this->user->store();
		
		//View
		if($data) {
			$view = new view('users/register');
			$view->assign('data', $data);
		} else {
			$result = "success";
			$register = "You have registered successfully!";
			$view = new view('home');
			$view->assign('notice', $register);
			$view->assign('success', $result);
	    }
	}

	public function login() {
		
		$view = new view('users/login');
	}

	public function loginuser() {
		// Model
		$data = $this->user->login();

		if($data != false) {

			$objSess = session::setLogin();
			$login = "You have logged in!";
			 
			$_SESSION['user_id'] = $data[0];
			$_SESSION['user_name'] = $data[1];
			$_SESSION['admin'] = $data[2];

			$view = new view('home');
			$view->assign('notice',$login);
			
		} else {
			$error = "Email or password is not correct, try again!";
			$view = new view('users/login');
			$view->assign('error', $error);
		}
	}

	public function logout() {
		
		$objSess = session::logout();
		$logout = "You have logged out!";
		
		$view = new view('home');
		$view->assign('notice',$logout);

	}


}