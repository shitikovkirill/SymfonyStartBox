<?php

namespace SupportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="SupportBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="text")
     *
     */
    private $category = "";


    /**
     * Many Categories have Many Supports.
     * @ORM\ManyToMany(targetEntity="Support", inversedBy="categories")
     * @ORM\JoinTable(name="categories_supports")
     */
    private $supports;

    public function __construct() {
        $this->supports = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupports()
    {
        return $this->supports;
    }

    /**
     * @param mixed $supports
     */
    public function setSupports($supports)
    {
        $this->supports = $supports;
    }

    public function __toString()
    {
        return $this->category;
    }


}

