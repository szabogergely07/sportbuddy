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
		token();
		$view = new view('users/register');
	}

	public function store() {
		if(tokenValid()) {
			//Model
	     	$data = $this->user->store();
			
			//View
			if($data) {
				$view = new view('users/register');
				$view->assign('data', $data);
			} else {
				$result = "success";
				$register = "You have registered successfully! Please check your emails and confirm your registration!";
				$view = new view('home');
				$view->assign('notice', $register);
				$view->assign('success', $result);
		    }
		}
	}

	public function login() {
		token();
		$view = new view('users/login');
	}

	public function loginuser() {
		if(tokenValid()) {

			// Model
			$data = $this->user->login();

			if($data != false) {

				$objSess = session::setLogin();
				$login = "You have logged in!";
				 
				$_SESSION['user_id'] = $data[0];
				$_SESSION['user_name'] = $data[1];
				$_SESSION['admin'] = $data[2];

				$view = new view('home_in');
				$view->assign('notice',$login);
				
			} else {
				$error = "Email or password is not correct, try again!";
				$view = new view('users/login');
				$view->assign('error', $error);
			}
		} else {
			$view = new view('403');
		}
	}

	public function logout() {
		
		$objSess = session::logout();
		$logout = "You have logged out!";
		
		$view = new view('home');
		$view->assign('notice',$logout);

	}


}