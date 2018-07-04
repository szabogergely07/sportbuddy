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

	// Every users
	Router::get('sportbuddy/users', 'userController@index');

	// 1 user details
	Router::get('sportbuddy/user/{id}', 'userController@show');

	// Creates user
	Router::post('sportbuddy/createuser', 'userController@store');

	// Update page
	Router::get('sportbuddy/user/update-index/{id}', 'userController@updateIndex');

	// Updates user
	Router::match(['post', 'patch'], 'sportbuddy/user/update/{id}', 'userController@update');

	// Deletes user
	Router::delete('sportbuddy/user/delete/{id}', 'userController@delete');

});

//Event pages
Router::group([], function () {
	
	Router::get('sportbuddy/events', 'eventController@index');

	


});
