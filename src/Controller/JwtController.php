<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JwtController extends AbstractController
{
    #[Route('/jwt/registration',  name: 'registration', methods: [POST])]
    public function registration(UserRepository $userRepository): Response
    {


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/JwtController.php',
        ]);
    }
}
