<?php

namespace App\Controller;

use App\Entity\AsyncJob;
use App\Repository\SymptomRepository;
use App\Service\AmqpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test')]
class MedTestController extends AbstractController
{

    #[Route('/common', name: 'test_common', methods: [Request::METHOD_POST])]
    public function commonTest(SymptomRepository $symptomRepository, Request $request): Response
    {
        $asyncJob = new AsyncJob();
        $asyncJob->setContext((array) $request->getContent());

        AmqpService::publishMessage($request->getContent());

        return $this->json([
            'message' => 'message published'
        ]);
    }
}
