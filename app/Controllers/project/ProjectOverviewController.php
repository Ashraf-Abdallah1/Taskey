<?php

namespace App\Controllers\project;

use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Response;
use Framework\ResponseFactory;

class ProjectOverviewController
{
    private ProjectRepositoryInterface $projectRepository;

    private ResponseFactory $responseFactory;

    public function __construct(ProjectRepositoryInterface $projectRepository, ResponseFactory $responseFactory)
    {
        $this->projectRepository = $projectRepository;
        $this->responseFactory = $responseFactory;
    }

    public function index(): Response
    {

        $projects = $this->projectRepository->all();


        return $this->responseFactory->view('projects/index.html.twig', ['projects' => $projects]);

    }

}
