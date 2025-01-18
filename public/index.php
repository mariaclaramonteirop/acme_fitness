<?php

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$container = 
$app = AppFactory::create();

$routes = require __DIR__ . '/../src/routes.php';

$app->run();
