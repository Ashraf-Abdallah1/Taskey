<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\TaskOverviewController;
use Framework\RouteProviderInterface;
use Framework\Router;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router): void
    {
        $homeController = new HomeController();
        $taskController = new TaskOverviewController();
        $aboutPageController = new AboutPageController();
        $CreateTaskController = new CreateTaskController();


        $router->addRoute('GET', '/', [$homeController, 'index']);

        $router->addRoute('GET', '/tasks', [$taskController, 'index']);

        $router->addRoute('GET', '/about', [$aboutPageController, 'index']);

        $router->addRoute('GET', '/tasks/create', [$CreateTaskController, 'index']);
    }
}
