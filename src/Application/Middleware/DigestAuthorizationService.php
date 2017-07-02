<?php

namespace MyApp\Application\Middleware;

use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class DigestAuthorizationService
 * @package MyApp\Application\Middleware
 */
final class DigestAuthorizationService implements AuthorizationServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function authorise(ServerRequestInterface $request) : bool
    {
        $token = $request->getHeader('Authorization');
        $onlyToken = trim(substr($token[0], 7));

        try {

            JWT::decode(
                $onlyToken,
                'myexamplekey',
                ['HS512']     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            );

//            echo '<pre>'; print_r($data); exit; echo '</pre>';

        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}