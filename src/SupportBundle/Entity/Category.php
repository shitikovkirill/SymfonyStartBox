<?php

namespace SupportBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Support", mappedBy="category")
     */
    private $supports;

    public function __construct() {
        $this->supports = new ArrayCollection();
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

    public function addSupport($support) {
        $this->supports[]= $support;
    }

    public function removeSupport($category) {
        $this->categories->removeElement($category);
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

