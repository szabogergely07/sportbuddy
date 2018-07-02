<?php


use app\Router;

Router::group(['namespace' => '\app\controllers'], function () {
	
	Router::get('sportbuddy/register', 'userController@register');

	Router::get('sportbuddy/users', 'userController@index');

	Router::get('sportbuddy/user/{id}', 'userController@show');

	Router::post('sportbuddy/createuser', 'userController@store');


});
