<?php

namespace MyApp\Domain;

/**
 * Interface UserRepositoryInterface
 * @package MyApp\Domain
 */
interface UserRepositoryInterface
{
    /**
     * @return UserCollection
     */
    public function findAll() : UserCollection;

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function findOneById(UserId $userId) : ?User;
}