<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

#[AsCommand(
    name: 'ExtractDataCommand',
    description: 'Add a short description for your command',
)]
class ExtractDataCommand extends Command
{
    protected static $defaultName = 'app:extract-data';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://dummyjson.com/users');
        $data = $response->toArray();

        $filename = 'data_' . date('Ymd') . '.json';
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        $output->writeln('Data extracted and saved to ' . $filename);
        return Command::SUCCESS;
    }
}
