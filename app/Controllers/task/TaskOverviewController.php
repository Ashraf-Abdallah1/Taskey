<?php

namespace App\Controllers\task;

use Framework\Response;

class TaskOverviewController
{
    public function index(): Response
    {
        return new Response(200, 'TaskOverviewController index', null);
    }
}
