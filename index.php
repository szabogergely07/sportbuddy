<?php


/* Load external autoload file */
require 'vendor/autoload.php';


use myclass\Val;
use app\Router;

//Save a layout in a constant
ob_start();
require 'app/views/layout/layout_start.php';
define ('HTML_START', ob_get_contents());
ob_end_clean();

ob_start();
require 'app/views/layout/layout_end.php';
define ('HTML_END', ob_get_contents());
ob_end_clean();

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

Router::setDefaultNamespace('\app\controllers');

// Start the routing
Router::start();

