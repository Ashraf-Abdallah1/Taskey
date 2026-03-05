<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\project\ProjectOverviewController;
use App\Controllers\project\ShowProjectController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\DeleteTaskController;
use App\Controllers\task\EditTaskController;
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
        $editTaskController = $serviceContainer->get(EditTaskController::class);
        $deleteTaskController = $serviceContainer->get(DeleteTaskController::class);
        $projectOverviewController = $serviceContainer->get(ProjectOverviewController::class);
        $showProjectController = $serviceContainer->get(ShowProjectController::class);

        $router->addRoute('GET', '/', [$homeController, 'index']);

        $router->addRoute('GET', '/tasks', [$taskController, 'index']);

        $router->addRoute('GET', '/about', [$aboutPageController, 'index']);

        $router->addRoute('GET', '/tasks/create_form', [$createTaskController, 'index']);
        $router->addRoute('POST', '/tasks/create_form/create', [$createTaskController, 'store']);

        $router->addRoute('GET', '/tasks/showTask/(?<id>\d+)', [$showTaskController, 'index']);
        $router->addRoute('POST', '/tasks/edit_form/(?<id>\d+)', [$editTaskController, 'index'] );
        $router->addRoute('POST', '/tasks/edit_form/edit/(?<id>\d+)', [$editTaskController, 'update']);
        $router->addRoute('GET', '/tasks/delete_form/(?<id>\d+)', [$deleteTaskController, 'index']);
        $router->addRoute('POST', '/tasks/delete_form/delete/(?<id>\d+)', [$deleteTaskController, 'delete']);
        $router->addRoute('GET', '/projects', [$projectOverviewController, 'index']);
        $router->addRoute('GET', '/projects/(?<id>\d+)', [$showProjectController, 'index']);
    }
}
