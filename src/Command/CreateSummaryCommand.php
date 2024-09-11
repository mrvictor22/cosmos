<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSummaryCommand extends Command
{
    protected static $defaultName = 'app:create-summary';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csvFilename = 'summary_' . date('Ymd') . '.csv';
        $csvFile = fopen($csvFilename, 'w');

        fputcsv($csvFile, ['Total Users', 'Extraction Date']);
        fputcsv($csvFile, [100, date('Y-m-d')]);

        fclose($csvFile);
        $output->writeln('Summary created and saved to ' . $csvFilename);

        return Command::SUCCESS;
    }
}