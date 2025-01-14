<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Usage: php console app:hello
 * Manually register each Command class in console script file
 */
class HelloCommand extends Command
{
    protected static string $defaultName = 'app:hello';

    protected function configure(): void
    {
        $this->setDescription('Confirms Commands can be called');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello World!');

        return Command::SUCCESS;
    }
}
