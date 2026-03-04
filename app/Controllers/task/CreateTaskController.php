<?php

namespace App\Controllers\task;

use App\Models\Task;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use DateTime;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class CreateTaskController
{
    private ResponseFactory $responseFactory;
    private TaskRepositoryInterface $taskRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request): Response
    {
        return $this->responseFactory->view("tasks/createTask.html.twig");
    }

    public function store(Request $request): Response
    {
        $task = new Task();
        $task->title = $request->get('title') ?? '';
        $task->description = $request->get('description') ?? '';
        $task->status = (int)$request->get('status');
        $task->priority = (int)$request->get('priority');
        $task->progress = 0;
        if ($request->get('created_at')) {
            $created_at = DateTime::createFromFormat('Y-m-d', $request->get('created_at'));
            $task->created_at = $created_at ? $created_at->getTimestamp() : (int)date('%s');
        }
        $task = $this->taskRepository->create($task);
        if ($task === null) {
            return $this->responseFactory->internalError();
        }
//            var_dump($task);
        return $this->responseFactory->redirect('tasks/showTask/' . $task->id);
    }
}
