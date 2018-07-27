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

		if(!isset($_SESSION['user_id'])) {
			header("location: /sportbuddy");
			exit;
		}
	}

	public function index() {
		
			// //Model
			// $result = $this->basis->all('comment');
			
			// //View
			// $view = new view('comments/comments');
			// $view->assign('result', $result);
	}


	public function store($event_id) {
		$user_id = $_SESSION['user_id'];
		//Model
		$data = $this->comment->store($event_id,$user_id);
		
		//View
		header("location: /sportbuddy/event/$event_id");

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


	public function delete($comment_id,$event_id) {

		$comment = $this->comment->commentUser($comment_id);
		// Delete only own comment or by admin
		if (($_SESSION['user_id'] == $comment->userId || ($_SESSION['admin'] == 2))) {
			//Model
	     	$data = $this->basis->delete($comment_id,'comment');
	     	
			// View 
			redirect('/sportbuddy/event/'.$event_id.'/deleted');
		} else {
			$view = new view('403');
		}
	}


	
}