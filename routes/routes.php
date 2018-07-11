<?php

use app\Router;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;


// Redirect to 404 page when route not found
Router::get('sportbuddy/not-found', 'indexController@notFound');

Router::error(function(Request $request, \Exception $exception) {

    if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        self::response()->redirect('not-found');
    }
    
});


// Home page
Router::get('sportbuddy', 'indexController@home');

// User pages
Router::group([], function () {
	
	// Register page
	Router::get('sportbuddy/register', 'userController@register');

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
	Router::post('sportbuddy/createuser', 'userController@store');

	// Update page
	Router::get('sportbuddy/user/update-index/{id}', 'userController@updateIndex');

	// Updates user
	Router::match(['patch'], 'sportbuddy/user/update/{id}', 'userController@update');

	// Deletes user
	Router::delete('sportbuddy/user/delete/{id}', 'userController@delete');

});

//Event pages
Router::group([], function () {
	
	Router::get('sportbuddy/events', 'eventController@index');

	Router::get('sportbuddy/events/{id}', 'eventController@show');

	Router::get('sportbuddy/create-event', 'eventController@create');
	
	Router::post('sportbuddy/events/store', 'eventController@store');


});
