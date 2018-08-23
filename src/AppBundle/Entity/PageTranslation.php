<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * PageTranslation Entity.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageTranslationRepository")
 */
class PageTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $button;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $ourServicesTitle;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $contactsTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contactsLeft;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $contactsLeftSecond;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $contactsRightFirst;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getButton()
    {
        return $this->button;
    }

    /**
     * @param mixed $button
     */
    public function setButton($button): void
    {
        $this->button = $button;
    }

    /**
     * @return mixed
     */
    public function getOurServicesTitle()
    {
        return $this->ourServicesTitle;
    }

    /**
     * @param mixed $ourServicesTitle
     */
    public function setOurServicesTitle($ourServicesTitle)
    {
        $this->ourServicesTitle = $ourServicesTitle;
    }

    /**
     * @return mixed
     */
    public function getContactsTitle()
    {
        return $this->contactsTitle;
    }

    /**
     * @param mixed $contactsTitle
     */
    public function setContactsTitle($contactsTitle)
    {
        $this->contactsTitle = $contactsTitle;
    }

    /**
     * @return mixed
     */
    public function getContactsLeft()
    {
        return $this->contactsLeft;
    }

    /**
     * @param mixed $contactsLeft
     */
    public function setContactsLeft($contactsLeft)
    {
        $this->contactsLeft = $contactsLeft;
    }

    /**
     * @return mixed
     */
    public function getContactsRightFirst()
    {
        return $this->contactsRightFirst;
    }

    /**
     * @param mixed $contactsRightFirst
     */
    public function setContactsRightFirst($contactsRightFirst)
    {
        $this->contactsRightFirst = $contactsRightFirst;
    }

    /**
     * @return mixed
     */
    public function getContactsLeftSecond()
    {
        return $this->contactsLeftSecond;
    }

    /**
     * @param mixed $contactsLeftSecond
     */
    public function setContactsLeftSecond($contactsLeftSecond)
    {
        $this->contactsLeftSecond = $contactsLeftSecond;
    }



    public function __toString()
    {
        return $this->title ?? '';
    }
}
