<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @IsGranted("ROLE_USER")
 */
class TeacherController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/teacher", name="teacher_index")
     */
    public function teacherIndex()
    {
        $teachers = $this->getDoctrine()->getRepository(Teacher::class)->findAll();

        return $this->render(
            'teacher/index.html.twig', 
            [
                'teachers' => $teachers
            ]
        );
    }

    /**
     * @Route("/teacher/detail/{id}", name="teacher_detail")
     */
    public function teacherDetail($id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);

        if($teacher == null){
            $this->addFlash('Error', 'Teacher not found!');
            return $this->redirectToRoute('teacher_index');
        }
        else{
            return $this->render(
                'teacher/detail.html.twig', 
                [
                    'teacher' => $teacher
                ]
            );
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/teacher/delete/{id}", name="teacher_delete")
     */
    public function deleteTeacher($id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);

        if($teacher == null){
            $this->addFlash('Error', 'Teacher not found!');
        }
        else{
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($teacher);
            $manager->flush();
            $this->addFlash('Success', 'Teacher has been deleted!');
        }
        return $this->redirectToRoute('teacher_index');
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/teacher/add", name="teacher_add")
     */
    public function addTeacher(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $image = $teacher->getImage();
            $imgName = uniqid();
            $imgExtension = $image->guessExtension();
            $imageName = $imgName . "." . $imgExtension;

            try{
                $image->move(
                    $this->getParameter('teacher_image'), $imageName
                );
            }
            catch(FileException $e){

            }
            $teacher->setImage($imageName);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();

            $this->addFlash('Success', "Add teacher successfully !");
            return $this->redirectToRoute("teacher_index");
        }

        return $this->render(
            "teacher/add.html.twig",
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("teacher/edit/{id}", name="teacher_edit")
     */
    public function editTeacher(Request $request, $id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        
        if ($teacher == null) 
        {
            $this->addFlash('Error', 'Teacher not found !');
            return $this->redirectToRoute('teacher_index');
        } 
        else 
        { 
            $form = $this->createForm(TeacherType::class, $teacher);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) 
            {
                $file = $form['image']->getData();

                if ($file != null)
                {
                    $image = $teacher->getImage();
                    $imgName = uniqid();
                    $imgExtension = $image->guessExtension();
                    $imageName = $imgName . "." . $imgExtension;

                    try {
                        $image->move(
                            $this->getParameter('teacher_image'), $imageName
                        );
                    } 
                    catch (FileException $e) {

                    }

                    $teacher->setImage($imageName);
                }
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($teacher);
                    $manager->flush();

                    $this->addFlash('Success', "Update teacher successfully !");
                    return $this->redirectToRoute("teacher_index");
            }

            return $this->render(
                "teacher/edit.html.twig",
                [
                    'form' => $form->createView()
                ]
            );
        }
    }
}
