<?php

namespace MyApp\Domain;

/**
 * Class UserCollection
 * @package MyApp\Domain
 */
final class UserCollection
{
    private $users;

    /**
     * UserCollection constructor.
     * @param $users
     */
    private function __construct($users)
    {
        $this->users = $users;
    }

    public function add(User $user)
    {
        $this->users[(string)$user->getId()] = $user;
    }

    /**
     * @param string $userId
     * @return User|null
     */
    public function get(string $userId) : ?User
    {
        if ($this->containsKey($userId)) {
            return $this->users[$userId];
        }

        return null;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function containsKey(string $id) : bool
    {
        if (null === $this->users[$id]) {
            return true;
        }

        return false;
    }

    /**
     * @param array $users
     * @return UserCollection
     */
    public static function fromArray(array $users) : UserCollection
    {
        return new self($users);
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return $this->users;
    }
}