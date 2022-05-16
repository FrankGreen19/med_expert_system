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

        $testContext = (array) json_decode($request->getContent());
        $testContext['symptoms'] = (array) $testContext['symptoms'][0];
        $user = $this->getUser();

        $medTest = new MedicalTest();
        $medTest->setTestType($testContext['test_type']);
        $medTest->setUsr($user);
        $medTest->setContext($testContext);

        if ($file = $request->files->get('xray')) {
            $uploadedFile = FileService::upload($file);

            $xrayImage = (new XrayImage())->parseUploadedFile($uploadedFile);
            $em->persist($xrayImage);

            $testContext['xray_img_path'] = $xrayImage->getImagePath();
            $medTest->setXrayImage($xrayImage);
        }

        $em->persist($medTest);
        $em->flush();

        $asyncJob = new AsyncJob();
        $em->persist($asyncJob);
        $em->flush();

        $testContext['medical_test_id'] = $medTest->getId();
        $testContext['async_job_id'] = $asyncJob->getId();

        $asyncJob->setContext($testContext);
        $asyncJob->setUser($user);
        $asyncJob->setStatus(AsyncJob::STATUS_QUEUED);

        $em->persist($asyncJob);
        $em->flush();

        AmqpService::publishMessage(json_encode($testContext));

        return $this->json([
            'message' => 'message published'
        ]);
    }
}
