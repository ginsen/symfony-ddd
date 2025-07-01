<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use App\Domain\Exception\InvalidArgumentException;
use Assert\Assertion;

trait TextTrait
{
    protected string $text;


    protected static function fromString(string $text): self
    {
        static::checkAssertion($text);

        $instance       = new static();
        $instance->text = $text;

        return $instance;
    }


    public static function isValid($text): bool
    {
        try {
            static::checkAssertion($text);
        } catch (InvalidArgumentException) {
            return false;
        }

        return true;
    }


    /**
     * @param mixed $text
     * @throws
     */
    protected static function checkAssertion($text): void
    {
        try {
            Assertion::string($text, 'Must be string');
        } catch (\Exception $exception) {
            throw new InvalidArgumentException($exception->getMessage(), 400);
        }
    }


    public function isEqual(self $obj): bool
    {
        return $this->text === $obj->toStr();
    }


    public function toStr(): string
    {
        return $this->text;
    }


    public function __toString(): string
    {
        return $this->toStr();
    }


    private function __construct() {}
}
