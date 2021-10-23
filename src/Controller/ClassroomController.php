<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom_index")
     */
    public function classroomIndex()
    {
        $classrooms = $this->getDoctrine()->getRepository(Classroom::class)->findAll();
        if($classrooms == null) {
            $this->addFlash('Error', 'Class list is empty');
        }
        return $this->render(
            'classroom/index.html.twig', 
        [
            'classrooms' => $classrooms
        ]);
    }

    /**
     * @Route("/classroom/detail/{id}, name="classroom_detail")
     */
    public function classroomDetail($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        if($classroom == null) {
            $this->addFlash('Error', 'Class is not found!');
        } else {
            return $this->render(
                'classroom/detail.html.twig',
            [
                    'classroom' => $classroom,
            ]);
        }
    }
}
