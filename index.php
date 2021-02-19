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
require_once ('model/validate.php');

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
    if($_SERVER['REQUEST_METHOD']=='POST') {

        // get the data  from the Post array
        $name = trim($_POST['name']);
        $userOptions = ($_POST['options']);

        //if data is valid, store in session
        if (validName($name)) {
            $_SESSION['name'] = $name;
        } //data is not valid, set error in f3 hive
        else {
            $f3->set('errors["name"]', "Name cannot be blank.");
        }

        if(validOpt($userOptions)) {
            $_SESSION['option'] = implode(" ", $userOptions);
        }

        else {
            $f3->set('errors["option"]', "Valid options only.");
        }


        if (empty($f3->get('errors'))) {
            //send to the summary page
            $f3->reroute('/summary');
        }
    }

    $f3->set('options', getOptions());
    $f3->set('name', isset($name) ? $name : "");

    $view = new Template();
    echo $view->render('views/survey.html');
});

//define a summary
$f3->route('GET /summary', function () {
    //echo "Test";

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

//run fat free
$f3->run();