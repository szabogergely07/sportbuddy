<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\basis;

class userController {
	private $user;
	private $basis;

	public function __construct() {
		$this->user = new user;
		$this->basis = new basis;
	}

	public function index() {
		//Model
		$names = $this->basis->all('user');
		
		//View
		$view = new view('users/users');
		$view->assign('names', $names);
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
			$notice = "success";
			$success = "You have registered successfully!";
			$view = new view('home');
			$view->assign('success', $success);
			$view->assign('notice', $notice);
	    }
	}

	public function show($id) {
		//Model
		$user = $this->basis->show($id,'user');

		//View
    	$view = new view('users/show');
		$view->assign('user', $user);
	}
	
	public function updateIndex($id) {
		//Model
		$user = $this->basis->show($id,'user');

		// View
		$view = new view('users/update');
		$view->assign('user', $user);
	}

	public function update($id) {
		//Model
     	$data = $this->user->store($id);
		$names = $this->basis->all('user');

		//View if there is error
		if($data) {
			$user = $this->basis->show($id,'user');

			$view = new view('users/update');
			$view->assign('user', $user);
			$view->assign('data', $data);
		// View if there is no error
		} else {
			$success = "You have updated successfully!";
			$notice = "success";
			$view = new view('users/users');
			$view->assign('success', $success);
			$view->assign('names', $names);
			$view->assign('notice', $notice);
	    }
		
	}

	public function delete($id) {
		//Model
     	$user = $this->basis->show($id,'user');
     	$data = $this->basis->delete($id,'user');
     	$names = $this->basis->all('user');

		// View 
		if (!$data) {
			$success = "You have successfully deleted ".$user->first_name." ".$user->last_name."!";
			$notice = "success";
		} else {
			$success = $user->first_name." ".$user->last_name." could not be deleted!<br> Reason: ".$data;
			$notice = "danger";
		}

		$view = new view('users/users');
		$view->assign('success', $success);
		$view->assign('names', $names);
		$view->assign('notice', $notice);
	}

	
}