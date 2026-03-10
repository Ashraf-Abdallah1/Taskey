<?php

namespace App;

use App\Controllers\AboutPageController;
use App\Controllers\HomeController;
use App\Controllers\project\CreateProjectController;
use App\Controllers\project\DeleteProjectController;
use App\Controllers\project\ProjectOverviewController;
use App\Controllers\project\ShowProjectController;
use App\Controllers\tag\CreateTagController;
use App\Controllers\tag\TagOverviewController;
use App\Controllers\task\CreateTaskController;
use App\Controllers\task\DeleteTaskController;
use App\Controllers\task\EditTaskController;
use App\Controllers\task\ShowTaskController;
use App\Controllers\task\TaskOverviewController;
use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
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
        $serviceContainer->set(ProjectRepository::class, new ProjectRepository($database));
        $serviceContainer->set(TagRepository::class, new TagRepository($database));

        $taskRepository = $serviceContainer->get(TaskRepository::class);
        $projectRepository = $serviceContainer->get(ProjectRepository::class);
        $tagRepository = $serviceContainer->get(TagRepository::class);
        $serviceContainer->set(ProjectRepository::class, new ProjectRepository($database));
        $serviceContainer->set(HomeController::class, new HomeController($responseFactory));
        $serviceContainer->set(TaskOverviewController::class, new TaskOverviewController($responseFactory, $taskRepository));
        $serviceContainer->set(AboutPageController::class, new AboutPageController($responseFactory));
        $serviceContainer->set(CreateTaskController::class, new CreateTaskController($responseFactory, $taskRepository, $projectRepository));
        $serviceContainer->set(ShowTaskController::class, new ShowTaskController($responseFactory, $taskRepository));
        $serviceContainer->set(EditTaskController::class, new EditTaskController($responseFactory, $taskRepository, $projectRepository));
        $serviceContainer->set(DeleteTaskController::class, new DeleteTaskController($responseFactory, $taskRepository));
        $serviceContainer->set(ProjectOverviewController::class, new ProjectOverviewController($projectRepository, $responseFactory));
        $serviceContainer->set(ShowProjectController::class, new ShowProjectController($projectRepository, $responseFactory, $taskRepository));
        $serviceContainer->set(CreateProjectController::class, new CreateProjectController($responseFactory, $projectRepository));
        $serviceContainer->set(DeleteProjectController::class, new DeleteProjectController($responseFactory, $projectRepository));
        $serviceContainer->set(TagOverviewController::class, new TagOverviewController($tagRepository, $responseFactory));
        $serviceContainer->set(CreateTagController::class, new CreateTagController($tagRepository, $responseFactory ));
    }
}
