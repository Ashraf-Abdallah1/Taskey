<?php

namespace Framework;

class ResponseFactory
{
    public function body(string $text): Response
    {
        return new Response(200, $text, null);
    }

    public function notFound(): Response
    {
        return new Response(404, "Page is not found", null);
    }
}
