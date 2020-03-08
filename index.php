<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required file
require_once('vendor/autoload.php');;

//Start a session
session_start();

require('/home/joshicgr/config.php');
try {
    $db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
}

//Create an instance of the Base class
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$controller = new PropertyController($f3);
$db = new PropertyDatabase();

//Define a default route
$f3->route('GET|POST /', function () {
    global $controller;
    $controller->landingPage();
});

$f3->route('GET|POST /login', function () {
    global $controller;
    $controller->loginPage();
});

$f3->route('GET|POST /logout', function () {
    session_destroy();
    global $controller;
    $controller->logout();
});

$f3->route('GET|POST /register', function () {
    global $controller;
    $controller->registerPage();
});

$f3->route('GET|POST /welcome', function () {
    global $controller;
    $controller->showWelcome();
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