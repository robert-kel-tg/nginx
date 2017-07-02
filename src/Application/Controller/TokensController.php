<?php

namespace MyApp\Application\Controller;

use Firebase\JWT\JWT;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class TokensController
 * @package MyApp\Application\Controller
 */
final class TokensController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function createToken(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) : ResponseInterface {

        $queryParams = $request->getQueryParams();

        // Password verify

        if ($queryParams['password'] !== 'test') {
            $response->getBody()->write(
                $this->serializer->serialize([
                    'error' => 'Unauthorized: Access is denied due to invalid credentials'
                ], 'json')
            );
            return $response->withStatus(401);
        }

        // Generate JWT token

        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;             //Adding 10 seconds
        $expire     = $notBefore + 3600;            // Adding 60 minutes

        $jwtToken = JWT::encode(
            [
                'iss' => 'http://php-docker.local:7070', //Issuer
                'aud' => 'http://php-docker.local:7070',
                'iat' => $issuedAt, // Issued at: time when the token was generated
                'nbf' => $notBefore, // Timestamp of when the token should start being considered valid.
                'exp' => $expire,     // Timestamp of when the token should cease to be valid.
                'data' => [
                    'userId' => 12345,
                    'userName' => 'John'
                ]
            ],
            'myexamplekey',
            'HS512'
        );

        $response->getBody()->write(
            $this->serializer->serialize([
                'access_token' => $jwtToken,
                'expires_in' => $expire
            ], 'json')
        );

        return $response->withStatus(200);
    }
}