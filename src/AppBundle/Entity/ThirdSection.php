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
 * Class ThirdSection
 *
 * @ORM\Entity()
 *
 * @Vich\Uploadable()
 */
class ThirdSection
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
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Many Pages have Many IconBlocks.
     * @ORM\ManyToMany(targetEntity="IconBlock", cascade={"persist"})
     * @ORM\JoinTable(name="third_section_icon_blocks",
     *      joinColumns={@ORM\JoinColumn(name="section_id", referencedColumnName="id")},
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
        return $this->translate()->getTitle() ?? '';
    }
}