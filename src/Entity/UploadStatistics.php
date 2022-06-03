<?php

namespace App\Entity;

use App\Repository\UploadStatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UploadStatisticsRepository::class)]
class UploadStatistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $clientIpAddress;

    #[ORM\Column(type: 'datetime')]
    private $dateOfUploads;

    #[ORM\Column(type: 'integer')]
    private $usageCountPerDay;

    public function __construct()
    {
        $this->dateOfUploads = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientIpAddress(): ?string
    {
        return $this->clientIpAddress;
    }

    public function setClientIpAddress(?string $clientIpAddress): self
    {
        $this->clientIpAddress = $clientIpAddress;

        return $this;
    }

    public function getDateOfUploads(): ?\DateTimeInterface
    {
        return $this->dateOfUploads;
    }

    public function setDateOfUploads(\DateTimeInterface $dateOfUploads): self
    {
        $this->dateOfUploads = $dateOfUploads;

        return $this;
    }

    public function getUsageCountPerDay(): ?int
    {
        return $this->usageCountPerDay;
    }

    public function setUsageCountPerDay(int $usageCountPerDay): self
    {
        $this->usageCountPerDay = $usageCountPerDay;

        return $this;
    }
}
