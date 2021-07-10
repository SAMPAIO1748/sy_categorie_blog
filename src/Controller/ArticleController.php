<?php


namespace App\Controller;


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
     * @Route("/search/", name="search")
     */                             //Autowire
    public function search(ArticleRepository $articleRepository, Request $request)
    {
        // Recuperation des données entrées dans le champs q du formulaire
        $term = $request->query->get('q');
        // Utilisation de la méthode crée dans ArtcileRepository
        $articles = $articleRepository->searchByTerm($term);

        return $this->render('articlesearch.html.twig', ['articles' => $articles,
            'term' => $term]);
    }

    /**
     * @Route("/articles/add", name="articleAdd")
     */
    public function articleAdd(TagRepository $tagRepository, CategoryRepository $categoryRepository)
    {
        $tags = $tagRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('articleadd.html.twig', ['tags' => $tags,
             'categories' => $categories]);
    }

    /**
     * @Route("/articles/insert", name="articleInsert")
     */
    public function articleInsert(EntityManagerInterface  $entityManager, Request $request, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $is_published = $request->request->get('is_published');
        $id_category = $categoryRepository->find($request->request->get('id_category')) ;
        $id_tag = $tagRepository->find($request->request->get('id_tag')) ;

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setIsPublished($is_published);
        $article->setCreatedAt( new \DateTime("NOW") );
        $article->setCategory($id_category);
        $article->setTag($id_tag);

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->redirectToRoute('articlesList');

    }

    /**
     * @Route ("/article/delete/{id}" , name="articleDelete")
     */
    public function articleDelete($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('articlesList');
    }

    /**
     * @Route("/article/update/{id}", name="articleUpdate")
     */
    public function articleUpadte($id, ArticleRepository $articleRepository, TagRepository $tagRepository, CategoryRepository $categoryRepository)
    {
        $article = $articleRepository->find($id);
        $tags = $tagRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('articleupdate.html.twig', ['article' => $article,
            'tags' => $tags,
            'categories' => $categories]);
    }

    /**
     * @Route("/article/save/{id}", name="articleSave")
     */
    public function articleSave($id,Request $request, ArticleRepository $articleRepository, TagRepository $tagRepository, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);

        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $is_published = $request->request->get('is_published');
        $id_category = $categoryRepository->find($request->request->get('id_category')) ;
        $id_tag = $tagRepository->find($request->request->get('id_tag'));

        $article->setTitle($title);
        $article->setContent($content);
        $article->setIsPublished($is_published);
        $article->setCategory($id_category);
        $article->setTag($id_tag);

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->redirectToRoute('articlesList');


    }
}