<?php

namespace Framework;

class Router
{
    /** @var Route[] */
    public array $routes;

    public function __construct()
    {
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                return new Response(200, 'Er is een match ' . $request->path, null);
            }
        }
        return new Response(404, 'Geen match' . $request->path, null);
    }

    /**
     * @param string $methode
     * @param string $path
     * @param string $return
     * @return void
     */
    public function addRoute(string $methode, string $path, string $return): void
    {
        $this->routes[] = new Route($methode, $path, $return);
    }
}
