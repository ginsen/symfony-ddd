<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Service\Logger\AppLoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class BaseController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $eventBus,
        protected AppLoggerInterface         $logger,
    ) {}


    public function queryHandler($command)
    {
        $envelope = $this->queryBus->dispatch($command);

        return $envelope->last(HandledStamp::class)?->getResult();
    }


    public function commandHandler($command)
    {
        $envelope = $this->commandBus->dispatch($command);

        return $envelope->last(HandledStamp::class)?->getResult();
    }


    public function eventHandler($event): void
    {
        $this->eventBus->dispatch($event);
    }


    protected function responseException(\Exception $exception): Response
    {
        return new JsonResponse([
            'error' => $exception->getMessage(),
        ], $this->codeException2httpCode($exception->getCode()));
    }


    private function codeException2httpCode(int $code): int
    {
        return match ($code) {
            400     => Response::HTTP_BAD_REQUEST,
            401     => Response::HTTP_UNAUTHORIZED,
            404     => Response::HTTP_NOT_FOUND,
            default => Response::HTTP_INTERNAL_SERVER_ERROR,
        };
    }
}
