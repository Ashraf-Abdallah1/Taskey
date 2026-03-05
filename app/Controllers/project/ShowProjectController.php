<?php

namespace App\Controllers\project;

use Framework\Response;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Request;
use Framework\ResponseFactory;

class ShowProjectController
{
    private ProjectRepositoryInterface $projectRepository;
    private ResponseFactory $response;

    public function __construct(ProjectRepositoryInterface $projectRepository, ResponseFactory $response)
    {
        $this->projectRepository = $projectRepository;
        $this->response = $response;
    }

    public function index(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->findById($id);
        return $this->response->view('projects/show.html.twig', ['project' => $project]);
    }
}
