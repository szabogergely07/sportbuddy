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

    //  if($exception instanceof NotFoundHttpException && $exception->getCode() === 403) {
    //     self::response()->redirect('/sportbuddy/403');
    // }
    
});


// Home page
Router::get('sportbuddy', 'indexController@home')->name('home');

// Admin page
Router::get('sportbuddy/admin', 'userController@admin');

// User pages
Router::group([], function () {

	// Register page
	Router::get('sportbuddy/register', 'sessionController@register');

	// AJAX Email exists
	Router::post('sportbuddy/email-exist', 'userController@emailExist');

	// Confirm registration
	Router::get('sportbuddy/confirm/{id}', 'userController@confirm');

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

	Router::get('sportbuddy/allevents', 'eventController@gmapsEvents');

	Router::form('sportbuddy/gmaps', 'eventController@gmaps');

	Router::get('sportbuddy/gmapsAll', 'eventController@gmapsAll');
	
	Router::form('sportbuddy/events/{search?}', 'eventController@index');

	Router::get('sportbuddy/my-events', 'eventController@own');

	Router::get('sportbuddy/joined-events', 'eventController@joined');

	Router::get('sportbuddy/event/{id}/{deleted?}', 'eventController@show');

	Router::get('sportbuddy/create-event', 'eventController@create');
	
	Router::post('sportbuddy/store-event', 'eventController@store');

	Router::get('sportbuddy/event/update-index/{id}', 'eventController@updateIndex');

	Router::patch('sportbuddy/event/update/{id}', 'eventController@update');

	Router::delete('sportbuddy/delete-event/{id}/{name}', 'eventController@delete');

	Router::post('sportbuddy/join-event/{id}', 'eventController@join');

	Router::delete('sportbuddy/leave-event/{id}', 'eventController@leave');

	Router::post('sportbuddy/take-ownership/{id}', 'eventController@take');

	// Search field
	Router::get('sportbuddy/search-event', 'eventController@search');

	//Events in the past for admin
	Router::get('sportbuddy/past-events', 'eventController@past');

});

// Location pages
Router::group([], function () {
	
	Router::get('sportbuddy/locations', 'locationController@index');

	Router::get('sportbuddy/ajax-locations', 'locationController@ajaxIndex');

	Router::get('sportbuddy/create-location', 'locationController@create');
	
	Router::post('sportbuddy/store-location', 'locationController@store');

	Router::get('sportbuddy/locations/update-index/{id}', 'locationController@updateIndex');

	Router::patch('sportbuddy/locations/update/{id}', 'locationController@update');

	Router::delete('sportbuddy/delete-location/{id}', 'locationController@delete');
});

// Category pages
Router::group([], function () {
	
	Router::get('sportbuddy/categories', 'categoryController@index');

	Router::get('sportbuddy/create-category', 'categoryController@create');
	
	Router::post('sportbuddy/store-category', 'categoryController@store');

	Router::get('sportbuddy/categories/update-index/{id}', 'categoryController@updateIndex');

	Router::patch('sportbuddy/categories/update/{id}', 'categoryController@update');

	Router::delete('sportbuddy/delete-category/{id}', 'categoryController@delete');
});

// Category pages
Router::group([], function () {
	
	// Router::get('sportbuddy/categories', 'categoryController@index');

	// Router::get('sportbuddy/create-category', 'categoryController@create');
	
	Router::post('sportbuddy/store-comment/{id}', 'commentController@store');

	// Router::get('sportbuddy/categories/update-index/{id}', 'categoryController@updateIndex');

	// Router::patch('sportbuddy/categories/update/{id}', 'categoryController@update');

	Router::delete('sportbuddy/delete-comment/{comment_id}/{event_id}', 'commentController@delete');
});