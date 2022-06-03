<?php

namespace App\Controller;

use App\Service\ZipFilesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/upload', name: 'app_api', methods: 'POST')]
    public function index(Request $request, ZipFilesService $zipFilesService): Response
    {
        if (empty($_FILES) || $_FILES['file']['name'][0] == '') return new Response('No files selected');
        $clientIp = $request->getClientIp();
        $responseService = $zipFilesService->zipFiles($_FILES);
        $isSuccess = $responseService['success'];

        return $responseService['response'];
    }
}
