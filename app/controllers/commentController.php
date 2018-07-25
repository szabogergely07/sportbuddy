<?php

namespace app\controllers;
use app\view\view;
use app\model\basis;
use app\model\comment;
use app\lib\session;

class commentController extends basisController {
	private $basis;
	private $comment;

	public function __construct() {
		parent::__construct();
		$this->basis = new basis;
		$this->comment = new comment;
	}

	public function index() {
		
			//Model
			$result = $this->basis->all('comment');
			
			//View
			$view = new view('comments/comments');
			$view->assign('result', $result);
	}


	public function store($event_id) {
		$user_id = $_SESSION['user_id'];
		//Model
		$data = $this->comment->store($event_id,$user_id);
		
		//View
		header("location: /sportbuddy/events/$event_id");

		// if($data) {
		// 	$view = new view('locations/locations');
		// 	$view->assign('data', $data);
		// 	$view->assign('result', $result);
		// } else {
		// 	$notice = "success";
		// 	$success = "New location created successfully!";
		// 	$view = new view('locations/locations');
		// 	$view->assign('success', $success);
		// 	$view->assign('notice', $notice);
		// 	$view->assign('result', $result);
	 //    }
	}

	
	public function updateIndex($id) {
		
			//Model
			$result = $this->basis->show($id,'location');

			// View
			$view = new view('locations/update');
			$view->assign('result', $result);
	}

	public function update($id) {
			//Model
	     	$data = $this->location->store($id);
			$result = $this->basis->all('location');

			//View if there is error
			if($data) {
				$result = $this->basis->show($id,'location');

				$view = new view('locations/update');
				$view->assign('result', $result);
				$view->assign('data', $data);
			// View if there is no error
			} else {
				$success = "You have updated successfully!";
				$notice = "success";
				$view = new view('locations/locations');
				$view->assign('success', $success);
				$view->assign('result', $result);
				$view->assign('notice', $notice);
		    }
		// } else {
		// 	$view = new view('403');
		// }
		
	}

	public function delete($id) {
		
			//Model
	     	$location = $this->basis->show($id,'location');
	     	$data = $this->basis->delete($id,'location');
	     	$result = $this->basis->all('location');

			// View 
			$success = "You have successfully deleted ".$location->name." !";
			$notice = "success";

			$view = new view('locations/locations');
			$view->assign('success', $success);
			$view->assign('result', $result);
			$view->assign('notice', $notice);
		// } else {
		// 	$view = new view('403');
		// }
	}


	
}