<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Container\DatabaseContainer;
use App\Controller\HomeController;
use App\Util\DatabaseConnector;
use App\Util\Router;

$router = new Router();

$homeController = new HomeController();
$dbConfigContainer = new DatabaseContainer;

DatabaseConnector::getInstance($dbConfigContainer->getDbConfig());

$router->register('home', 'GET', [$homeController, 'index']);

$router->register('about','GET', function () {
    echo "This is the about page.";
});

$uri = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];
$router->resolve($uri, $httpMethod);
