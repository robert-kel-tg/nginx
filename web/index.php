<?php

require_once __DIR__ . '/../vendor/autoload.php';

use League\Container\Container;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use League\Route\RouteCollection;
use JMS\Serializer\SerializerBuilder;

use MyApp\Infrastructure\Persistence\InMemory\UserRepository;

$container = new Container;
$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});
$container->share('emitter', SapiEmitter::class);
$route = new RouteCollection($container);

$serializer = SerializerBuilder::create()->build();

$userRepo = new UserRepository();

require_once __DIR__ . '/../app/routes.php';

$response = $route->dispatch(
    $container->get('request'),
    $container->get('response')
);
$container->get('emitter')->emit($response);