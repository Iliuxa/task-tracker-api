<?php

namespace App\Controller;

use App\Entity\RoleEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    #[Route('/role/get', name: 'app_role_get')]
    public function get(EntityManagerInterface $entityManager): Response
    {
        return $this->json([
            $entityManager->getRepository(RoleEntity::class)->findAll()
        ]);
    }
}