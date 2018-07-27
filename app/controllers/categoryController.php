<?php

namespace app\controllers;
use app\view\view;
use app\model\basis;
use app\model\category;
use app\lib\session;

class categoryController extends basisController {
	private $user;
	private $basis;
	private $category;

	public function __construct() {
		parent::__construct();
		$this->basis = new basis;
		$this->category = new category;
		if(($_SESSION['admin'] != 2)) {
			header("location: /sportbuddy");
			exit;
		}
	}


	public function index() {
		
			//Model
			$result = $this->basis->all('category');
			
			//View
			$view = new view('categories/categories');
			$view->assign('result', $result);
	}

	public function store() {

		//Model
		$data = $this->category->store();
		$result = $this->basis->all('category');

		//View
		if($data) {
			$view = new view('categories/categories');
			$view->assign('data', $data);
			$view->assign('result', $result);
		} else {
			$notice = "success";
			$success = "New category created successfully!";
			$view = new view('categories/categories');
			$view->assign('success', $success);
			$view->assign('notice', $notice);
			$view->assign('result', $result);
	    }
	}

	
	public function updateIndex($id) {
		
			//Model
			$result = $this->basis->show($id,'category');

			// View
			$view = new view('categories/update');
			$view->assign('result', $result);
	}

	public function update($id) {
			//Model
	     	$data = $this->category->store($id);
			$result = $this->basis->all('category');

			//View if there is error
			if($data) {
				$result = $this->basis->show($id,'category');

				$view = new view('categories/update');
				$view->assign('result', $result);
				$view->assign('data', $data);
			// View if there is no error
			} else {
				$success = "You have updated successfully!";
				$notice = "success";
				$view = new view('categories/categories');
				$view->assign('success', $success);
				$view->assign('result', $result);
				$view->assign('notice', $notice);
		    }
		// } else {
		// 	$view = new view('403');
		// }
		
	}

	


	
}