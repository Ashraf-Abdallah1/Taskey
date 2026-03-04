<?php

use App\RouteProvider;
use App\ServiceProvider;
use Framework\Kernel;
use Framework\Request;

require __DIR__ . '/../vendor/autoload.php';

////$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$config = [
    'APP_VIEW_PATH' => '../app/views',
    'APP_ENV' => 'dev',
    'APP_TIMEZONE' => 'UTC',
    'APP_DB' => 'database.sqlite'
];
try {
    $kernel = new Kernel($config);
    $kernel->registerServices(new ServiceProvider());
    $kernel->registerRoutes(new RouteProvider());

    $request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_GET, $_POST);

    $response = $kernel->handle($request);
    $response->echo();
} catch (Exception $e) {
    echo $e->getMessage();
}
