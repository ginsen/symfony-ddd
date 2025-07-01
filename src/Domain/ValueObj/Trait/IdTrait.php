<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use Assert\Assertion;

trait IdTrait
{
    private int $numId;


    protected static function fromInteger(int $numId): self
    {
        self::checkAssertion($numId);

        $instance        = new static();
        $instance->numId = $numId;

        return $instance;
    }


    /**
     * @throws
     */
    public static function checkAssertion(int $numId): bool
    {
        Assertion::notEmpty($numId, 'Is empty');
        Assertion::integer($numId, 'Must be integer');
        Assertion::min($numId, 1, 'Must be greater than zero');

        return true;
    }


    public function toInt(): int
    {
        return $this->numId;
    }


    public function isEqual(self $numId): bool
    {
        return $this->toInt() === $numId->toInt();
    }


    private function __construct() {}
}
