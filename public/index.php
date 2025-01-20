<?php

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../src/dependencies.php';
AppFactory::setContainer($container);


$app = AppFactory::create();



$routes = require __DIR__ . '/../src/routes/routes.php';
$routes($app);

$app->add(function ($request, $handler) {
    $routes = $this->getRouteCollector()->getRoutes();
    foreach ($routes as $route) {
        echo $route->getPattern() . PHP_EOL;
    }
    return $handler->handle($request);
});

$app->run();
