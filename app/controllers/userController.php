<?php

namespace app\controllers;
use app\view\view;
use app\model\user;

class userController {

	public function index() {
		
		//Model
		$conn = new user;
		$names = $conn->all();
		
		//View
		$view = new view('users/users');
		$view->assign('names', $names);
	}

	public function register() {
		
		$view = new view('users/register');
	}

	public function store() {
		
		//Model
    	$conn = new user;
     	$data = $conn->store();
		
		//View
		if($data) {
			$view = new view('users/register');
			$view->assign('data', $data);
		} else {
			$success = "You have registered successfully!";
			$view = new view('home');
			$view->assign('success', $success);
	    }
	}

	public function show($id) {

		//Model
		$conn = new user;
		$user = $conn->show($id);

		//View
    	$view = new view('users/show');
		$view->assign('user', $user);
	}
	
	public function updateIndex($id) {
		
		//Model
		$conn = new user;
		$user = $conn->show($id);

		// View
		$view = new view('users/update');
		$view->assign('user', $user);
	}

	public function update($id) {
		
		//Model
    	$conn = new user;
     	$data = $conn->store($id);
		
		//View
		if($data) {
			$conn2 = new user;
			$user = $conn->show($id);

			$view = new view('users/update');
			$view->assign('user', $user);
			$view->assign('data', $data);
		} else {
			$success = "You have updated successfully!";
			$view = new view('home');
			$view->assign('success', $success);
	    }
		
	}

	public function delete() {
		
		$view = new view('r');
	}

	
}