<?php


namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


class TagController extends AbstractController
{
    private $colors =[
        'red' => 'rouge',
        'blue' => 'bleu',
        'green' => 'vert',
        'orange' => 'orange',
        'black' => 'noir',
        'brown' => 'marron',
        'yellow' => 'jaune',
        'pink' => 'rose',
        'violet' => 'violet',
        'grey' => 'gris',
    ];
    /**
     * @Route ("/tags", name="tagList")
     */
    public function tagList(TagRepository $tagRepository)
    {
        $listTag = $tagRepository->findAll();
        $color = $this->colors;
        return $this->render('tags.html.twig', ['listTag' => $listTag,
            'colors' => $color]);
    }

    /**
     * @Route ("/tag/{id}", name="tagShow")
     */
    public function tagShow(TagRepository $tagRepository, $id)
    {
        $tag = $tagRepository->find($id);
        $color = $this->colors;
        if(isset($tag)){
            return $this->render('tag.html.twig', ['tag' => $tag,
                'colors' => $color]);
        }else{
            throw new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }

    /**
     * @Route("/tags/add", name="tagAdd")
     */
    public function tagAdd(tagRepository $tagRepository)
    {
        return $this->render('tagadd.html.twig');
    }

    /**
     * @Route("/tags/insert", name="tagInsert")
     */
    public function tagInsert(EntityManagerInterface $entityManager, Request $request)
    {
        $title = $request->request->get('title');
        $color = $request->request->get('color');

        $tag = new Tag();
        $tag->setTitle($title);
        $tag->setColor($color);


        $entityManager->persist($tag);
        $entityManager->flush();

        return $this->redirectToRoute('tagList');

    }

    /**
     * @Route ("/tag/delete/{id}" , name="tagDelete")
     */
    public function tagDelete($id, tagRepository $tagRepository, EntityManagerInterface $entityManager)
    {
        $tag = $tagRepository->find($id);
        $entityManager->remove($tag);
        $entityManager->flush();

        return $this->redirectToRoute('tagList');
    }

    /**
     * @Route("/tag/update/{id}", name="tagUpdate")
     */
    public function tagUpadte($id, tagRepository $tagRepository )
    {
        $tag = $tagRepository->find($id);


        return $this->render('tagupdate.html.twig', ['tag' => $tag]);
    }

    /**
     * @Route("/tag/save/{id}", name="tagSave")
     */
    public function tagSave($id, Request $request, tagRepository $tagRepository, EntityManagerInterface $entityManager)
    {
        $tag = $tagRepository->find($id);

        $title = $request->request->get('title');
        $color = $request->request->get('color');

        $tag->setTitle($title);
        $tag->setColor($color);


        $entityManager->persist($tag);
        $entityManager->flush();

        return $this->redirectToRoute('tagList');


    }

}