<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Service
 *
 * @ORM\Entity()
 */
class Service
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=30, unique=true)
     */
    private $slug;

    /**
     * Many Services have Many IconBlocks.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\IconFileBlock", cascade={"persist"})
     * @ORM\JoinTable(name="services_icon_blocks",
     *      joinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="icon_block_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"order" = "DESC"})
     */
    private $servicesIcons;

    /**
     * @Assert\Valid
     */
    protected $translations;

    public function __call($method, $arguments)
    {
        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->servicesIcons = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getServicesIcons()
    {
        return $this->servicesIcons;
    }

    /**
     * @param mixed $servicesIcons
     */
    public function setServicesIcons($servicesIcons)
    {
        $this->servicesIcons = $servicesIcons;
    }

    /**
     * @param mixed $servicesIcon
     */
    public function addServicesIcon($servicesIcon)
    {
        $this->servicesIcons->add($servicesIcon);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}