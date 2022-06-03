<?php

namespace App\Tests;

use App\Entity\UploadStatistics;
use PHPUnit\Framework\TestCase;

class TestEntityTest extends TestCase
{
    public function testUserCreate() {
        $now = new \DateTime('now');
        $uploadStatistics = new UploadStatistics();
        $uploadStatistics->setClientIpAddress('12.21.12');
        $uploadStatistics->setUsageCountPerDay(1);
        $uploadStatistics->setDateOfUploads($now);

        $this->assertEquals('12.21.12', $uploadStatistics->getClientIpAddress());
        $this->assertEquals(1, $uploadStatistics->getUsageCountPerDay());
        $this->assertEquals($now, $uploadStatistics->getDateOfUploads());
    }
}
