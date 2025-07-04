<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RegenerateAppSecret extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $a      = '0123456789abcdef';
        $secret = '';
        for ($i = 0; $i < 32; ++$i) {
            $secret .= $a[rand(0, 15)];
        }

        shell_exec('sed -i -E "s/^APP_SECRET=.{32}$/APP_SECRET=' . $secret . '/" .env*');

        $io->success('New APP_SECRET was generated: ' . $secret);

        return Command::SUCCESS;
    }
}
