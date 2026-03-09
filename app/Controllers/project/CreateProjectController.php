<?php

namespace App\Controllers\project;

use App\Models\Project;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class CreateProjectController
{
    private ResponseFactory $response;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ResponseFactory $response, ProjectRepositoryInterface $projectRepository)
    {
        $this->response = $response;
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request): Response
    {

        return $this->response->view('projects/create.html.twig');
    }


    public function store(Request $request): Response
    {
        $project = new Project();
        $project->title = (string)$request->get('title');
        $project->description = (string)$request->get('description');
        if (empty($project->title) || empty($project->description)) {
            throw new \Error('project is empty');
        }

        $this->projectRepository->insert($project);
        return $this->response->redirect('/projects');
    }
}
