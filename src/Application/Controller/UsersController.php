<?php

namespace MyApp\Application\Controller;

use JMS\Serializer\SerializerInterface;
use MyApp\Domain\User;
use MyApp\Domain\UserId;
use MyApp\Domain\UserNotFoundException;
use MyApp\Domain\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UsersController
 * @package MyApp\Application\Controller
 */
final class UsersController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    /**
     * UsersController constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer,
        UserRepositoryInterface $userRepo
    ) {
        $this->serializer = $serializer;
        $this->userRepo = $userRepo;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getAll(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) : ResponseInterface {

        $users = $this->userRepo->findAll();

        $response->getBody()->write(
            $this->serializer->serialize([
                'data' => $users->toArray()
            ], 'json')
        );

        return $response->withStatus(200);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function getById(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) : ResponseInterface {

        $userId = UserId::fromString($args['id']);
        $user = $this->userRepo->findOneById($userId);

        if (null === $user) {
            $response->getBody()->write(
                $this->serializer->serialize([
                    'error' => sprintf('User with id: %s was not found', $userId)
                ], 'json')
            );
            return $response->withStatus(404);
        }

        $response->getBody()->write(
            $this->serializer->serialize($user, 'json')
        );

        return $response->withStatus(200);
    }
}