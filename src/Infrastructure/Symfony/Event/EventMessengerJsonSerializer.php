<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Event;

use App\Domain\Event\EventInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class EventMessengerJsonSerializer implements SerializerInterface
{
    public function encode(Envelope $envelope): array
    {
        /** @var EventInterface $event */
        $event     = $envelope->getMessage();
        $allStamps = [];
        foreach ($envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }

        return [
            'body' => json_encode($event->payload()),
        ];
    }
    public function decode(array $encodedEnvelope): Envelope
    {
        throw new \LogicException('Not implemented');
    }
}
