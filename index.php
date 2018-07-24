<?php

/* Load external autoload file */
require 'vendor/autoload.php';
/* Load SimpleRouter helper file (routing and session) */
require_once 'app/helpers.php'; 

use myclass\Val;
use app\Router;
use app\lib\session;

/**
 * Database configuration; 'config/config.php' 
 * has to include a '$conf' array with the db credentials
 */
$reg = \app\lib\config::inst();
require 'config/config.php';
foreach($conf as $key=>$unit){
	$reg->$key = $unit;
}
unset($conf);


/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */
Router::setDefaultNamespace('\app\controllers');

// Start the routing
Router::start();

