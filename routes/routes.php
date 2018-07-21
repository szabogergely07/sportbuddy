<?php

use app\Router;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;


// Redirect to 404 page when route not found
Router::get('sportbuddy/not-found', 'indexController@notFound');

Router::error(function(Request $request, \Exception $exception) {

    if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        self::response()->redirect('/sportbuddy/not-found');
    }
    
});


// Home page
Router::get('sportbuddy', 'indexController@home')->name('home');

// User pages
Router::group([], function () {

	// Register page
	Router::get('sportbuddy/register', 'sessionController@register');

	// Login page
	Router::get('sportbuddy/login', 'sessionController@login');

	// User login, session start
	Router::post('sportbuddy/loginuser', 'sessionController@loginuser');

	// User logout
	Router::get('sportbuddy/logout', 'sessionController@logout');

	// Every users
	Router::get('sportbuddy/users', 'userController@index');

	// 1 user details
	Router::get('sportbuddy/user/{id}', 'userController@show');

	// Creates user
	Router::post('sportbuddy/createuser', 'sessionController@store');

	// Update page
	Router::get('sportbuddy/user/update-index/{id}', 'userController@updateIndex');

	// Updates user
	Router::match(['patch'], 'sportbuddy/user/update/{id}', 'userController@update');

	// Admin deletes user
	Router::delete('sportbuddy/user/delete/{id}', 'userController@delete');

	// User deletes self
	Router::delete('sportbuddy/user/self-delete/{id}', 'userController@deleteOwn');

});

//Event pages
Router::group([], function () {
	
	Router::get('sportbuddy/events', 'eventController@index');

	Router::get('sportbuddy/my-events', 'eventController@own');

	Router::get('sportbuddy/events/{id}', 'eventController@show');

	Router::get('sportbuddy/create-event', 'eventController@create');
	
	Router::post('sportbuddy/store-event', 'eventController@store');

	Router::get('sportbuddy/events/update-index/{id}', 'eventController@updateIndex');

	Router::patch('sportbuddy/events/update/{id}', 'eventController@update');

	Router::delete('sportbuddy/delete-event/{id}/{name}', 'eventController@delete');

	Router::post('sportbuddy/join-event/{id}', 'eventController@join');

	Router::delete('sportbuddy/leave-event/{id}', 'eventController@leave');

});
