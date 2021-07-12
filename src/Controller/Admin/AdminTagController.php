<?php


namespace App\Controller\Admin;


use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class AdminTagController extends AbstractController
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
     * @Route ("/admin/tags", name="admin_tag_list")
     */
    public function tagList(TagRepository $tagRepository)
    {
        $listTag = $tagRepository->findAll();
        $color = $this->colors;
        return $this->render('admin/tags.html.twig', ['listTag' => $listTag,
            'colors' => $color]);
    }

    /**
     * @Route("/admin/tags/add", name="admin_tag_add")
     */
    public function tagAdd(tagRepository $tagRepository)
    {
        return $this->render('admin/tagadd.html.twig');
    }

    /**
     * @Route("/admin/tags/insert", name="admin_tag_insert")
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

        return $this->redirectToRoute('admin_tag_list');

    }

    /**
     * @Route ("/admin/tag/delete/{id}" , name="admin_tag_delete")
     */
    public function tagDelete($id, tagRepository $tagRepository, EntityManagerInterface $entityManager)
    {
        $tag = $tagRepository->find($id);
        $entityManager->remove($tag);
        $entityManager->flush();

        return $this->redirectToRoute('admin_tag_list');
    }

    /**
     * @Route("/admin/tag/update/{id}", name="admin_tag_update")
     */
    public function tagUpadte($id, tagRepository $tagRepository )
    {
        $tag = $tagRepository->find($id);


        return $this->render('admin/tagupdate.html.twig', ['tag' => $tag]);
    }

    /**
     * @Route("/admin/tag/save/{id}", name="admin_tag_save")
     */
    public function tagSave($id, Request $request,
                            tagRepository $tagRepository,
                            EntityManagerInterface $entityManager)
    {
        $tag = $tagRepository->find($id);

        $title = $request->request->get('title');
        $color = $request->request->get('color');

        $tag->setTitle($title);
        $tag->setColor($color);


        $entityManager->persist($tag);
        $entityManager->flush();

        return $this->redirectToRoute('admin_tag_list');


    }

}