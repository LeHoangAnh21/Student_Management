<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student_index")
     */
    public function studentIndex()
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        if ($students == null) {
            $this->addFlash('Error', 'Student list is empty');
            // avc
        }
        return $this->render(
            'student/index.html.twig',
            [
                'students' => $students
            ]
        );
    }

    /**
     * @Route("/student/detail/{id}", name="student_detail")
     */
    public function studentDetail($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('Error', 'Student not found');
            return $this->redirectToRoute('student_index');
        } else {
            return $this->render(
                'student/detail.html.twig',
                [
                    'student' => $student
                ]
            );
        }
    }

    /**
     * @Route("student/delete/{id}", name="student_delete")
     */
    public function deletestudent($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('Error', 'student not found');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash('Success', 'student has been deleted');
        }
        return $this->redirectToRoute('student_index');
    }

    /**
     * @Route("student/add", name="student_add")
     */
    public function addstudent(Request $request)
    {
        $student = new student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $student->getImage();
            $imgName = uniqid(); 
            $imgExtension = $image->guessExtension();
            $imageName = $imgName . "." . $imgExtension;
            try {
                $image->move(
                    $this->getParameter('student_image'),
                    $imageName
                );
            } catch (FileException $e) {
            }
            $student->setImage($imageName);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash('Success', "Add student successfully !");
            return $this->redirectToRoute("student_index");
        }

        return $this->render(
            "student/add.html.twig",
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("student/edit/{id}", name="student_edit")
     */
    public function editstudent(Request $request, $id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('Error', 'student not found');
            return $this->redirectToRoute('student_index');
        } else { 
            $form = $this->createForm(StudentType::class, $student);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $file = $form['image']->getData();
                if ($file != null) {
                    $image = $student->getImage();
                    $imgName = uniqid(); 
                    $imgExtension = $image->guessExtension();
                    $imageName = $imgName . "." . $imgExtension;
                    try {
                        $image->move(
                            $this->getParameter('student_image'),
                            $imageName
                        );
                    } catch (FileException $e) {
                    }
                    $student->setImage($imageName);
                }

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($student);
                $manager->flush();

                $this->addFlash('Success', "Edit student successfully !");
                return $this->redirectToRoute("student_index");
            }

            return $this->render(
                "student/edit.html.twig",
                [
                    'form' => $form->createView()
                ]
            );
        }
    }
}
