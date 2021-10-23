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
        return $this->render(
            'classroom/index.html.twig', 
            [
            'classrooms' => $classrooms
            ]
        );
    }

    /**
     * @Route("/classroom/detail/{id}", name="classroom_detail")
     */
    public function classroomDetail($id)
    {
        $classroom = $this->getDoctrine()->getRepository(classroom::class)->find($id);
        if ($classroom == null) {
            $this->addFlash('Error', 'classroom not found');
            return $this->redirectToRoute('classroom_index');
        } 
        else {
            return $this->render(
                'classroom/detail.html.twig',
                [
                    'classroom' => $classroom
                ]
            );
        }
    }

    /**
     * @Route("/classroom/delete/{id}", name="classroom_delete")
     */
    public function classroomDelete($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        if ($classroom == null) {
            $this->addFlash('Error', 'Class not found');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($classroom);
            $manager->flush();
            $this->addFlash('Success', 'Class is deleted');
        }
        return $this->redirectToRoute('classroom_index');
    }

    
}
