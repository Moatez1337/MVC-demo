<?php

declare(strict_types=1);

namespace App\Util\Router;
class Router
{
    private array $routes = [];

    public function register(string $route, string $httpMethod, callable $callback): void
    {
        $route = trim($route, '/');
        $this->routes[$httpMethod][$route] = $callback;
    }

    public function resolve(string $uri, string $httpMethod): void
    {
        $uri = trim($uri, '/');
        if (isset($this->routes[$httpMethod][$uri])) {
            $this->routes[$httpMethod][$uri]();
        } else {
            http_response_code(404);
        }
    }
}
