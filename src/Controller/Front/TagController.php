<?php


namespace App\Controller\Front;

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
     * @Route ("/tags", name="tag_list")
     */
    public function tagList(TagRepository $tagRepository)
    {
        $listTag = $tagRepository->findAll();
        $color = $this->colors;
        return $this->render('front/tags.html.twig', ['listTag' => $listTag,
            'colors' => $color]);
    }

    /**
     * @Route ("/tag/{id}", name="tag_show")
     */
    public function tagShow(TagRepository $tagRepository, $id)
    {
        $tag = $tagRepository->find($id);
        $color = $this->colors;
        if(isset($tag)){
            return $this->render('front/tag.html.twig', ['tag' => $tag,
                'colors' => $color]);
        }else{
            throw new NotFoundHttpException("Erreur 404. La page que vous cherchez n'a pas été trouvée");
        }
    }
}