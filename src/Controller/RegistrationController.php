<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration', methods: ['POST'])]
    public function index(Request $request,
                          UserRepository $userRepository, RoleRepository $roleRepository,
                          UserPasswordHasherInterface $passwordHasher,
                          ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $user = $userRepository->findOneBy(['email' => $request->get('email')]);

        if ($user instanceof User) {
            return $this->json([
                'message' => 'user already exists'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setEmail($request->get('email'));

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $request->get('password')
        );
        $user->setPassword($hashedPassword);

        $user->setFName($request->get('fName'));
        $user->setLName($request->get('lName'));
        $user->setPName($request->get('pName'));
        $user->setBirthDate(new \DateTime($request->get('bDate')));
        $user->setIsActive(true);

        $roleClient = $roleRepository->find(Role::ROLE_CLIENT);
        $user->setRoles([$roleClient]);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $this->json([
                'message' => 'validation errors',
                'errors' => $errors,
            ],Response::HTTP_BAD_REQUEST);
        }

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        if ($user->getId()) {
            return $this->json([
                'accessToken' => null,
                'refreshToken' => null
            ]);
        } else {
            $this->json('error while saving', 400);
        }
    }
}
