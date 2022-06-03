<?php

namespace App\Tests;

use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApiTest extends WebTestCase
{
    /**
     * @throws Exception
     */
    public function testApi(): void
    {
        $container = static::getContainer();
        $client = static::createClient();
        $rootDir = $container->getParameter('root_dir');
        $uploadedFile = new UploadedFile($rootDir.'/public/prod3.jpg', 'name');

        $client->request('POST', '/api/upload', [], [
            'file' => $uploadedFile
        ]);

        $this->assertResponseIsSuccessful();
    }
}
