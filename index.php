<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required file
require_once('vendor/autoload.php');

//Start a session
session_start();

require_once('/home/oringhis/propertyConfig.php');
try {
    $db = new PDO(DB_PROP_DSN, DB_PROP_USERNAME, DB_PROP_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
}

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$controller = new PropertyController($f3);
$db = new PropertyDatabase();

//Define a default route
$f3->route('GET /', function () {
    global $controller;
    $controller->landingPage();
});

//Define a properties route
$f3->route('GET /homes', function () {
    global $controller;
    $controller->properties();
});

//Define a route that allows you to add a new property
$f3->route('GET|POST /add', function () {
    global $controller;
    $controller->add();
});

//Run Fat-Free
$f3->run();