<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomnController extends AbstractController
{
    #[Route('/classroomn', name: 'classroomn')]
    public function index(): Response
    {
        return $this->render('classroomn/index.html.twig', [
            'controller_name' => 'ClassroomnController',
        ]);
    }
}
