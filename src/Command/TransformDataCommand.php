<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:transform-data',
    description: 'Transforms JSON data to CSV format as per the example given in the test'
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

        $totalUsers = count($data['users']);
        $genderStats = ['male' => 0, 'female' => 0, 'other' => 0];
        $ageStats = [
            '00-10' => ['male' => 0, 'female' => 0, 'other' => 0],
            '11-20' => ['male' => 0, 'female' => 0, 'other' => 0],
            '21-30' => ['male' => 0, 'female' => 0, 'other' => 0],
            '31-40' => ['male' => 0, 'female' => 0, 'other' => 0],
            '41-50' => ['male' => 0, 'female' => 0, 'other' => 0],
            '51-60' => ['male' => 0, 'female' => 0, 'other' => 0],
            '61-70' => ['male' => 0, 'female' => 0, 'other' => 0],
            '71-80' => ['male' => 0, 'female' => 0, 'other' => 0],
            '81-90' => ['male' => 0, 'female' => 0, 'other' => 0],
            '91+' => ['male' => 0, 'female' => 0, 'other' => 0],
        ];
        $cityStats = [];

        foreach ($data['users'] as $user) {
            // Contar géneros
            $gender = strtolower($user['gender']) ?? 'other';
            if (isset($genderStats[$gender])) {
                $genderStats[$gender]++;
            } else {
                $genderStats['other']++;
            }

            // Contar edades por género
            $age = $user['age'] ?? 0;
            if ($age <= 10) {
                $ageStats['00-10'][$gender]++;
            } elseif ($age <= 20) {
                $ageStats['11-20'][$gender]++;
            } elseif ($age <= 30) {
                $ageStats['21-30'][$gender]++;
            } elseif ($age <= 40) {
                $ageStats['31-40'][$gender]++;
            } elseif ($age <= 50) {
                $ageStats['41-50'][$gender]++;
            } elseif ($age <= 60) {
                $ageStats['51-60'][$gender]++;
            } elseif ($age <= 70) {
                $ageStats['61-70'][$gender]++;
            } elseif ($age <= 80) {
                $ageStats['71-80'][$gender]++;
            } elseif ($age <= 90) {
                $ageStats['81-90'][$gender]++;
            } else {
                $ageStats['91+'][$gender]++;
            }

            // Contar ciudades
            $city = $user['address']['city'] ?? 'Unknown';
            if (!isset($cityStats[$city])) {
                $cityStats[$city] = ['male' => 0, 'female' => 0, 'other' => 0];
            }
            $cityStats[$city][$gender]++;
        }

        // Escribir las estadísticas en el archivo CSV
        fputcsv($csvFile, ['register', $totalUsers]);

        // Escribir estadísticas de género
        fputcsv($csvFile, ['gender', 'male', 'female', 'other']);
        fputcsv($csvFile, [
            'Gender Totals',
            $genderStats['male'],
            $genderStats['female'],
            $genderStats['other']
        ]);

        // Escribir estadísticas de edad por género
        fputcsv($csvFile, ['age', 'male', 'female', 'other']);
        foreach ($ageStats as $ageRange => $counts) {
            fputcsv($csvFile, [$ageRange, $counts['male'], $counts['female'], $counts['other']]);
        }

        // Escribir estadísticas de ciudad
        fputcsv($csvFile, ['City', 'male', 'female', 'other']);
        foreach ($cityStats as $city => $genders) {
            fputcsv($csvFile, [
                $city,
                $genders['male'],
                $genders['female'],
                $genders['other']
            ]);
        }

        fclose($csvFile);

        $output->writeln("Data transformed and saved to $csvFilename.");
        return Command::SUCCESS;
    }
}
