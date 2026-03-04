<?php

namespace Framework;

use Framework\Router;
use Exception;

class Kernel
{
    private Router $router;

    private ResponseFactory $responseFactory;
    private ServiceContainer $serviceContainer;

    private ConfigManager $configManager;

    /**
     * @param array<string> $config
     * @throws Exception
     */
    public function __construct(array $config = [])
    {
        $this->configManager = new ConfigManager($config);
        $debugMode = $this->configManager->get('APP_DEBUG');
        $viewPath = $this->configManager->get('APP_VIEW_PATH');
        $dbName = $this->configManager->get('APP_DB');
        $this->serviceContainer = new ServiceContainer();

        $database = new Database(__DIR__ . '/../' . $dbName);
        $this->serviceContainer->set(Database::class, $database);
        $this->responseFactory = new ResponseFactory($debugMode, $viewPath);
        $this->serviceContainer->set(ResponseFactory::class, $this->responseFactory);
        $this->router = new Router($this->responseFactory);
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

    public function getDatabase(): Database
    {
        return $this->serviceContainer->get(Database::class);
    }
}
