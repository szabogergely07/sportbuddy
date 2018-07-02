<?php


/* Load external autoload file */
require 'vendor/autoload.php';


use myclass\Val;
use app\Router;


/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

Router::setDefaultNamespace('\app\controllers');

// Start the routing
Router::start();

