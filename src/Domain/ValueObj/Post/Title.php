<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Post;

use App\Domain\ValueObj\Trait\VarcharTrait;

class Title
{
    public const MAX_LENGTH = 256;

    use VarcharTrait;

    public static function fromStr(string $title): self
    {
        return self::fromString($title);
    }
}
