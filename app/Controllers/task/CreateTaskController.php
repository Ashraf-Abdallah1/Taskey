<?php

namespace App\Controllers\task;

use Framework\Response;

class CreateTaskController
{
    public function index(): Response
    {
        return new Response(200, ' create task page', null);
    }
}
