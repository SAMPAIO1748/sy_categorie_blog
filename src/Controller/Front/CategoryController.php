<?php


namespace App\Controller\Front;

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
     * @Route("/categories", name="categorie_list")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        $list = $categoryRepository->findAll();
        return $this->render('front/categories.html.twig', ['list' => $list]);

    }

    /**
     * @Route("/categorie/{id}", name="categorie_show")
     */
    public function categorieShow($id, CategoryRepository $categoryRepository)
    {
        $categorie = $categoryRepository->find($id);
        if(isset($categorie)){
            return $this->render('front/categorie.html.twig', ['categorie' => $categorie]);
        }else{
            throw new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }
}