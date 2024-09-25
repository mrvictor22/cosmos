<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:transform-json-to-csv',
    description: 'Transforms JSON data to a CSV file with the format ETL_[YYYYMMDD].csv'
)]
class TransformJsonToCsvCommand extends Command
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

        // Escribir encabezados al archivo CSV
        fputcsv($csvFile, ['ID', 'First Name', 'Last Name', 'Email', 'Age', 'Gender', 'City']);

        // Escribir datos al archivo CSV
        foreach ($data['users'] as $user) {
            fputcsv($csvFile, [
                $user['id'],
                $user['firstName'],
                $user['lastName'],
                $user['email'],
                $user['age'],
                $user['gender'],
                $user['address']['city'] ?? 'Unknown'
            ]);
        }

        fclose($csvFile);

        $output->writeln("Data transformed and saved to $csvFilename.");
        return Command::SUCCESS;
    }
}
