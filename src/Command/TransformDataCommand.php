<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:transform-data',
    description: 'Transforms JSON data to CSV format'
)]
class TransformDataCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonFilename = 'data_' . date('Ymd') . '.json';
        $csvFilename = 'ETL_' . date('Ymd') . '.csv';


        if (!file_exists($jsonFilename)) {
            $output->writeln("Error: The file $jsonFilename does not exist.");
            return Command::FAILURE;
        }


        $data = json_decode(file_get_contents($jsonFilename), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $output->writeln("Error: The JSON file $jsonFilename is invalid.");
            return Command::FAILURE;
        }

        $csvFile = fopen($csvFilename, 'w');
        if ($csvFile === false) {
            $output->writeln("Error: Could not open the file $csvFilename for writing.");
            return Command::FAILURE;
        }


        fputcsv($csvFile, ['ID', 'Name', 'Email']);
        foreach ($data['users'] as $user) {
            fputcsv($csvFile, [$user['id'], $user['name'], $user['email']]);
        }

        fclose($csvFile);

        $output->writeln("Data transformed and saved to $csvFilename.");
        return Command::SUCCESS;
    }
}
