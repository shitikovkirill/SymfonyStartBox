<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 31.08.17
 * Time: 22:15
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * One User have Many Categories.
     * @ORM\OneToMany(targetEntity="SupportBundle\Entity\Category", mappedBy="user")
     */
    private $categories;

    public function __construct()
    {
        parent::__construct();

        $this->categories = new ArrayCollection();
    }

    public function getCategories()
    {
        return $this->categories;
    }
}