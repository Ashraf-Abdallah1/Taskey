<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\TaskOverviewController;
use Framework\RouteProviderInterface;
use Framework\Router;
use Framework\ServiceContainer;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router, ServiceContainer $serviceContainer): void
    {
        $homeController = $serviceContainer->get("HomeController");
        $taskController = $serviceContainer->get("TaskController");
        $aboutPageController = $serviceContainer->get("AboutPageController");
        $createTaskController = $serviceContainer->get("CreateTaskController");

        $router->addRoute('GET', '/', [$homeController, 'index']);

        $router->addRoute('GET', '/tasks', [$taskController, 'index']);

        $router->addRoute('GET', '/about', [$aboutPageController, 'index']);

        $router->addRoute('GET', '/tasks/create', [$createTaskController, 'index']);
    }
}
