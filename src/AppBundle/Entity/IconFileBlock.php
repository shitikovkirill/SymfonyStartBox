<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Header
 *
 * @ORM\Entity()
 *
 * @Vich\Uploadable()
 */
class IconFileBlock extends IconBlock
{
    /**
     *
     * @Vich\UploadableField(mapping="my_doc", fileNameProperty="file")
     *
     * @var File
     */
    private $tmpFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $file;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @param string|null $file
     */
    public function setFile(?string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return File
     */
    public function getTmpFile(): ?File
    {
        return $this->tmpFile;
    }

    /**
     * @param File $tmpFile
     */
    public function setTmpFile(File $tmpFile): void
    {
        $this->tmpFile = $tmpFile;

        if (null !== $tmpFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug ?? '';
    }
}