<?php

namespace app\controllers;
use app\view\view;


class indexController extends basisController {

	// Homepage
	public function home() {
		if(isset($_SESSION['user_id'])) {
			$view = new view('home_in');
		} else {
			$view = new view('home');
		}
	}

	// 404 page
	public function notFound() {
		$view = new view('404');
	}


}