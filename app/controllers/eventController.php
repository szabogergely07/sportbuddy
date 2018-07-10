<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\event;
use app\model\basis;


class eventController {
	private $basis;
	private $event;

	public function __construct() {
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
    	$view = new view('events/show');
		$view->assign('event', $event);
	}

	public function create() {
		$view = new view('events/create');

	}

	public function store() {
		$data = $this->event->store();
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