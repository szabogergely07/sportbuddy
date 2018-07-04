<?php

namespace app\controllers;
use app\view\view;


class indexController {

	// Homepage
	public function home() {
		$view = new view('home');
	}

	// 404 page
	public function notFound() {
		$view = new view('404');
	}


}