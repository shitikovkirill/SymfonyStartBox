<?php

namespace SupportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Support
 *
 * @ORM\Table(name="support")
 * @ORM\Entity(repositoryClass="SupportBundle\Repository\SupportRepository")
 */
class Support
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
     * Many Supports have Many Categories.
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="supports")
     */
    private $categories;


    /**
     * @ORM\Column(type="text")
     *
     */
    private $makros = "";


    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
    

    public function getMakros()
    {
        return $this->makros;
    }

    public function setMakros($makros)
    {
        $this->makros =$makros;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function __toString()
    {
        return $this->makros;
    }

}

