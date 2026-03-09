<?php

namespace App\Controllers\task;

use App\Models\Task;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class ShowTaskController
{
    private ResponseFactory $responseFactory;

    private TaskRepositoryInterface $taskRepository;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request): Response
    {

        $id = (int)$request->get('id');
        $task = $this->taskRepository->findById($id);
        $project = $this->taskRepository->findProjectByTask($task->project_id);
        return $this->responseFactory->view('tasks/showTask.html.twig', [
            "task" => $task,
            "project" => $project
        ]);
    }
}
