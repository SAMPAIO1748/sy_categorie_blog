<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articlesList")
     */
    public function articlesList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render('articles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/article/{id}", name="articleShow")
     */
    public function articleShow($id, ArticleRepository $articleRepository)
    {

        $article = $articleRepository->find($id);
        if(isset($article)){
            return $this->render('article.html.twig', ['article' => $article]);
        }else{
            return $this->redirectToRoute('home');
        }
    }

}