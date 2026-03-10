<?php

namespace App\Controllers\project;

use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class DeleteProjectController
{
    private ProjectRepositoryInterface $projectRepository;

    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory, ProjectRepositoryInterface $projectRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request): Response
    {
        $id = (int)$request->get('id');
        $project = $this->projectRepository->findById($id);
        return $this->responseFactory->view('projects/delete.html.twig', [
            'project' => $project
        ]);
    }

}