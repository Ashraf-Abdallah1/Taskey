<?php

namespace App\Controllers\task;

use Framework\Response;
use Framework\ResponseFactory;

class CreateTaskController
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function index(): Response
    {
        return $this->responseFactory->view("tasks/createTask.html.twig");
    }
}
