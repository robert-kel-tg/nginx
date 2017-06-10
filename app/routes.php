<?php

use MyApp\Application\Controller\UsersController;

$route->map('GET', '/users', [new UsersController($serializer, $userRepo), 'getAll']);
$route->map('GET', '/users/{id}', [new UsersController($serializer, $userRepo), 'getById']);