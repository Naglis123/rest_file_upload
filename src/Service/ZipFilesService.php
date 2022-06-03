<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use ZipArchive;

class ZipFilesService
{
    public function zipFiles(array $files): array
    {
        $countFiles = count($files['file']['name']);
        $zip = new ZipArchive();
        $zipName = 'files-'.uniqid().'.zip';
        $errorCount = 0;
        $zip->open($zipName, ZipArchive::CREATE);
        $responseArr['success'] = true;

        for ($i = 0; $i < $countFiles; $i++) {
            $fileName = $_FILES['file']['name'][$i];
            $tempPath = $_FILES['file']['tmp_name'][$i];
            $fileSize = $_FILES['file']['size'][$i];

            if ($fileSize < 1000000) {
                $zip->addFromString(basename($fileName), file_get_contents($tempPath));
            } else {
                $errorCount++;
            }
        }
        $zip->close();

        if ($errorCount > 0) {
            $responseArr['response'] = new Response('Max file size allowed 1 MB');
            $responseArr['success'] = false;
        } else {
            $response = new Response(file_get_contents($zipName));
            $response->headers->set('Content-Type', 'application/zip');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $zipName . '"');
            $response->headers->set('Content-length', filesize($zipName));
            $responseArr['response'] = $response;
            unlink($zipName);
        }

        return $responseArr;
    }
}