<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            throw  new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }

    /**
     * @Route("/search", name="search")
     */                             //Autowire
    public function search(ArticleRepository $articleRepository)
    {
        $term = "Superman";
        // Utilisation de la méthode crée dans ArtcileRepository
        $articles = $articleRepository->searchByTerm($term);

        return $this->render('articlesearch.html.twig', ['articles' => $articles,
            'term' => $term]);
    }

}