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

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $age;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $gender;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $username;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $password;

    #[ORM\Column(type: 'date', nullable: true)]
    private $birthDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $bloodGroup;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $height;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $weight;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $eyeColor;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $hairColor;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $hairType;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $ip;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $state;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $stateCode;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $country;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $macAddress;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $university;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $bankCardExpire;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $bankCardNumber;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $bankCardType;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $currency;

    #[ORM\Column(type: 'string', length: 34, nullable: true)]
    private $iban;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $companyName;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $companyDepartment;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $companyTitle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $companyAddress;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $companyCity;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $companyState;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $companyPostalCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $companyCountry;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 8, nullable: true)]
    private $companyLat;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 8, nullable: true)]
    private $companyLng;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $ein;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $ssn;

    #[ORM\Column(type: 'text', nullable: true)]
    private $userAgent;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $cryptoCoin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cryptoWallet;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $cryptoNetwork;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $role;

    // Getters y Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSummary(): ?Summary
    {
        return $this->summary;
    }

    public function setSummary(?Summary $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getBloodGroup(): ?string
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup(?string $bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;
        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(?string $eyeColor): self
    {
        $this->eyeColor = $eyeColor;
        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(?string $hairColor): self
    {
        $this->hairColor = $hairColor;
        return $this;
    }

    public function getHairType(): ?string
    {
        return $this->hairType;
    }

    public function setHairType(?string $hairType): self
    {
        $this->hairType = $hairType;
        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getStateCode(): ?string
    {
        return $this->stateCode;
    }

    public function setStateCode(?string $stateCode): self
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getMacAddress(): ?string
    {
        return $this->macAddress;
    }

    public function setMacAddress(?string $macAddress): self
    {
        $this->macAddress = $macAddress;
        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(?string $university): self
    {
        $this->university = $university;
        return $this;
    }

    public function getBankCardExpire(): ?string
    {
        return $this->bankCardExpire;
    }

    public function setBankCardExpire(?string $bankCardExpire): self
    {
        $this->bankCardExpire = $bankCardExpire;
        return $this;
    }

    public function getBankCardNumber(): ?string
    {
        return $this->bankCardNumber;
    }

    public function setBankCardNumber(?string $bankCardNumber): self
    {
        $this->bankCardNumber = $bankCardNumber;
        return $this;
    }

    public function getBankCardType(): ?string
    {
        return $this->bankCardType;
    }

    public function setBankCardType(?string $bankCardType): self
    {
        $this->bankCardType = $bankCardType;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = $iban;
        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCompanyDepartment(): ?string
    {
        return $this->companyDepartment;
    }

    public function setCompanyDepartment(?string $companyDepartment): self
    {
        $this->companyDepartment = $companyDepartment;
        return $this;
    }

    public function getCompanyTitle(): ?string
    {
        return $this->companyTitle;
    }

    public function setCompanyTitle(?string $companyTitle): self
    {
        $this->companyTitle = $companyTitle;
        return $this;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->companyAddress;
    }

    public function setCompanyAddress(?string $companyAddress): self
    {
        $this->companyAddress = $companyAddress;
        return $this;
    }

    public function getCompanyCity(): ?string
    {
        return $this->companyCity;
    }

    public function setCompanyCity(?string $companyCity): self
    {
        $this->companyCity = $companyCity;
        return $this;
    }

    public function getCompanyState(): ?string
    {
        return $this->companyState;
    }

    public function setCompanyState(?string $companyState): self
    {
        $this->companyState = $companyState;
        return $this;
    }

    public function getCompanyPostalCode(): ?string
    {
        return $this->companyPostalCode;
    }

    public function setCompanyPostalCode(?string $companyPostalCode): self
    {
        $this->companyPostalCode = $companyPostalCode;
        return $this;
    }

    public function getCompanyCountry(): ?string
    {
        return $this->companyCountry;
    }

    public function setCompanyCountry(?string $companyCountry): self
    {
        $this->companyCountry = $companyCountry;
        return $this;
    }

    public function getCompanyLat(): ?float
    {
        return $this->companyLat;
    }

    public function setCompanyLat(?float $companyLat): self
    {
        $this->companyLat = $companyLat;
        return $this;
    }

    public function getCompanyLng(): ?float
    {
        return $this->companyLng;
    }

    public function setCompanyLng(?float $companyLng): self
    {
        $this->companyLng = $companyLng;
        return $this;
    }

    public function getEin(): ?string
    {
        return $this->ein;
    }

    public function setEin(?string $ein): self
    {
        $this->ein = $ein;
        return $this;
    }

    public function getSsn(): ?string
    {
        return $this->ssn;
    }

    public function setSsn(?string $ssn): self
    {
        $this->ssn = $ssn;
        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): self
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getCryptoCoin(): ?string
    {
        return $this->cryptoCoin;
    }

    public function setCryptoCoin(?string $cryptoCoin): self
    {
        $this->cryptoCoin = $cryptoCoin;
        return $this;
    }

    public function getCryptoWallet(): ?string
    {
        return $this->cryptoWallet;
    }

    public function setCryptoWallet(?string $cryptoWallet): self
    {
        $this->cryptoWallet = $cryptoWallet;
        return $this;
    }

    public function getCryptoNetwork(): ?string
    {
        return $this->cryptoNetwork;
    }

    public function setCryptoNetwork(?string $cryptoNetwork): self
    {
        $this->cryptoNetwork = $cryptoNetwork;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }
}