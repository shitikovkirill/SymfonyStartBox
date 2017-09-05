<?php

namespace ShowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shows
 *
 * @ORM\Table(name="shows")
 * @ORM\Entity(repositoryClass="ShowBundle\Repository\ShowsRepository")
 */
class Shows
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
    private $name;


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

    public function getName()
    {
        return $this->name;
    }


    public function getMakros()
    {
        return $this->makros;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function setMakros($makros)
    {
        $this->makros = $makros;

        return $this;
    }



}


