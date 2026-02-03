<?php

use Framework\Kernel;
use Framework\Request;

require __DIR__ . '/../vendor/autoload.php';

//$kernel = new Kernel();
////$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_GET, $_POST);
//$response = $kernel->handle($request);
//
//$response->echo();

$kernel = new Kernel();
$router = $kernel->getRouter();

// hier voeg een route om toch een matching te hebben
$router->addRoute('GET', '/', 'test route');
$router->addRoute('GET', '/test', 'test route');
$router->addRoute('GET', '/Ashraf', 'Ashraf route');

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_GET, $_POST);

$response = $kernel->handle($request);
$response->echo();
