<?php

namespace MyApp\Domain;

/**
 * Class User
 * @package MyApp\Application\Domain
 */
final class UserId
{
    /**
     * @var string
     */
    private $value;

    /**
     * UserId constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        // Sanity check
        $this->value = $value;
    }

    /**
     * @param string $id
     * @return UserId
     */
    public static function fromString(string $id) : UserId
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->value;
    }
}