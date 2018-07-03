<?php

use app\Router;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

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
	
	Router::get('sportbuddy/register', 'userController@register');

	Router::get('sportbuddy/users', 'userController@index');

	Router::get('sportbuddy/user/{id}', 'userController@show');

	Router::post('sportbuddy/createuser', 'userController@store');


});

//Event pages
Router::group([], function () {
	
	Router::get('sportbuddy/events', 'eventController@index');

	


});
