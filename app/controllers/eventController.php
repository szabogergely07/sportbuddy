<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\event;
use app\model\basis;


class eventController extends basisController {
	private $basis;
	private $event;

	public function __construct() {
		parent::__construct();
		$this->basis = new basis;
		$this->event = new event;
	}

	public function index() {

		//Model
		$names = $this->event->allWithUsers();

		//View
		$view = new view('events/events');
		$view->assign('events', $names);
	}

	public function show($id) {
		//Model
		$event = $this->basis->show($id,'event');

		//View
		if($event) {
	    	$view = new view('events/show');
			$view->assign('event', $event);
		} else {
			$view = new view('404');
		}
	}

	public function create() {

		if( !isset($_SESSION['user_id']) ){
            header('LOCATION: /sportbuddy');
        }

		$view = new view('events/create');

	}

	public function store() {

		if( !isset($_SESSION['user_id']) ){
            $view = new view('404');
        }

		// The logged in user's id, saved at login
		$user_id = intval(implode($_SESSION['user_id']));
		//Model
		$data = $this->event->store($user_id);
		$events = $this->event->allWithUsers();

		//View
		if($data) {
			$view = new view('events/create');
			$view->assign('data', $data);
		} else {
			$notice = "success";
			$success = "New event created successfully!";
			$view = new view('events/events');
			$view->assign('success', $success);
			$view->assign('notice', $notice);
			$view->assign('events', $events);
	    }
	}




}