<?php

declare(strict_types=1);

namespace App\Domain\Service\Logger;

use Psr\Log\LoggerInterface;

interface AppLoggerInterface extends LoggerInterface
{
    public function setLogger(LoggerInterface $logger): void;
}
