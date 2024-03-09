<?php

namespace App\Controller;

use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog/list/{id}', name: 'app_blog_list')]
    public function list(EntityManagerInterface $entityManager, int $id): Response
    {
        $x = $entityManager->getRepository(Test::class)->find($id);
        return new Response(
            json_encode($x->getName())
        );
    }
}