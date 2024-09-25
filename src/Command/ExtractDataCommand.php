<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:extract-data',
    description: 'Extract data from API and save to JSON file'
)]
class ExtractDataCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

       
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://dummyjson.com/users');

       
        if ($response->getStatusCode() !== 200) {
            $io->error('Error: Failed to fetch data from API.');
            return Command::FAILURE;
        }

       
        $data = $response->toArray();
        $filename = 'data_' . date('Ymd') . '.json';

        if (file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)) === false) {
            $io->error('Error: Failed to save data to ' . $filename);
            return Command::FAILURE;
        }

        $io->success('Data extracted and saved to ' . $filename);
        return Command::SUCCESS;
    }
}
