<?php

namespace app\controllers;
use app\view\view;


class eventController {

	public function index() {
		$db = new \mysqli('localhost', 'root', '', 'mydb');
		$events = $db->query("SELECT name, description, date, start, size, first_name FROM event 
    		JOIN user_has_event ON user_has_event.event_id = event.id
    		JOIN user ON user.id = user_has_event.user_id;")->fetch_all(MYSQLI_ASSOC);

		$view = new view('events/events1');
		$view->assign('events', $events);
	}


}