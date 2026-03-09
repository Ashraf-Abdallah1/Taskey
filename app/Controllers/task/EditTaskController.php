<?php

namespace App\Controllers\task;

use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class EditTaskController
{
    private ResponseFactory $responseFactory;

    private TaskRepositoryInterface $taskRepository;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->taskRepository = $taskRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request): Response
    {
        $id = (int)$request->get('id');
        $task = $this->taskRepository->findById($id);
        $projects = $this->projectRepository->all();
        return $this->responseFactory->view('tasks/editTask.html.twig', [
            'task' => $task,
            'projects' => $projects,

        ]);
    }

    public function update(Request $request): Response
    {
        $id = (int)$request->get('id');
        $task = $this->taskRepository->findById($id);
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->project_id = (int)$request->get('project_id');

        $this->taskRepository->update($task);

        return $this->responseFactory->redirect('/tasks');
    }
}