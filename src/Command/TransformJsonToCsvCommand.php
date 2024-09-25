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

        // Definir todas las cabeceras incluyendo propiedades anidadas
        fputcsv($csvFile, [
            'ID', 'First Name', 'Last Name', 'Email', 'Age', 'Gender', 'Phone', 'Username', 'Password',
            'Birth Date', 'Image', 'Blood Group', 'Height', 'Weight', 'Eye Color', 'Hair Color', 'Hair Type',
            'IP', 'Address', 'City', 'State', 'State Code', 'Postal Code', 'Country',
            'MAC Address', 'University', 'Bank Card Expire', 'Bank Card Number', 'Bank Card Type', 'Currency', 'IBAN',
            'Company Name', 'Company Department', 'Company Title', 'Company Address', 'Company City',
            'Company State', 'Company Postal Code', 'Company Country', 'Company Coordinates (Lat)', 'Company Coordinates (Lng)',
            'EIN', 'SSN', 'User Agent', 'Crypto Coin', 'Crypto Wallet', 'Crypto Network', 'Role'
        ]);

        // Escribir datos en el archivo CSV
        foreach ($data['users'] as $user) {
            fputcsv($csvFile, [
                $user['id'],
                $user['firstName'],
                $user['lastName'],
                $user['email'],
                $user['age'],
                $user['gender'],
                $user['phone'] ?? 'N/A',
                $user['username'] ?? 'N/A',
                $user['password'] ?? 'N/A',
                $user['birthDate'] ?? 'N/A',
                $user['image'] ?? 'N/A',
                $user['bloodGroup'] ?? 'N/A',
                $user['height'] ?? 'N/A',
                $user['weight'] ?? 'N/A',
                $user['eyeColor'] ?? 'N/A',
                $user['hair']['color'] ?? 'N/A',
                $user['hair']['type'] ?? 'N/A',
                $user['ip'] ?? 'N/A',
                $user['address']['address'] ?? 'N/A',
                $user['address']['city'] ?? 'N/A',
                $user['address']['state'] ?? 'N/A',
                $user['address']['stateCode'] ?? 'N/A',
                $user['address']['postalCode'] ?? 'N/A',
                $user['address']['country'] ?? 'N/A',
                $user['macAddress'] ?? 'N/A',
                $user['university'] ?? 'N/A',
                $user['bank']['cardExpire'] ?? 'N/A',
                $user['bank']['cardNumber'] ?? 'N/A',
                $user['bank']['cardType'] ?? 'N/A',
                $user['bank']['currency'] ?? 'N/A',
                $user['bank']['iban'] ?? 'N/A',
                $user['company']['name'] ?? 'N/A',
                $user['company']['department'] ?? 'N/A',
                $user['company']['title'] ?? 'N/A',
                $user['company']['address']['address'] ?? 'N/A',
                $user['company']['address']['city'] ?? 'N/A',
                $user['company']['address']['state'] ?? 'N/A',
                $user['company']['address']['postalCode'] ?? 'N/A',
                $user['company']['address']['country'] ?? 'N/A',
                $user['company']['address']['coordinates']['lat'] ?? 'N/A',
                $user['company']['address']['coordinates']['lng'] ?? 'N/A',
                $user['ein'] ?? 'N/A',
                $user['ssn'] ?? 'N/A',
                $user['userAgent'] ?? 'N/A',
                $user['crypto']['coin'] ?? 'N/A',
                $user['crypto']['wallet'] ?? 'N/A',
                $user['crypto']['network'] ?? 'N/A',
                $user['role'] ?? 'N/A'
            ]);
        }

        fclose($csvFile);

        $output->writeln("Data transformed and saved to $csvFilename.");
        return Command::SUCCESS;
    }
}
