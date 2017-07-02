<?php

namespace MyApp\Application\Middleware;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface AuthorizationServiceInterface
 * @package MyApp\Application\Middleware
 */
interface AuthorizationServiceInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function authorise(ServerRequestInterface $request) : bool;
}