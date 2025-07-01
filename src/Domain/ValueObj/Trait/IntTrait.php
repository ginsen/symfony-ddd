<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use Assert\Assertion;

trait IntTrait
{
    private int $value;


    protected static function fromInteger($value): self
    {
        static::checkAssertion($value);

        $instance        = new static();
        $instance->value = $value;

        return $instance;
    }


    public static function isValid($value): bool
    {
        try {
            static::checkAssertion($value);

            return true;
        } catch (\Exception) {
            return false;
        }
    }


    public function isEqual(self $value): bool
    {
        return $this->toInt() === $value->toInt();
    }


    public function toInt(): int
    {
        return $this->value;
    }


    /**
     * @param mixed $value
     * @throws
     */
    private static function checkAssertion($value): void
    {
        Assertion::integer($value, 'Must be integer');
    }


    private function __construct() {}
}
