<?php

namespace App\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:validate-db-connection',
    description: 'Validates the connection to the MySQL database'
)]
class ValidateDbConnectionCommand extends Command
{
    private $connection;

    public function __construct(Connection $connection)
    {
        parent::__construct();
        $this->connection = $connection;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            // Intenta conectarse a la base de datos
            $this->connection->connect();

            if ($this->connection->isConnected()) {
                $output->writeln('Connection to the MySQL database was successful!');
                return Command::SUCCESS;
            } else {
                $output->writeln('Failed to connect to the MySQL database.');
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $output->writeln('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
