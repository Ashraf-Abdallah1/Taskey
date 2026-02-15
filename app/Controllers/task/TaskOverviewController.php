<?php

namespace App\Controllers\task;

use Framework\Response;
use Framework\ResponseFactory;

class TaskOverviewController
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function index(): Response
    {
        return $this->responseFactory->view("tasks/index.html.twig");
    }
}
