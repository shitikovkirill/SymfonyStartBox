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
     * Many Pages have Many IconBlocks.
     * @ORM\ManyToMany(targetEntity="IconBlock", cascade={"persist"})
     * @ORM\JoinTable(name="pages_icon_blocks",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="icon_block_id", referencedColumnName="id")}
     *      )
     */
    private $iconBlocks;

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
     * Many Pages have Many IconBlocks.
     * @ORM\ManyToMany(targetEntity="IconBlock", cascade={"persist"})
     * @ORM\JoinTable(name="pages_our_services_icon_blocks",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="icon_block_id", referencedColumnName="id")}
     *      )
     */
    private $ourServicesIcons;

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
        $this->secondSections = new ArrayCollection();
        $this->thirdSections = new ArrayCollection();
        $this->ourServicesIcons = new ArrayCollection();
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
     * @return mixed
     */
    public function getOurServicesIcons()
    {
        return $this->ourServicesIcons;
    }

    /**
     * @param mixed $ourServicesIcons
     */
    public function setOurServicesIcons($ourServicesIcons)
    {
        $this->ourServicesIcons = $ourServicesIcons;
    }

    /**
     * @param mixed $ourServicesIcon
     */
    public function addOurServicesIcon($ourServicesIcon)
    {
        $this->ourServicesIcons->add($ourServicesIcon);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}
