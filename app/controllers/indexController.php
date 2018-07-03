<?php

namespace app\controllers;
use app\view\view;


class indexController {

	public function home() {
		$view = new view('index');
	}

	public function notFound() {
		$view = new view('404');
	}


}