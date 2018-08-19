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
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 *
 * @Vich\Uploadable()
 */
class Page
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
     *
     * @Vich\UploadableField(mapping="my_image", fileNameProperty="topImage")
     *
     * @var File
     */
    private $topImageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $topImage;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Many Pages have Many Privileges.
     * @ORM\ManyToMany(targetEntity="Privilege", cascade={"persist"})
     * @ORM\JoinTable(name="pages_privileges",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="privilege_id", referencedColumnName="id")}
     *      )
     */
    private $privileges;

    /**
     * Many Pages have Many SecondSections.
     * @ORM\ManyToMany(targetEntity="SecondSection", cascade={"persist"})
     * @ORM\JoinTable(name="pages_second_sections",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="section_id", referencedColumnName="id")}
     *      )
     */
    private $secondSections;


    /**
     * Many Pages have Many SecondSections.
     * @ORM\ManyToMany(targetEntity="ThirdSection", cascade={"persist"})
     * @ORM\JoinTable(name="pages_third_sections",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="section_id", referencedColumnName="id")}
     *      )
     */
    private $thirdSections;

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
        $this->privileges = new ArrayCollection();
        $this->secondSections = new ArrayCollection();
        $this->thirdSections = new ArrayCollection();
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
     * @return Page
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
     * @return string
     */
    public function getTopImage(): ?string
    {
        return $this->topImage;
    }

    /**
     * @param string $topImage
     */
    public function setTopImage(?string $topImage): void
    {
        $this->topImage = $topImage;
    }

    /**
     * @return File
     */
    public function getTopImageFile(): ?File
    {
        return $this->topImageFile;
    }

    /**
     * @param File $topImageFile
     */
    public function setTopImageFile(File $topImageFile): void
    {
        $this->topImageFile = $topImageFile;

        if (null !== $topImageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return mixed
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @param mixed $privileges
     */
    public function setPrivileges($privileges): void
    {
        $this->privileges = $privileges;
    }

    /**
     * @param Privilege $privilege
     */
    public function addPrivilege(Privilege $privilege)
    {
        $this->privileges->add($privilege);
    }

    /**
     * @return mixed
     */
    public function getSecondSections()
    {
        return $this->secondSections;
    }

    /**
     * @param mixed $secondSections
     */
    public function setSecondSections($secondSections): void
    {
        $this->secondSections = $secondSections;
    }

    /**
     * @param SecondSection $secondSection
     */
    public function addSecondSection(SecondSection $secondSection): void
    {
        $this->secondSections->add($secondSection);
    }

    /**
     * @return mixed
     */
    public function getThirdSections()
    {
        return $this->thirdSections;
    }

    /**
     * @param mixed $thirdSections
     */
    public function setThirdSections($thirdSections): void
    {
        $this->thirdSections = $thirdSections;
    }

    /**
     * @param ThirdSection $thirdSection
     */
    public function addThirdSection(ThirdSection $thirdSection): void
    {
        $this->thirdSections->add($thirdSection);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}
