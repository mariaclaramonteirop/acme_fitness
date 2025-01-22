<?php

use Slim\Factory\AppFactory;


require_once __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../src/dependencies.php';
AppFactory::setContainer($container);


$app = AppFactory::create();



$routes = require __DIR__ . '/../src/routes/routes.php';
$routes($app);


// $app->addErrorMiddleware(true, true, true);


$app->run();
