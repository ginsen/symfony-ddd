<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use Assert\Assertion;

trait FloatTrait
{
    private float $value;


    public static function fromFloat($value): self
    {
        self::checkAssertion($value);

        Assertion::max($value, 100, 'Must be smaller or equal than hundred');

        $instance        = new static();
        $instance->value = (float) $value;

        return $instance;
    }


    public function toFloat(): float
    {
        return $this->value;
    }


    /**
     * @param mixed $value
     * @throws
     */
    private static function checkAssertion($value): void
    {
        Assertion::true(0 == $value - (float) $value, 'Must be float');
        Assertion::min($value, 0, 'Must be greater or equal than zero');
    }


    private function __construct() {}
}
