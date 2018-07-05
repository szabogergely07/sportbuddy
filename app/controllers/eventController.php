<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\event;


class eventController {
	private $user;
	private $event;

	public function __construct() {
		$this->user = new user;
		$this->event = new event;
	}

	public function index() {
		// $db = new \mysqli('localhost', 'root', '', 'mydb');
		// $events = $db->query("SELECT name, description, date, start, size, first_name FROM event 
  //   		JOIN user_has_event ON user_has_event.event_id = event.id
  //   		JOIN user ON user.id = user_has_event.user_id;")->fetch_all(MYSQLI_ASSOC);

		//Model
		$events = $this->event->allWithUsers();

		//View
		$view = new view('events/events');
		$view->assign('events', $events);
	}


}