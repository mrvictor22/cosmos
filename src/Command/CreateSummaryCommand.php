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
        $summary->setExtractionDate(new \DateTime());

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
                    $detail->setFirstName($row[1]);
                    $detail->setLastName($row[2]);
                    $detail->setEmail($row[3]);
                    $detail->setAge((int)$row[4]);
                    $detail->setGender($row[5]);
                    $detail->setPhone($row[6]);
                    $detail->setUsername($row[7]);
                    $detail->setPassword($row[8]);
                    $detail->setBirthDate(new \DateTime($row[9]));
                    $detail->setImage($row[10]);
                    $detail->setBloodGroup($row[11]);
                    $detail->setHeight((float)$row[12]);
                    $detail->setWeight((float)$row[13]);
                    $detail->setEyeColor($row[14]);
                    $detail->setHairColor($row[15]);
                    $detail->setHairType($row[16]);
                    $detail->setIp($row[17]);
                    $detail->setAddress($row[18]);
                    $detail->setCity($row[19]);
                    $detail->setState($row[20]);
                    $detail->setStateCode($row[21]);
                    $detail->setPostalCode($row[22]);
                    $detail->setCountry($row[23]);
                    $detail->setMacAddress($row[24]);
                    $detail->setUniversity($row[25]);
                    $detail->setBankCardExpire($row[26]);
                    $detail->setBankCardNumber($row[27]);
                    $detail->setBankCardType($row[28]);
                    $detail->setCurrency($row[29]);
                    $detail->setIban($row[30]);
                    $detail->setCompanyName($row[31]);
                    $detail->setCompanyDepartment($row[32]);
                    $detail->setCompanyTitle($row[33]);
                    $detail->setCompanyAddress($row[34]);
                    $detail->setCompanyCity($row[35]);
                    $detail->setCompanyState($row[36]);
                    $detail->setCompanyPostalCode($row[37]);
                    $detail->setCompanyCountry($row[38]);
                    $detail->setCompanyLat((float)$row[39]);
                    $detail->setCompanyLng((float)$row[40]);
                    $detail->setEin($row[41]);
                    $detail->setSsn($row[42]);
                    $detail->setUserAgent($row[43]);
                    $detail->setCryptoCoin($row[44]);
                    $detail->setCryptoWallet($row[45]);
                    $detail->setCryptoNetwork($row[46]);
                    $detail->setRole($row[47]);

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
