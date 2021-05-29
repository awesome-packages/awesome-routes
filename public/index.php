<?php

require_once __DIR__ . '/../vendor/autoload.php';

$router = new \AwesomeRoutes\Router();
$router->resource('/users', new \Mocks\UserController());
$router->handleRequest();
