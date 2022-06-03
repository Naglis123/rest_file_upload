<?php

namespace App\Service;

use App\Entity\UploadStatistics;
use Doctrine\Persistence\ManagerRegistry;

class UploadStatisticsService
{
    public function __construct(private ManagerRegistry $registry) {}

    public function uploadStatistics(string $ipAddress): void
    {
        $em = $this->registry->getManager();
        $currentDay = new \DateTime('now');
        $client = $em->getRepository(UploadStatistics::class)->findOneByIpAndDate($ipAddress, $currentDay);

        if (!$client) {
            $uploadStat = new UploadStatistics();
            $uploadStat->setUsageCountPerDay(1);
            $uploadStat->setClientIpAddress($ipAddress);
            $em->persist($uploadStat);
        } else {
            $client->setUsageCountPerDay($client->getUsageCountPerDay() + 1);
            $em->persist($client);
        }
        $em->flush();
    }
}