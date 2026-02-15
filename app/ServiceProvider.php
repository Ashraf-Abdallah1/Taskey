<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\TaskOverviewController;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(ServiceContainer $serviceContainer): void
    {
        $responseFactory = $serviceContainer->get(ResponseFactory::class);
        $serviceContainer->set(HomeController::class, new HomeController($responseFactory));
        $serviceContainer->set(TaskOverviewController::class, new TaskOverviewController($responseFactory));
        $serviceContainer->set(AboutPageController::class, new AboutPageController($responseFactory));
        $serviceContainer->set(CreateTaskController::class, new CreateTaskController($responseFactory));
    }
}
