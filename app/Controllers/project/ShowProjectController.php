<?php

namespace App\Controllers\project;

use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Response;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Request;
use Framework\ResponseFactory;

class ShowProjectController
{
    private ProjectRepositoryInterface $projectRepository;
    private ResponseFactory $response;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ResponseFactory            $response,
        TaskRepositoryInterface    $taskRepository,
    )
    {
        $this->projectRepository = $projectRepository;
        $this->response = $response;
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request): Response
    {
        $tasks = [];
        $id = (int)$request->get('id');
        $project = $this->projectRepository->findById($id);
        if ($project !== null) {
            $tasks = $this->taskRepository->findTasksByProject($project->id);
        }

        if (!empty($tasks)) {
            return $this->response->view('projects/show.html.twig', [
                'project' => $project
                ,'tasks' => $tasks

            ]);
        }
        return $this->response->internalError();
    }
}
