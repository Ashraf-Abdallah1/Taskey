<?php

use App\RouteProvider;
use App\ServiceProvider;
use Framework\Kernel;
use Framework\Request;

require __DIR__ . '/../vendor/autoload.php';

////$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$kernel = new Kernel();
$kernel->registerServices(new ServiceProvider());
$kernel->registerRoutes(new RouteProvider());

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_GET, $_POST);

$response = $kernel->handle($request);
$response->echo();
