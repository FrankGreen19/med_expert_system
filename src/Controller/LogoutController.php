<?php

namespace App\Controller;

use App\Repository\RefreshTokenRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'logout', methods: [Request::METHOD_POST])]
    public function index(Request $request,
                          RefreshTokenRepository $refreshTokenRepository,
                          ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $token = $request->get('refresh_token');

        $dbToken = $refreshTokenRepository->findOneBy(['refreshToken' => $token]);

        if (!$dbToken) {
            return $this->json('token is not exist', Response::HTTP_NOT_FOUND);
        }

        $em->remove($dbToken);
        $em->flush();

        if (!$dbToken->getId()) {
            return $this->json('success');
        } else {
            return $this->json('fail');
        }
    }
}
