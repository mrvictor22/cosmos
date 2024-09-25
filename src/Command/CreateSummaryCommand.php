<?php

namespace App\Command;

use App\Entity\Detail;
use App\Entity\Summary;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSummaryCommand extends Command
{

    protected static $defaultName = 'app:create-summary';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Crear el resumen
        $summary = new Summary();
        $summary->setTotalUsers(100);  // Cambia este número por el total de usuarios reales
        $summary->setExtractionDate(new \DateTime());

        $this->entityManager->persist($summary);
        $this->entityManager->flush();

        // Crear detalles
        $data = json_decode(file_get_contents('data_' . date('Ymd') . '.json'), true);
        foreach ($data['users'] as $user) {
            $detail = new Detail();
            $detail->setSummary($summary);
            $detail->setUserId($user['id']);
            $detail->setUserName($user['name']);
            $detail->setUserEmail($user['email']);

            $this->entityManager->persist($detail);
        }

        $this->entityManager->flush();

        $output->writeln('Summary and details saved to the database.');

        return Command::SUCCESS;
    }
}