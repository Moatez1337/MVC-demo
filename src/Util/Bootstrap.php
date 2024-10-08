<?php

declare(strict_types=1);

namespace App\Util;

use App\Container\DiContainer;
use App\Controller\CharacterController;
use App\Controller\HomeController;
use App\Util\Router\Router;

class Bootstrap{
    private DiContainer $container;
    private Router $router;

    public function __construct()
    {
        $this->container = DiContainer::getInstance();
        $this->router = new Router();
        $this->setupRoutes();
    }

    private function setupRoutes(): void
    {
        $homeController = new HomeController();
        $characterController = $this->container->get(CharacterController::class);

        $this->router->register('home', 'GET', [$homeController, 'index']);
        $this->router->register('character', 'GET', [$characterController, 'index']);
    }

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->router->resolve($uri, $httpMethod);
    }
}
