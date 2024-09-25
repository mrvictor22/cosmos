<?php

namespace App\Command;

use phpseclib3\Net\SFTP;
use phpseclib3\Crypt\PublicKeyLoader;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:upload-to-sftp',
    description: 'Uploads encrypted files to SFTP server using RSA/PPK authentication'
)]
class UploadToSftpCommand extends Command
{
    private const ENCRYPTION_METHOD = 'aes-256-cbc';
    private const ENCRYPTION_KEY = 'your_encryption_key'; // Debe ser una clave segura

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sftpHost = $_ENV['SFTP_HOST'];
        $sftpUser = $_ENV['SFTP_USER'];
        $privateKeyPath = $_ENV['SFTP_PRIVATE_KEY'];
        $privateKey = PublicKeyLoader::loadPrivateKey(file_get_contents($privateKeyPath));

        $sftp = new SFTP($sftpHost);
        if (!$sftp->login($sftpUser, $privateKey)) {
            $output->writeln('Error: Login to SFTP failed with RSA/PPK key.');
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

            // Leer contenido del archivo y encriptarlo
            $fileContent = file_get_contents($file);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::ENCRYPTION_METHOD));
            $encryptedContent = openssl_encrypt($fileContent, self::ENCRYPTION_METHOD, self::ENCRYPTION_KEY, 0, $iv);
            $encryptedFile = $file . '.enc';
            file_put_contents($encryptedFile, $iv . $encryptedContent);

            // Subir archivo encriptado
            if (!$sftp->put($encryptedFile, file_get_contents($encryptedFile))) {
                $output->writeln("Error: No se pudo subir el archivo $encryptedFile.");
                return Command::FAILURE;
            } else {
                $output->writeln("Archivo $encryptedFile subido exitosamente.");
            }
        }

        $output->writeln('Todos los archivos fueron subidos exitosamente.');
        return Command::SUCCESS;
    }
}
