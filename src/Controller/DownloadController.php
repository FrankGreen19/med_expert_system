<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/download')]
class DownloadController extends AbstractController
{
    #[Route('/image', name: 'download_image', methods: [Request::METHOD_GET])]
    public function downloadImage(Request $request): Response
    {
        $imageName = $request->query->get('imageName');
        $filePath = $_ENV['FILE_UPLOAD_DIR'] . $imageName;

        if (!file_exists($filePath)) {
            return $this->json([
                'message' => 'image not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->file($filePath);
    }
}
