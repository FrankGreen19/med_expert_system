<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/user', name: 'user', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user = new User();
        $user->setEmail('test@gmail.com');
        $user->setPassword('12345');
        $user->setLName('Krasnova');
        $user->setFName('Alisa');
        $user->setBirthDate(new \DateTime());

        $entityManager->persist($user);
        $entityManager->flush();

        $result = false;
        if ($user->getId()) {
            $result = true;
        }

        return $this->json([
            'message' => $user->getFullName(),
            'method' => 'GET',
            'result' => $result
        ]);
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
