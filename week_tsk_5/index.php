<?php

include 'vendor/autoload.php';
require "src/boostrap.php";



$route = new \Core\Route();
$route->add('/', \App\Controller\UserController::class);

$app = new \Core\Application($route);
$app->run();