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
     * @ORM\Column(type="text")
     *
     */
    private $category;


    /**
     * @ORM\Column(type="text")
     *
     */
    private $makros;


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

    public function getMakros()
    {
        return $this->makros;
    }

    public function setMakros($makros)
    {
        $this->makros =$makros;

        return $this;
    }
}

