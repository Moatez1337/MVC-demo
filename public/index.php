<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Container\DiContainer;
use App\Controller\CharacterController;
use App\Controller\HomeController;
use App\Repository\CharacterRepository;
use App\Util\DatabaseConfig;
use App\Util\Router;


$container = new DiContainer();
$dbConfig = $container->get(DatabaseConfig::class);

$characterRepo = new CharacterRepository($dbConfig);

$router = new Router();
$homeController = new HomeController();
$characterController = new CharacterController($characterRepo);

$router->register('home', 'GET', [$homeController, 'index']);

$router->register('character', 'GET', [$characterController, 'index']);

$uri = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];
$router->resolve($uri, $httpMethod);
