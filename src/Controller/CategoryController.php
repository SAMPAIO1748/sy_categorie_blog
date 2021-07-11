<?php


namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/categories", name="categoriesList")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        $list = $categoryRepository->findAll();
        return $this->render('categories.html.twig', ['list' => $list]);

    }

    /**
     * @Route("/categorie/{id}", name="categorieShow")
     */
    public function categorieShow($id, CategoryRepository $categoryRepository)
    {
        $categorie = $categoryRepository->find($id);
        if(isset($categorie)){
            return $this->render('categorie.html.twig', ['categorie' => $categorie]);
        }else{
            throw new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }

    /**
     * @Route("/categories/add", name="categoryAdd")
     */
    public function categoryAdd(CategoryRepository $categoryRepository)
    {
        return $this->render('categoryadd.html.twig');
    }

    /**
     * @Route("/categories/insert", name="categoryInsert")
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

        return $this->redirectToRoute('categoriesList');

    }

    /**
     * @Route ("/category/delete/{id}" , name="categoryDelete")
     */
    public function categoryDelete($id, categoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('categoriesList');
    }

    /**
     * @Route("/category/update/{id}", name="categoryUpdate")
     */
    public function categoryUpadte($id, categoryRepository $categoryRepository )
    {
        $category = $categoryRepository->find($id);
        

        return $this->render('categoryupdate.html.twig', ['category' => $category]);
    }

    /**
     * @Route("/category/save/{id}", name="categorySave")
     */
    public function categorySave($id, Request $request, categoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $title = $request->request->get('title');
        $description = $request->request->get('description');

        $category->setTitle($title);
        $category->setDescription($description);
       

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('categoriesList');


    }
}