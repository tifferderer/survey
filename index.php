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
        $options = ($_POST['options']);

        //if data is valid, store in session
        if(validName($name)) {
            $_SESSION['name'] = $name;
        }
        //data is not valid, set error in f3 hive
        else {
            $f3->set('errors["name"]',"Name cannot be blank.");
        }

    }
    $f3->set('options', getOptions());
    $f3->set('name', isset($name) ? $name : "");

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