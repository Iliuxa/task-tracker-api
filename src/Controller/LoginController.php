<?php

namespace App\Controller;

use App\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login/authorization', name: 'app_login_authorization', methods: ['POST'], format: 'json')]
    public function authorization(
        EntityManagerInterface $entityManager,
        Request                $request
    ): Response
    {
        $userLogin = $request->getPayload()->get('login');
        $userPassword = $request->getPayload()->get('password');

        $user = $entityManager->getRepository(UserEntity::class)->findOneBy([
            'email' => $userLogin,
            'hasPassword' => $userPassword
        ]);

        $user ?? throw new \Exception('Неверный логин или пароль');

        $this->sessionStart();
        $_SESSION['userId'] = $user->getId();
        session_write_close();

        return $this->json([
            'result' => true
        ]);
    }
    
    public static function getUserId(): int
    {
        return $_SESSION['userId'];
    }

    private function sessionStart(): void
    {
        //todo check session
        $this->sessionStart();
    }
}