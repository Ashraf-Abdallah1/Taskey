<?php

namespace App\Controllers;

use Framework\Response;

class AboutPageController
{
    public function index(): Response
    {
        return new Response(200, 'about page', null);
    }
}
