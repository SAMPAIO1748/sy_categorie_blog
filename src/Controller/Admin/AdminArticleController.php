<?php


namespace App\Controller\Admin;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;;

class AdminArticleController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_article_list")
     */
    public function articlesList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render('admin/articles.html.twig', ['articles' => $articles]);
    }


    /**
     * @Route("/admin/articles/add", name="admin_article_add")
     */
    //public function articleAdd(TagRepository $tagRepository, CategoryRepository $categoryRepository)
    //{
        //$tags = $tagRepository->findAll();
        //$categories = $categoryRepository->findAll();
        //return $this->render('admin/articleadd.html.twig', ['tags' => $tags,
            //'categories' => $categories]);
    //}

    /**
     * @Route("/admin/articles/insert", name="admin_article_insert")
     */
    public function articleInsert(EntityManagerInterface  $entityManager,
                                  Request $request,
                                  CategoryRepository $categoryRepository,
                                  TagRepository $tagRepository)
    {
        // On récupère les données du formulaire en post
        //$title = $request->request->get('title');
        //$content = $request->request->get('content');
        //$is_published = $request->request->get('is_published');
        //$id_category = $categoryRepository->find($request->request->get('id_category')) ;
        //$id_tag = $tagRepository->find($request->request->get('id_tag')) ;

        // On crée une nouvelle entité Article et on lui ajoute les valeurs du formulaire grâce aux différents set
        //$article = new Article();
        //$article->setTitle($title);
        //$article->setContent($content);
        //$article->setIsPublished($is_published);
        //$article->setCreatedAt( new \DateTime("NOW") );
        //$article->setCategory($id_category);
        //$article->setTag($id_tag);

        // On préenregistre les données avant de les mettre dans la BDD
        //$entityManager->persist($article);
        // On enregistre les données dans la BDD
        //$entityManager->flush();

        //return $this->redirectToRoute('admin_article_list');

        $article = new Article();

        $articleForm = $this->createForm(ArticleType::class, $article);

        return $this->render('admin/articleadd.html.twig', ['articleForm' => $articleForm->createView()]);

    }

    /**
     * @Route ("/admin/article/delete/{id}" , name="admin_article_delete")
     */
    public function articleDelete($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('admin_article_list');
    }

    /**
     * @Route("/admin/article/update/{id}", name="admin_article_update")
     */
    public function articleUpadte($id,
                                  ArticleRepository $articleRepository,
                                  TagRepository $tagRepository,
                                  CategoryRepository $categoryRepository)
    {
        $article = $articleRepository->find($id);
        $tags = $tagRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('admin/articleupdate.html.twig', ['article' => $article,
            'tags' => $tags,
            'categories' => $categories]);
    }

    /**
     * @Route("/admin/article/save/{id}", name="admin_article_save")
     */
    public function articleSave($id,
                                Request $request,
                                ArticleRepository $articleRepository,
                                TagRepository $tagRepository,
                                CategoryRepository $categoryRepository,
                                EntityManagerInterface $entityManager)
    {
        //$article = $articleRepository->find($id);

        //$title = $request->request->get('title');
        //$content = $request->request->get('content');
        //$is_published = $request->request->get('is_published');
        //$id_category = $categoryRepository->find($request->request->get('id_category')) ;
        //$id_tag = $tagRepository->find($request->request->get('id_tag'));

        //$article->setTitle($title);
        //$article->setContent($content);
        //$article->setIsPublished($is_published);
        //$article->setCategory($id_category);
        //$article->setTag($id_tag);

        //$entityManager->persist($article);
        //$entityManager->flush();

        //return $this->redirectToRoute('admin_article_list');
    }

}