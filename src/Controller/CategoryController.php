<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    private $categories = [
        1 => [
            "title" => "Politique",
            "content" => "Tous les articles liés à Jean Lassalle",
            "id" => 1,
            "published" => true,
        ],
        2 => [
            "title" => "Economie",
            "content" => "Les meilleurs tuyaux pour avoir DU FRIC",
            "id" => 2,
            "published" => true
        ],
        3 => [
            "title" => "Securité",
            "content" => "Attention les étrangers sont très méchants",
            "id" => 3,
            "published" => false
        ],
        4 => [
            "title" => "Ecologie",
            "content" => "Hummer <3",
            "id" => 4,
            "published" => true
        ]
    ];

    /**
     * @Route("categories", name="categoriesList")
     */
    public function categorieList()
    {
        $list = $this->categories;
        return $this->render('categories.html.twig', ['list' => $list]);

    }

    /**
     * @Route("category/{id}", name="categoryShow")
     */
    public function categoryShow($id)
    {
        $categorie = $this->categories{$id};
        return $this->render('categorie.html.twig', ['categorie' => $categorie]);

    }
}