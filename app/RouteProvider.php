<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\ShowTaskController;
use App\Controllers\task\TaskOverviewController;
use Framework\RouteProviderInterface;
use Framework\Router;
use Framework\ServiceContainer;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router, ServiceContainer $serviceContainer): void
    {
        $homeController = $serviceContainer->get(HomeController::class);
        $taskController = $serviceContainer->get(TaskOverviewController::class);
        $aboutPageController = $serviceContainer->get(AboutPageController::class);
        $createTaskController = $serviceContainer->get(CreateTaskController::class);
        $showTaskController = $serviceContainer->get(ShowTaskController::class);

        $router->addRoute('GET', '/', [$homeController, 'index']);

        $router->addRoute('GET', '/tasks', [$taskController, 'index']);

        $router->addRoute('GET', '/about', [$aboutPageController, 'index']);

        $router->addRoute('GET', '/tasks/create', [$createTaskController, 'index']);

        $router->addRoute('GET', '/tasks/showTask/(?<id>\d+)', [$showTaskController, 'index']);
    }
}
