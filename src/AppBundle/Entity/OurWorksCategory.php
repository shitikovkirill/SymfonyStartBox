<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * OurWorksCategory
 *
 * @ORM\Entity()
 *
 * @Vich\Uploadable()
 */
class OurWorksCategory
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
     *
     * @Vich\UploadableField(mapping="my_image", fileNameProperty="image")
     *
     * @var File
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Many OurWorksCategory have Many OurWorks.
     * @ORM\ManyToMany(targetEntity="OurWorks", cascade={"persist"})
     * @ORM\JoinTable(name="our_works_categories",
     *      joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="our_work_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"order" = "DESC"})
     */
    private $ourWorks;

    /**
     * @Assert\Valid
     */
    protected $translations;

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
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
        $this->ourWorks = new ArrayCollection();
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
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file): void
    {
        $this->file = $file;

        if (null !== $file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return mixed
     */
    public function getOurWorks()
    {
        return $this->ourWorks;
    }

    /**
     * @param mixed $ourWorks
     */
    public function setOurWorks($ourWorks)
    {
        $this->ourWorks = $ourWorks;
    }

    /**
     * @param mixed $ourWork
     */
    public function addOurWorks($ourWork)
    {
        $this->ourWorks->add($ourWork);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}