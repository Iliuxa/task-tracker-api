<?php

namespace App\Controller;

use App\Entity\RoleEntity;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/user/save', name: 'app_user_save', methods: ['POST'], format: 'json')]
    public function save(
        EntityManagerInterface $entityManager,
        #[MapRequestPayload]
        UserEntity             $user,
        ValidatorInterface     $validator
    ): Response
    {
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new Response((string)$errors);
        }

        if ($user->hasId()) {
            $userEntity = $entityManager->find(UserEntity::class, $user->getId());
            $user = $userEntity->toUserDto($user);
        }

        $user->setRole($entityManager->find(RoleEntity::class, $user->getRole()));

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'result' => true
        ]);
    }

    #[Route('/user/get', name: 'app_user_get', methods: ['POST'], format: 'json')]
    public function get(
        EntityManagerInterface $entityManager,
        Request                $request
    ): Response
    {
        $userId = $request->getPayload()->get('id');
        $repository = $entityManager->getRepository(UserEntity::class);

        if (isset($userId)) {
            $user = $repository->find($userId);
        } else {
            $user = $repository->findAll();
        }

        $user ?? throw new \Exception('Не удалось найти пользователя');

        return $this->json([
            'result' => $user
        ]);
    }
}