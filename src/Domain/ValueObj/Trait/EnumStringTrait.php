<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

trait EnumStringTrait
{
    public static function isValid($value): bool
    {
        try {
            if (empty($value) || !\is_string($value)) {
                return false;
            }

            return null !== self::tryFrom($value);
        } catch (\Exception|\Error) {
            return false;
        }
    }


    public function isEqual(self $enum): bool
    {
        return $this->value === $enum->value;
    }


    public function toStr(): string
    {
        return $this->value;
    }
}
