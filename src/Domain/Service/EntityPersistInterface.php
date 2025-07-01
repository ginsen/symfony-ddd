<?php

declare(strict_types=1);

namespace App\Domain\Service;

interface EntityPersistInterface
{
    public function persist(object $entity): void;

    public function clear(): void;
}
