<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailRepository::class)]

class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Summary::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $summary;

    #[ORM\Column(type: 'integer')]
    private $userId;

    #[ORM\Column(type: 'string', length: 255)]
    private $userName;

    #[ORM\Column(type: 'string', length: 255)]
    private $userEmail;

    // Getters y setters
    public function getId(): ?int
    {
        return $id;
    }

    public function getSummary(): ?Summary
    {
        return $summary;
    }

    public function setSummary(?Summary $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserName(): ?string
    {
        return $userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;
        return $this;
    }
}
