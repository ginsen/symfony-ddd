<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Console;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

trait TraitLogger
{
    protected function createLogger(OutputInterface $output): void
    {
        $verbosityLevelMap = $output->getVerbosity() <= OutputInterface::VERBOSITY_NORMAL
            ? []
            : [
                LogLevel::NOTICE => OutputInterface::VERBOSITY_VERBOSE,
                LogLevel::INFO   => OutputInterface::VERBOSITY_VERBOSE,
            ];

        $this->appLogger->setLogger(
            new ConsoleLogger($output, $verbosityLevelMap)
        );
    }


    public function logger(): LoggerInterface
    {
        return $this->appLogger;
    }
}
