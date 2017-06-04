<?php

namespace MyApp\Infrastructure\Persistence\InMemory;

use MyApp\Domain\User;
use MyApp\Domain\UserCollection;
use MyApp\Domain\UserId;
use MyApp\Domain\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package MyApp\Infrastructure\Persistence\InMemory
 */
final class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAll() : UserCollection
    {
        return UserCollection::fromArray(
            [
                User::fromArray([
                    'id' => UserId::fromString(123),
                    'name' => 'John',
                    'age' => 30
                ]),
                User::fromArray([
                    'id' => UserId::fromString(245),
                    'name' => 'Peter',
                    'age' => 10
                ]),
                User::fromArray([
                    'id' => UserId::fromString(368),
                    'name' => 'Jack',
                    'age' => 35
                ])
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(UserId $userId): ?User
    {
        return User::fromArray([
            'id' => UserId::fromString(245),
            'name' => 'Peter',
            'age' => 10
        ]);
    }
}