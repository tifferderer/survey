<?php

//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');

//Create an instance of Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//define a default route(home page)
$f3->route('GET /', function() {
    //echo "Hello";
    $view = new Template();
    echo $view->render('views/home.html');
});

//define a survey route
$f3->route('GET|POST /survey', function ($f3) {
    $f3->set('options', getOptions());

    $view = new Template();
    echo $view->render('views/survey.html');
});

//define a summary
$f3->route('POST /summary', function () {
    //echo "Test";
    if(isset($_POST['name'])) {
        $_SESSION['name'] = $_POST['name'];
    }
    if(isset($_POST['option'])) {
        $_SESSION['option'] = implode(" ", $_POST['option']);
    }

    $view = new Template();
    echo $view->render('views/summary.html');
});

//run fat free
$f3->run();