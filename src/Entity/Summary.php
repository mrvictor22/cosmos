<?php

namespace App\Entity;

use App\Repository\SummaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SummaryRepository::class)]
class Summary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private $totalUsers;

    #[ORM\Column(type: 'date')]
    private $extractionDate;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTotalUsers(): ?int
    {
        return $totalUsers;
    }

    public function setTotalUsers(int $totalUsers): self
    {
        $this->totalUsers = $totalUsers;
        return $this;
    }

    public function getExtractionDate(): ?\DateTimeInterface
    {
        return $this->extractionDate;
    }

    public function setExtractionDate(\DateTimeInterface $extractionDate): self
    {
        $this->extractionDate = $extractionDate;
        return $this;
    }
}
