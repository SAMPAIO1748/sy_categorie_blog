<?php


namespace App\Controller\Front;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('front/home.html.twig');
    }

    /**
     * @Route("/search/", name="front_search")
     */                             //Autowire
    public function search(ArticleRepository $articleRepository, Request $request)
    {
        // Recuperation des données entrées dans le champs q du formulaire
        $term = $request->query->get('q');
        // Utilisation de la méthode crée dans ArtcileRepository
        $articles = $articleRepository->searchByTerm($term);

        return $this->render('front/articlesearch.html.twig', ['articles' => $articles,
            'term' => $term]);
    }

}