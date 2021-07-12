<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminCategorieClass extends  AbstractController
{
    /**
     * @Route("/admin/categories", name="admin_categorie_list")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        $list = $categoryRepository->findAll();
        return $this->render('admin/categories.html.twig', ['list' => $list]);

    }

    /**
     * @Route("/admin/categories/add", name="admin_categorie_add")
     */
    public function categoryAdd(CategoryRepository $categoryRepository)
    {
        return $this->render('admin/categoryadd.html.twig');
    }

    /**
     * @Route("/admin/categories/insert", name="admin_categorie_insert")
     */
    public function categoryInsert(EntityManagerInterface $entityManager, Request $request)
    {
        $title = $request->request->get('title');
        $description = $request->request->get('description');

        $category = new Category();
        $category->setTitle($title);
        $category->setDescription($description);


        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_categorie_list');

    }

    /**
     * @Route ("/admin/category/delete/{id}" , name="admin_categorie_delete")
     */
    public function categoryDelete($id, categoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_categorie_list');
    }

    /**
     * @Route("/admin/category/update/{id}", name="admin_categorie_update")
     */
    public function categoryUpadte($id, categoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);


        return $this->render('admin/categoryupdate.html.twig', ['category' => $category]);
    }

    /**
     * @Route("/admin/category/save/{id}", name="admin_categorie_save")
     */
    public function categorySave($id, Request $request,
                                 categoryRepository $categoryRepository,
                                 EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $title = $request->request->get('title');
        $description = $request->request->get('description');

        $category->setTitle($title);
        $category->setDescription($description);


        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_categorie_list');

    }

}