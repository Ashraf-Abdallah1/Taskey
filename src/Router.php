<?php

namespace Framework;

use phpDocumentor\Reflection\Types\This;

class Router
{
    /** @var Route[] */
    public array $routes;
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                //body -> tekst probleem
                return call_user_func($route->callback);
//                return $this->responseFactory->body(call_user_func($route->callback));
            }
        }
        return $this->responseFactory->notFound();
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
