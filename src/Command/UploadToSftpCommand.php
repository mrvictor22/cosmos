<?php

namespace App\Command;

use phpseclib3\Net\SFTP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UploadToSftpCommand extends Command
{
    protected static $defaultName = 'app:upload-to-sftp';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Configuración del SFTP (puedes usar variables de entorno o directamente en el código)
        $sftpHost = $_ENV['SFTP_HOST'];
        $sftpUser = $_ENV['SFTP_USER'];
        $sftpPassword = $_ENV['SFTP_PASSWORD'];

        // Crear una nueva conexión SFTP
        $sftp = new SFTP($sftpHost);
        if (!$sftp->login($sftpUser, $sftpPassword)) {
            $output->writeln('Error: Login to SFTP failed.');
            return Command::FAILURE;
        }

        $output->writeln('Conectado exitosamente al SFTP.');

        
        $files = [
            'data_' . date('Ymd') . '.json',
            'ETL_' . date('Ymd') . '.csv',
            'summary_' . date('Ymd') . '.csv'
        ];

        foreach ($files as $file) {
            if (!file_exists($file)) {
                $output->writeln("Error: El archivo $file no existe.");
                continue;
            }
            if (!$sftp->put($file, file_get_contents($file))) {
                $output->writeln("Error: No se pudo subir el archivo $file.");
                return Command::FAILURE;
            } else {
                $output->writeln("Archivo $file subido exitosamente.");
            }
        }

        $output->writeln('Todos los archivos fueron subidos exitosamente.');
        return Command::SUCCESS;
    }
}
