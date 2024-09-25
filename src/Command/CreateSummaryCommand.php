<?php

namespace App\Command;

use App\Entity\Detail;
use App\Entity\Summary;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-summary',
    description: 'Creates a summary and saves details to the database. Point 4 of the steps'
)]
class CreateSummaryCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Leer datos del archivo summary_[YYYYMMDD].json
        $data = json_decode(file_get_contents('data_' . date('Ymd') . '.json'), true);

        // Crear el resumen
        $summary = new Summary();
        $totalUsers = count($data['users']);
        $summary->setTotalUsers($totalUsers);
        $summary->setExtractionDate(new \DateTime()); // Insertion date

        $this->entityManager->persist($summary);
        $this->entityManager->flush();

        // Procesar archivo CSV ETL_[YYYYMMDD].csv
        $csvFilename = 'ETL_' . date('Ymd') . '.csv';
        if (file_exists($csvFilename)) {
            if (($handle = fopen($csvFilename, 'r')) !== false) {
                fgetcsv($handle); // Leer encabezados y descartarlos
                while (($row = fgetcsv($handle)) !== false) {
                    $detail = new Detail();
                    $detail->setSummary($summary);
                    $detail->setUserId($row[0]); // Asume que la primera columna es el ID
                    $detail->setUserName($row[1]);
                    $detail->setUserEmail($row[2]);

                    $this->entityManager->persist($detail);
                }
                fclose($handle);
            }
        }

        $this->entityManager->flush();

        $output->writeln('Summary and details saved to the database from both JSON and CSV.');

        return Command::SUCCESS;
    }
}
