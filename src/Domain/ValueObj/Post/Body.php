<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Post;

use App\Domain\ValueObj\Trait\TextTrait;

class Body
{
    use TextTrait;

    public static function fromStr(string $body): self
    {
        return self::fromString($body);
    }
}
