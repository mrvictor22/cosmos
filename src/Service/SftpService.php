<?php

namespace App\Service;

use phpseclib3\Net\SFTP;
use phpseclib3\Crypt\PublicKeyLoader;
use Symfony\Component\Console\Output\OutputInterface;

class SftpService
{
    private const ENCRYPTION_METHOD = 'aes-256-cbc';
    private const ENCRYPTION_KEY = 'your_encryption_key'; 

    private $sftpHost;
    private $sftpUser;
    private $privateKeyPath;
    private $output;

    public function __construct(string $sftpHost, string $sftpUser, string $privateKeyPath, OutputInterface $output)
    {
        $this->sftpHost = $sftpHost;
        $this->sftpUser = $sftpUser;
        $this->privateKeyPath = $privateKeyPath;
        $this->output = $output;
    }

    public function uploadFiles(array $files): bool
    {
       
        $privateKey = PublicKeyLoader::loadPrivateKey(file_get_contents($this->privateKeyPath));

        $sftp = new SFTP($this->sftpHost);
        if (!$sftp->login($this->sftpUser, $privateKey)) {
            $this->output->writeln('Error: Login to SFTP failed with RSA/PPK key.');
            return false;
        }

        $this->output->writeln('Conectado exitosamente al SFTP.');

        foreach ($files as $file) {
            if (!file_exists($file)) {
                $this->output->writeln("Error: El archivo $file no existe.");
                continue;
            }

            $this->encryptFile($file);

            $encryptedFile = $file . '.enc';
            if (!$sftp->put($encryptedFile, file_get_contents($encryptedFile))) {
                $this->output->writeln("Error: No se pudo subir el archivo $encryptedFile.");
                return false;
            } else {
                $this->output->writeln("Archivo $encryptedFile subido exitosamente.");
            }
        }

        return true;
    }

    private function encryptFile(string $file): void
    {
        $fileContent = file_get_contents($file);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::ENCRYPTION_METHOD));
        $encryptedContent = openssl_encrypt($fileContent, self::ENCRYPTION_METHOD, self::ENCRYPTION_KEY, 0, $iv);
        $encryptedFile = $file . '.enc';
        file_put_contents($encryptedFile, $iv . $encryptedContent);
    }
}
