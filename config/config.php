<?php
//require('rb.php');
namespace config;

use vendor\rb.php;

class config {
	R::setup('mysql:host=localhost;dbname=mydb', 'root', '');
}