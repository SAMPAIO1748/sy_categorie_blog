<?php


namespace App\Entity;

use App\Repository\ArticleRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{

    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez remplir le titre de l'artcile")
     * @Assert\Length(
     *     min = 2,
     *     max = 200,
     *     minMessage="Votre titre doit faire au moins 2 caractères.",
     *     maxMessage="Votre titre doit faire au plus 200 caractères"
     * )
    */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez remplir le contenu de l'artcile")
     * @Assert\Length(
     *     min = 10,
     *     max = 999999999999999999999999999999999999999999999999999999999999999999999999,
     *     minMessage="Votre contenu doit faire au moins 10 caractères.",
     *     maxMessage="Votre contenu doit faire au plus 999999999999999999999999999999999999999999999999999999999999999999999999 caractères"
     * )
     */
    private $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
    * @ORM\Column(type="datetime")
    */
    private $createdAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @ORM\Column (type="boolean")
     */
    private $isPublished;

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     */
    private $category;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tag", inversedBy="articles")
     */
    private  $tag;

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag): void
    {
        $this->tag = $tag;
    }
}