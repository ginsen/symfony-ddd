<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Logger;

use App\Domain\Service\Logger\AppLoggerInterface;
use Psr\Log\LoggerInterface;

class AppLogger implements AppLoggerInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}


    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }


    public function emergency(\Stringable|string $message, array $context = []): void
    {
        $this->logger->emergency($message, $context);
    }


    public function alert(\Stringable|string $message, array $context = []): void
    {
        $this->logger->alert($message, $context);
    }


    public function critical(\Stringable|string $message, array $context = []): void
    {
        $this->logger->critical($message, $context);
    }


    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }


    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }


    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->logger->notice($message, $context);
    }


    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }


    public function debug(\Stringable|string $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }


    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->logger->log($level, $message, $context);
    }
}
