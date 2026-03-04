<?php

namespace Framework;

use Twig\Environment;

class ResponseFactory
{
    private Environment $twig;

    public function __construct(string $debugMode, string $viewsPath)
    {
        $loader = new \Twig\Loader\FilesystemLoader($viewsPath);
        $this->twig = new \Twig\Environment($loader, [
            $debugMode => true,
        ]);
    }

    /**
     * view de
     *
     * @param string $template
     * @param array<mixed> $parameters
     * @return Response
     */
    public function view(string $template, array $parameters = []): Response
    {
        $response = new Response(200, '', null);

        try {
            $response->body = $this->twig->render($template, $parameters);
            $response->responseCode = 200;
        } catch (\Exception $e) {
            $response->responseCode = 500;
            $response->body = $e->getMessage();
        }
        return $response;
    }


    public function notFound(): Response
    {
        $response = new Response(404, '', null);

        try {
            $response->responseCode = 404;
            $response->body = $this->twig->render("404.twig.html");
        } catch (\Exception $e) {
            $response->responseCode = 500;
            $response->body = $e->getMessage();
        }
        return $response;
    }

    public function redirect(string $url): Response
    {
        $response = new Response();
        $response->responseCode = 302;
        $response->headers = "Location: " . $url;
        return $response;
    }

    public function internalError(): Response
    {
        $response = new Response();
        try {
            $response->responseCode = 500;
            $response->body = $this->twig->render('500.html.twig');
            return $response;
        } catch (\Exception $e) {
            $response->responseCode = 500;
            $response->body = $e->getMessage();
            return $response;
        }
    }

}
