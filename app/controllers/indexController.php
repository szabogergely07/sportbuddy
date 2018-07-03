<?php

namespace app\controllers;
use app\view\view;


class indexController {

	// Homepage
	public function home() {
		$view = new view('index');
	}

	// 404 page
	public function notFound() {
		$view = new view('404');
	}


}