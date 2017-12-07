<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 */

/**
 *  @ORM\Table()
 * 
 *  @ORM\InheritanceType("JOINED")
 *  @ORM\DiscriminatorColumn(name="discr", type="string")
 *  @ORM\DiscriminatorMap({"provider"="Provider", "customer"="Customer"})
 * 
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\UserRepository")
 **/
    
abstract class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     *
     * @ORM\Column(type="string")
     */
    protected $surname;
    
    /**
     * @ORM\ManyToOne(targetEntity="Society",inversedBy="userList")
     */
    protected $society;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    
    public abstract function isCustomer();
    
    public abstract function isProvider();


    
    





    /**
     * Set society
     *
     * @param \MyfreelanceBundle\Entity\Society $society
     *
     * @return User
     */
    public function setSociety(\MyfreelanceBundle\Entity\Society $society = null)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \MyfreelanceBundle\Entity\Society
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
}
