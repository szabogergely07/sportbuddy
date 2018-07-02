<?php

use app\Router;

// Home page
Router::get('sportbuddy', 'indexController@home');

// User pages
Router::group([], function () {
	
	Router::get('sportbuddy/register', 'userController@register');

	Router::get('sportbuddy/users', 'userController@index');

	Router::get('sportbuddy/user/{id}', 'userController@show');

	Router::post('sportbuddy/createuser', 'userController@store');


});

//Event pages
Router::group([], function () {
	
	Router::get('sportbuddy/events', 'eventController@index');

	


});
