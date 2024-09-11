<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TransformDataCommand extends Command
{
    protected static $defaultName = 'app:transform-data';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonFilename = 'data_' . date('Ymd') . '.json';
        $csvFilename = 'ETL_' . date('Ymd') . '.csv';

        $data = json_decode(file_get_contents($jsonFilename), true);
        $csvFile = fopen($csvFilename, 'w');

        fputcsv($csvFile, ['ID', 'Name', 'Email']); // Cabeceras del CSV
        foreach ($data['users'] as $user) {
            fputcsv($csvFile, [$user['id'], $user['name'], $user['email']]);
        }

        fclose($csvFile);
        $output->writeln('Data transformed and saved to ' . $csvFilename);

        return Command::SUCCESS;
    }
}
