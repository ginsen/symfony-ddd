<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Service\EntityPersistInterface;
use App\Domain\Service\Logger\AppLoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class DoctrineEntityPersist implements EntityPersistInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private AppLoggerInterface     $logger,
    ) {}


    public function persist(object $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();

        $this->logger->info('Entity persisted', [
            'entity' => $entity::class,
        ]);
    }


    public function clear(): void
    {
        $this->em->clear();
    }
}
