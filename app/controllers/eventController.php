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

	public function own() {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			//Model
			$names = $this->event->own($user_id);

			//View
			$view = new view('events/own-events');
			$view->assign('events', $names);
		} else {
			$view = new view('403');
		}
	}

	public function joined() {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			//Model
			$names = $this->event->joined($user_id);

			//View
			$view = new view('events/joined-events');
			$view->assign('events', $names);
		} else {
			$view = new view('403');
		}
	}	

	public function take($event_id) {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			//Model
			$take = $this->event->take($user_id,$event_id);
			$names = $this->event->joined($user_id);
			//View
			$view = new view('events/joined-events');
			$view->assign('events', $names);
		} else {
			$view = new view('403');
		}
	}

	public function show($id) {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		
			$option = $this->event->userHasEvent($user_id);

			$button = [];
			foreach ($option as $event_id) {
				if(implode($event_id) == $id) {
					$button[] = "match";
				}
			}	
		}

		//Model
		$event = $this->basis->show($id,'event');
		$users = $this->event->allWithUsers($id,'event');

		//View
		if($event) {
	    	$view = new view('events/show');
			$view->assign('event', $event);
			$view->assign('joined_users', $users);
			if(isset($_SESSION['user_id'])) {
				$view->assign('button', $button);
			}
		} else {
			$view = new view('404');
		}
	}

	public function create() {

		if( !isset($_SESSION['user_id']) ){
            $view = new view('403');
        } else {
			$view = new view('events/create');
		}
	}

	public function store() {

		if( !isset($_SESSION['user_id']) ){
            $view = new view('403');
        }

		// The logged in user's id, saved at login
		$user_id = $_SESSION['user_id'];
		//Model
		$data = $this->event->store($user_id, null);
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

	public function updateIndex($id) {
		//Model
		$event = $this->basis->show($id,'event');

		if(isset($_SESSION['user_id']) && $event->created_by == $_SESSION['user_id'] || $_SESSION['admin'] == 2) {
			// View
			$view = new view('events/update');
			$view->assign('event', $event);
		} else {
			$view = new view('403');
		}
	}

	public function update($event_id) {
		//Model
     	$data = $this->event->store(null, $event_id);
     	$events = $this->event->allWithUsers();
     	
     	$event = $this->basis->show($event_id,'event');
		if($event->created_by == $_SESSION['user_id'] || $_SESSION['admin'] == 2) {
		// 	View if there is error
			if($data) {
				$event = $this->basis->show($event_id,'event');

				$view = new view('events/update');
				$view->assign('event', $event);
				$view->assign('data', $data);
			// View if there is no error
			} else {
				$success = "You have updated successfully!";
				$notice = "success";
				$view = new view('events/events');
				$view->assign('success', $success);
				$view->assign('events', $events);
				$view->assign('notice', $notice);
		    }
		} else {
			$view = new view('403');
		}
		
	}

	public function delete($event_id,$event_name) {
		$event_name = str_replace('_',' ',$event_name);
		$event_exist = $this->basis->show($event_id,'event');
		if($event_exist->created_by == $_SESSION['user_id'] || $_SESSION['admin'] == 2) {
			if(!empty($event_exist)) {
				$data = $this->basis->delete($event_id,'event');
				if(isset($data) && !$data) {
					$success = $event_name." has been deleted successfully!";
					$notice = "success";
				} else {
					$success = $event_name." cannot be deleted. Reason:<br>".$data;
					$notice = "danger";
				
				}
			} else {
				$success = "This event does not exist!";
				$notice = "danger";
			}
			$events = $this->event->allWithUsers();

				//View
				$view = new view('events/events');
				$view->assign('events', $events);
				$view->assign('success', $success);
				$view->assign('notice', $notice);
		} else {
			$view = new view('403');
		}
	}

	public function join($event_id) {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$data = $this->event->join($user_id,$event_id);

			//View
			redirect('/sportbuddy/events/'.$event_id);
		}
		$view = new view('403');
	}

	public function leave($event_id) {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];

			$data = $this->event->leave($user_id,$event_id);

			//View
			redirect('/sportbuddy/events/'.$event_id);
		}
		$view = new view('403');
	}




}