<?php

declare(strict_types=1);

namespace App\Application\Command\Post\Create;

class CreatePostCommandHandler
{
    public function __invoke(CreatePostCommand $command): bool
    {
        return true;
    }
}
