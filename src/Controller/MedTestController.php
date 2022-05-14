<?php

namespace App\Controller;

use App\Entity\AsyncJob;
use App\Entity\XrayImage;
use App\Repository\SymptomRepository;
use App\Service\AmqpService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test')]
class MedTestController extends AbstractController
{

    #[Route('/common', name: 'test_common', methods: [Request::METHOD_POST])]
    public function commonTest(SymptomRepository $symptomRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $asyncJob = new AsyncJob();
        $asyncJob->setContext((array) $request->getContent());
        /**
         * @var File $file
         */
        $file = $request->files->get('xray');
        $xrayImage = new XrayImage();

        $xrayImage->setImageFile($file);
        $xrayImage->setImageName('tetet');
        $xrayImage->setImageSize(32423);

        $em = $doctrine->getManager();
        $em->persist($xrayImage);
        $em->flush();

        AmqpService::publishMessage($request->getContent());

        return $this->json([
            'message' => 'message published'
        ]);
    }
}
