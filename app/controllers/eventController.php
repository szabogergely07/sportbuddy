<?php

namespace app\controllers;
use app\view\view;
use app\model\user;
use app\model\event;
use app\model\basis;


class eventController extends basisController {
	private $basis;
	private $event;
	private $eventLevels = [];

	public function __construct() {
		parent::__construct();
		$this->basis = new basis;
		$this->event = new event;

		// Fill up the array with level names, modify $i when eventLevel method changes
		for ($i=2; $i <7 ; $i++) { 
			$this->eventLevels[] = [$i=>eventLevel($i)];
		}
		
	}

	public function index($search = null) {

		//Model
		if($search == null) {
			$names = $this->event->allWithUsers();
		} else {
			$names = $this->event->search();
		}
		$location = $this->basis->all('location');
		$category = $this->basis->all('category');

		//View
		$view = new view('events/events');
		$view->assign('events', $names);
		$view->assign('eventLevels',$this->eventLevels);
		$view->assign('locations', $location);
		$view->assign('categories', $category);
	}

	public function own() {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			//Model
			$names = $this->event->own($user_id);
			$location = $this->basis->all('location');
			$category = $this->basis->all('category');

			//View
			$view = new view('events/own-events');
			$view->assign('events', $names);
			$view->assign('eventLevels',$this->eventLevels);
			$view->assign('locations', $location);
			$view->assign('categories', $category);
		} else {
			$view = new view(
				'403');
		}
	}

	public function joined() {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			//Model
			$names = $this->event->joined($user_id);
			$location = $this->basis->all('location');
			$category = $this->basis->all('category');

			//View
			$view = new view('events/joined-events');
			$view->assign('events', $names);
			$view->assign('eventLevels',$this->eventLevels);
			$view->assign('locations', $location);
			$view->assign('categories', $category);
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

	public function show($id,$deleted=null) {
		if(isset($_SESSION['user_id'])) {
			
			$user_id = $_SESSION['user_id'];
		
			//Gets all events the user has
			$option = $this->event->userHasEvent($user_id);

			// If the user has this event already, $button will be a not empty array -> this decides in show page Join or Leave button
			$button = [];
			foreach ($option as $event_id) {
				if(implode($event_id) == $id) {
					$button[] = "match";
				}
			}	
		}

		//Model
		$event = $this->event->showDetails($id);
		$users = $this->event->allWithUsers($id,'event');
		$comments = $this->event->commentByUser($id);

		//View
		if($event) {
	    	$view = new view('events/show');
			$view->assign('event', $event);
			$view->assign('joined_users', $users);
			$view->assign('comments',$comments);

			// If comment deleted, commentController gives this parameter
			if($deleted == "deleted") {
				$view->assign('success','Comment deleted successfully!');
			}
			if(isset($_SESSION['user_id'])) {
				$view->assign('button', $button);
			}
		} else {
			$view = new view('404');
		}
	}

	public function create() {
		//Model
		$location = $this->basis->all('location');
		$category = $this->basis->all('category');
		//View
		if( !isset($_SESSION['user_id']) ){
            $view = new view('403');
        } else {
			$view = new view('events/create');
			$view->assign('locations',$location);
			$view->assign('categories',$category);
			$view->assign('eventLevels',$this->eventLevels);
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
		$location = $this->basis->all('location');
		$category = $this->basis->all('category');
		//View
		if($data) {
			$view = new view('events/create');
			$view->assign('data', $data);
			$view->assign('locations',$location);
			$view->assign('categories',$category);
			$view->assign('eventLevels',$this->eventLevels);
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
		$location = $this->basis->all('location');
		$category = $this->basis->all('category');

		if(isset($_SESSION['user_id']) && $event->created_by == $_SESSION['user_id'] || $_SESSION['admin'] == 2) {
			// View
			$view = new view('events/update');
			$view->assign('event', $event);
			$view->assign('locations',$location);
			$view->assign('categories',$category);
			$view->assign('eventLevels',$this->eventLevels);
		} else {
			$view = new view('403');
		}
	}

	public function update($event_id) {
		//Model
     	$data = $this->event->store(null, $event_id);
     	$events = $this->event->allWithUsers();
     	
     	$event = $this->basis->show($event_id,'event');
     	$location = $this->basis->all('location');
		$category = $this->basis->all('category');

		if($event->created_by == $_SESSION['user_id'] || $_SESSION['admin'] == 2) {
		// 	View if there is error
			if($data) {
				$event = $this->basis->show($event_id,'event');

				$view = new view('events/update');
				$view->assign('event', $event);
				$view->assign('data', $data);
				$view->assign('locations',$location);
				$view->assign('categories',$category);
				$view->assign('eventLevels',$this->eventLevels);
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
			redirect('/sportbuddy/event/'.$event_id);
		}
		$view = new view('403');
	}

	public function leave($event_id) {
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];

			$data = $this->event->leave($user_id,$event_id);

			//View
			redirect('/sportbuddy/event/'.$event_id);
		}
		$view = new view('403');
	}

	// public function search() {
	// 	$data = $this->event->search();


	// }


}