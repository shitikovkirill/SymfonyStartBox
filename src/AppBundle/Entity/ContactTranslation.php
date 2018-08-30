<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * PageTranslation Entity.
 *
 * @ORM\Entity()
 */
class ContactTranslation
{
    use ORMBehaviors\Translatable\Translation;

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
