<?php


namespace App\Controller\Front;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="article_list")
     * Affiche tous les articles avec leur catégorie associée
     */
    public function articlesList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render('front/articles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function articleShow($id, ArticleRepository $articleRepository)
    {

        $article = $articleRepository->find($id);
        if(isset($article)){
            return $this->render('front/article.html.twig', ['article' => $article]);
        }else{
            throw  new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }
}