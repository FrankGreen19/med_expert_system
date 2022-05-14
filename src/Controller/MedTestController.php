<?php

namespace App\Controller;

use App\Entity\AsyncJob;
use App\Entity\MedicalTest;
use App\Entity\XrayImage;
use App\Repository\SymptomRepository;
use App\Service\AmqpService;
use App\Service\FileService;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use phpseclib3\Crypt\DH\Parameters;
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
        $em = $doctrine->getManager();

        $testContext = (array) $request->request->all();
        $user = $this->getUser();

        $uploadedFile = FileService::upload($request->files->get('xray'));
        $xrayImage = (new XrayImage())->parseUploadedFile($uploadedFile);

        $medTest = new MedicalTest();
        $medTest->setTestType(MedicalTest::TEST_COMMON);
        $medTest->setUsr($user);
        $medTest->setContext($testContext);
        $medTest->setXrayImage($xrayImage);

        $em->persist($xrayImage);
        $em->persist($medTest);
        $em->flush();

        $testContext['xray_img_path'] = $xrayImage->getImagePath();
        $testContext['medical_test_id'] = $medTest->getId();
        $asyncJob = new AsyncJob();
        $asyncJob->setContext($testContext);
        $asyncJob->setUser($user);

        $em->persist($asyncJob);
        $em->flush();

        for ($i = 0; $i <= 15; $i++) {
            AmqpService::publishMessage(json_encode($testContext));
        }


        return $this->json([
            'message' => 'message published'
        ]);
    }
}
