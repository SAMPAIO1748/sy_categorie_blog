<?php


namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


class TagController extends AbstractController
{
    /**
     * @Route ("/tags", name="tagList")
     */
    public function tagList(TagRepository $tagRepository)
    {
        $listTag = $tagRepository->findAll();
        return $this->render('tags.html.twig', ['listTag' => $listTag]);
    }

    /**
     * @Route ("/tag/{id}", name="tagShow")
     */
    public function tagShow(TagRepository $tagRepository, $id)
    {
        $tag = $tagRepository->find($id);
        if(isset($tag)){
            return $this->render('tag.html.twig', ['tag' => $tag]);
        }else{
            throw new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }

    }

}