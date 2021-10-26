<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
=======
>>>>>>> 021438642c506fdb594f1ec3a3e036b19e9892fd
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_index")
     */
    public function categoryIndex()
    {
        $categorys = $this->getDoctrine()->getRepository(Category::class)->findAll();
        if ($categorys == null) {
            $this->addFlash('Error','Category list is empty');
        }
        return $this->render(
            'category/index.html.twig',
            [
              'categorys' => $categorys
            ]
        );
    }
    
     /**
     * @Route("/category/detail/{id}", name="category_detail")
     */
<<<<<<< HEAD
    public function categoryDetail($id) {
=======
    public function CategoryDetail($id) {
>>>>>>> 021438642c506fdb594f1ec3a3e036b19e9892fd
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if ($category == null) {
            $this->addFlash('Error','Category not found');
            return $this->redirectToRoute('category_index');
        } else {
            return $this->render(
                'category/detail.html.twig',
                [
                    'category' => $category
                ]
            );
        }
    }

     /**
<<<<<<< HEAD
      * @IsGranted("ROLE_ADMIN")
=======
>>>>>>> 021438642c506fdb594f1ec3a3e036b19e9892fd
     * @Route("category/delete/{id}", name="category_delete")
     */
    public function deleteCategory($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if ($category == null) {
            $this->addFlash('Error','Category not found');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($category);
            $manager->flush();
            $this->addFlash('Success', 'Category has been deleted');
        }
        return $this->redirectToRoute('category_index');
    }

     /**
<<<<<<< HEAD
      * @IsGranted("ROLE_ADMIN")
     * @Route("category/add", name="category_add")
     */
    public function addCategory (Request $request) {
=======
     * @Route("category/add", name="category_add")
     */
    public function addcategory (Request $request) {
>>>>>>> 021438642c506fdb594f1ec3a3e036b19e9892fd
        $category = new category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash('Success', "Category has been added successfully !");
            return $this->redirectToRoute("category_index");
        }

        return $this->render (
            "category/add.html.twig", 
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
<<<<<<< HEAD
     * @IsGranted("ROLE_ADMIN")
     * @Route("category/edit/{id}", name="category_edit")
     */
    public function editCategory(Request $request, $id) {
=======
     * @Route("category/edit/{id}", name="category_edit")
     */
    public function editcategory(Request $request, $id) {
>>>>>>> 021438642c506fdb594f1ec3a3e036b19e9892fd
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash('Success', "Category has been updated successfully !");
            return $this->redirectToRoute("category_index");
        }

        return $this->render (
            "category/edit.html.twig", 
            [
                'form' => $form->createView()
            ]
        );
    }
}