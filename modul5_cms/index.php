<?php
 
error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

$router = new \App\Router();

$application = \App\Application::getInstance();
$application->setRouter($router);

$application->run();

printDebug();
