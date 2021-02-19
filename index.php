<?php

//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once('vendor/autoload.php');

//Create an instance of Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//define a default route(home page)
$f3->route('GET /', function() {
    //echo "Hello";
    $view = new Template();
    echo $view->render('views/home.html');
});

//define a breakfast route
$f3->route('GET /breakfast', function () {
    //echo "breakfast";
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

//define a lunch/sandwich route
$f3->route('GET /lunch/sandwich', function () {
    //echo "Test";
    $view = new Template();
    echo $view->render('views/sandwich.html');
});

//run fat free
$f3->run();