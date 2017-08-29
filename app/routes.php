<?php

use MyApp\Application\Controller\UsersController;
use MyApp\Application\Controller\TokensController;

$route->map('GET', '/users', [new UsersController($serializer, $userRepo), 'getAll']);
$route->map('GET', '/users/{id}', [new UsersController($serializer, $userRepo), 'getById']);
$route
    ->map('PUT', '/users/{id}', [new UsersController($serializer, $userRepo), 'putById'])
    ->middleware($authenticationMiddleware);
$route->map('POST', '/token', [new TokensController($serializer), 'createToken']);