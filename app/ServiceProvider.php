<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\DeleteTaskController;
use App\Controllers\task\EditTaskController;
use App\Controllers\task\ShowTaskController;
use App\Controllers\task\TaskOverviewController;
use App\Repositories\TaskRepository;
use Framework\Database;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(ServiceContainer $serviceContainer): void
    {
        $responseFactory = $serviceContainer->get(ResponseFactory::class);
        $database = $serviceContainer->get(Database::class);
        $serviceContainer->set(TaskRepository::class, new TaskRepository($database));
        $taskRepository = $serviceContainer->get(TaskRepository::class);
        $serviceContainer->set(HomeController::class, new HomeController($responseFactory));
        $serviceContainer->set(TaskOverviewController::class, new TaskOverviewController($responseFactory, $taskRepository));
        $serviceContainer->set(AboutPageController::class, new AboutPageController($responseFactory));
        $serviceContainer->set(CreateTaskController::class, new CreateTaskController($responseFactory, $taskRepository));
        $serviceContainer->set(ShowTaskController::class, new ShowTaskController($responseFactory, $taskRepository));
        $serviceContainer->set(EditTaskController::class, new EditTaskController($responseFactory, $taskRepository));
        $serviceContainer->set(DeleteTaskController::class, new DeleteTaskController($responseFactory, $taskRepository));
    }
}
