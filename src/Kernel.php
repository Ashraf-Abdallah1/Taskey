<?php

namespace Framework;

use Framework\Router;

class Kernel
{
    private Router $router;

    private ServiceContainer $serviceContainer;

    public function __construct()
    {
        $this->router = new Router(new ResponseFactory());
        $this->serviceContainer = new ServiceContainer();
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->serviceContainer);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->serviceContainer);
    }
}
