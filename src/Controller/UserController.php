<?php

namespace App\Controller;

use App\Repository\IllnessRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/user', name: 'user', methods: ['GET'])]
    public function index(IllnessRepository $illnessRepository, UserRepository $userRepository): Response
    {
        $illnesses = $illnessRepository->findAll();
        $users = $userRepository->findAll();

        return $this->json($users);
    }

    #[Route('/user', name: 'post', methods: ['POST'])]
    public function post(Request $request):Response
    {
        return $this->json([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'method' => 'POST',
        ]);
    }

    #[Route('/user', name: 'put', methods: ['PUT'])]
    public function put():Response
    {
        return $this->json([
            'method' => 'PUT',
        ]);
    }

    #[Route('/user', name: 'delete', methods: ['DELETE'])]
    public function delete():Response
    {
        return $this->json([
            'method' => 'DELETE',
        ]);
    }
}
