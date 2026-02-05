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
                return call_user_func($route->callback);
            }
        }
        return new Response(404, '404 page not found' . $request->path, null);
    }

    /**
     * @param string $methode
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function addRoute(string $methode, string $path, callable $callback): void
    {
        $this->routes[] = new Route($methode, $path, $callback);
    }
}
