<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            return $this->redirectToroute('home');
        }
    }
}