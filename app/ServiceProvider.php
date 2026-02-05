<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\TaskOverviewController;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(ServiceContainer $serviceContainer): void
    {
        $homeController = new HomeController();
        $taskController = new TaskOverviewController();
        $aboutPageController = new AboutPageController();
        $createTaskController = new CreateTaskController();

        $serviceContainer->set("HomeController", $homeController);
        $serviceContainer->set("TaskController", $taskController);
        $serviceContainer->set("AboutPageController", $aboutPageController);
        $serviceContainer->set("CreateTaskController", $createTaskController);
    }
}