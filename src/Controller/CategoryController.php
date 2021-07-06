<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    private $categories = [
        1 => [
            "title" => "Batman",
            "content" => "Tous les articles lié au Chevalier Noir de Gotham",
            "id" => 1,
            "published" => true,
        ],
        2 => [
            "title" => "Superman",
            "content" => "Toutes les informations sur l'Homme d'Acier",
            "id" => 2,
            "published" => true
        ],
        3 => [
            "title" => "Spider-man",
            "content" => "La base de ce qu'il faut savoir sur l'Araignée du coin",
            "id" => 3,
            "published" => false
        ],
        4 => [
            "title" => "Wonder Woman",
            "content" => "Toute l'histoire de la Princesse des Amazones",
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

        if(array_key_exists($id, $this->categories)){
            $categorie = $this->categories{$id};
            return $this->render('categorie.html.twig', ['categorie' => $categorie]);
        }else{
            return $this->redirectToroute('categoriesList');
        }


    }
}