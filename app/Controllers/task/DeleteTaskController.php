<?php

namespace App\Controllers\task;

use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;
use phpDocumentor\Reflection\Types\This;

class DeleteTaskController
{
    private TaskRepositoryInterface $taskRepository;
    private ResponseFactory $response;

    public function __construct(ResponseFactory $response, TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->response = $response;
    }

    public function index(Request $request): Response
    {
        $id = (int)$request->get('id');
        $task = $this->taskRepository->findById($id);
        if ($task === null) {
            $this->response->notFound();
        }

        return $this->response->view('tasks/deleteTask.html.twig', ['task' => $task]);
    }

    public function delete(Request $request): Response
    {
        $id = (int)$request->get('id');
        $task = $this->taskRepository->findById($id);
        if ($task === null) {
            return $this->response->notFound();
        }
        $this->taskRepository->delete($task);
        return $this->response->redirect('/tasks');
    }
}