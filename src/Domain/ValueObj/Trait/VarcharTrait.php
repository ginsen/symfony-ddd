<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use App\Domain\Exception\InvalidArgumentException;
use Assert\Assertion;

trait VarcharTrait
{
    protected string $name;


    protected static function fromString(string $str): self
    {
        self::checkAssertion($str);

        $instance       = new static();
        $instance->name = $str;

        return $instance;
    }


    /**
     * @throws
     */
    protected static function checkAssertion(string $str): void
    {
        try {
            Assertion::notEmpty($str, 'Is empty');
            Assertion::string($str, 'Must be string');
            Assertion::maxLength($str, static::MAX_LENGTH, 'Is too long');
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }


    public function toStr(): string
    {
        return $this->name;
    }


    public function __toString(): string
    {
        return $this->toStr();
    }


    private function __construct() {}
}
