<?php

namespace MyApp\Domain;

/**
 * Class User
 * @package MyApp\Application\Domain
 */
final class User
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * User constructor.
     * @param UserId $id
     * @param string $name
     * @param int $age
     */
    private function __construct(UserId $id, string $name, int $age)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return UserId
     */
    public function getId() : UserId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge() : int
    {
        return $this->age;
    }

    /**
     * @param array $data
     * @return User
     */
    public static function fromArray(array $data) : User
    {
        return new self(
            UserId::fromString($data['id']),
            $data['name'],
            $data['age']
        );
    }
}