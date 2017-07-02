<?php

namespace MyApp\Application\Middleware;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthenticationMiddleware
 * @package MyApp\Application\Middleware
 */
final class AuthenticationMiddleware
{
    /**
     * @var AuthorizationServiceInterface
     */
    private $service;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * AuthenticationMiddleware constructor.
     * @param AuthorizationServiceInterface $service
     * @param SerializerInterface $serializer
     */
    public function __construct(
        AuthorizationServiceInterface $service,
        SerializerInterface $serializer
    ) {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function authenticate(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) : ResponseInterface {

        if ($this->service->authorise($request)) {
            return $next($request, $response);
        }

        $response->getBody()->write(
                $this->serializer->serialize([
                    'error' => 'Authorization failed'
                ], 'json')
            );

        return $response->withStatus(401);
    }
}