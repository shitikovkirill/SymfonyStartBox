<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CallOrder
 *
 * @ORM\Table(name="call_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CallOrderRepository")
 */
class CallOrder
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
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="callRequerstTime", type="datetime")
     */
    private $callRequerstTime;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=255)
     */
    private $ipAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="browser", type="string", length=255, nullable=true)
     */
    private $browser;

    /**
     * @var bool
     *
     * @ORM\Column(name="called", type="boolean")
     */
    private $called = false;

    /**
     * CallOrder constructor.
     */
    public function __construct()
    {
        $this->callRequerstTime = new \DateTime('now');
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
     * Set callRequerstTime.
     *
     * @param \DateTime $callRequerstTime
     *
     * @return CallOrder
     */
    public function setCallRequerstTime($callRequerstTime)
    {
        $this->callRequerstTime = $callRequerstTime;

        return $this;
    }

    /**
     * Get callRequerstTime.
     *
     * @return \DateTime
     */
    public function getCallRequerstTime()
    {
        return $this->callRequerstTime;
    }

    /**
     * Set ipAddress.
     *
     * @param string $ipAddress
     *
     * @return CallOrder
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress.
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set browser.
     *
     * @param string|null $browser
     *
     * @return CallOrder
     */
    public function setBrowser($browser = null)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser.
     *
     * @return string|null
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set called.
     *
     * @param bool $called
     *
     * @return CallOrder
     */
    public function setCalled($called)
    {
        $this->called = $called;

        return $this;
    }

    /**
     * Get called.
     *
     * @return bool
     */
    public function getCalled()
    {
        return $this->called;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->phone;
    }
}
