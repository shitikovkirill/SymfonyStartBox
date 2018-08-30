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
 * Header
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HeaderRepository")
 *
 * @Vich\Uploadable()
 */
class Header
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
     *
     * @Vich\UploadableField(mapping="my_image", fileNameProperty="mobileImage")
     *
     * @var File
     */
    private $mobileImageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $mobileImage;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Many Headers have Many IconBlocks.
     * @ORM\ManyToMany(targetEntity="IconBlock", cascade={"persist"})
     * @ORM\JoinTable(name="headers_icon_blocks",
     *      joinColumns={@ORM\JoinColumn(name="header_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="icon_block_id", referencedColumnName="id")}
     *      )
     */
    private $iconBlocks;

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
        $this->iconBlocks = new ArrayCollection();
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
     * @return Header
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
     * @return string
     */
    public function getMobileImage(): ?string
    {
        return $this->mobileImage;
    }

    /**
     * @param string $mobileImage
     */
    public function setMobileImage(?string $mobileImage): void
    {
        $this->mobileImage = $mobileImage;
    }

    /**
     * @return File
     */
    public function getMobileImageFile(): ?File
    {
        return $this->mobileImageFile;
    }

    /**
     * @param File $mobileImageFile
     */
    public function setMobileImageFile(File $mobileImageFile): void
    {
        $this->mobileImageFile = $mobileImageFile;

        if (null !== $mobileImageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    /**
     * @return mixed
     */
    public function getIconBlocks()
    {
        return $this->iconBlocks;
    }

    /**
     * @param mixed $iconBlocks
     */
    public function setIconBlocks($iconBlocks): void
    {
        $this->iconBlocks = $iconBlocks;
    }

    /**
     * @param IconBlock $iconBlock
     */
    public function addIconBlock(IconBlock $iconBlock)
    {
        $this->iconBlocks->add($iconBlock);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}
