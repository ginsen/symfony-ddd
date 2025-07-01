<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Console;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

trait TraitEventWatcher
{
    private string    $eventWatcher;
    private Stopwatch $stopWatch;


    protected function initWatcher(): void
    {
        $this->eventWatcher = uniqid('', true);
        $this->stopWatch    = new Stopwatch();
        $this->stopWatch->start($this->eventWatcher);
    }


    protected function stopWatcher(): StopwatchEvent
    {
        return $this->stopWatch->stop($this->eventWatcher);
    }
}
