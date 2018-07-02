<?php


/* Load external routes file */
require 'vendor/autoload.php';
// require 'vendor/helper.php';


// require 'app/Autoload.php';

// define('BASDIR',__DIR__);

// $autoload = [
//   'namespaces' => [
//     "app" => 'app'
//   ]
// ];

// $objAutoLoad = new \app\Autoload;
// $objAutoLoad->register();
// $objAutoLoad->setNamespaceFile($autoload,BASDIR);



use myclass\Val;
use app\Router;


//include('index.html');


/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

//SimpleRouter::setDefaultNamespace('Pecee\SimpleRouter\SimpleRouter');

// Start the routing
Router::start();

// SimpleRouter::request()->getLoadedRoute();
// request()->getLoadedRoute();

// SimpleRouter::get('/', function() {
//     return 'Hello world';
//});