<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\CustomerRepository")
 * @UniqueEntity(fields = "username", targetClass = "MyfreelanceBundle\Entity\User", message="fos_user.username.already_used")
 */
class Customer extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

   
    /**
     * @ORM\OneToMany(targetEntity="Project",mappedBy="customer")
     */
    private $projectList;
    
    /**
     * @ORM\OneToMany(targetEntity="Bill",mappedBy="customer")
     */
    private $billList;
    
    /**
     * @ORM\ManyToOne(targetEntity="Provider",inversedBy="customerList")
     */
    private $provider;
    
    

    /**
     * Constructor
     */
    public function __construct(Provider $provider)
    {        $this->setProvider($provider);
        $this->projectList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
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
     * Add projectList
     *
     * @param \MyfreelanceBundle\Entity\Project $projectList
     *
     * @return Customer
     */
    public function addProjectList(\MyfreelanceBundle\Entity\Project $projectList)
    {
        $this->projectList[] = $projectList;

        return $this;
    }

    /**
     * Remove projectList
     *
     * @param \MyfreelanceBundle\Entity\Project $projectList
     */
    public function removeProjectList(\MyfreelanceBundle\Entity\Project $projectList)
    {
        $this->projectList->removeElement($projectList);
    }

    /**
     * Get projectList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectList()
    {
        return $this->projectList;
    }

   
    /**
     * Set provider
     *
     * @param \MyfreelanceBundle\Entity\Provider $provider
     *
     * @return Customer
     */
    public function setProvider(\MyfreelanceBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \MyfreelanceBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    public function getRoles() {
        $roleList = parent::getRoles();
        array_push($roleList,"ROLE_CUSTOMER");
        return $roleList;
    }
    
    public function isProvider() {
        return false;
    }
    
    public function isCustomer() {
        return true;
    }
    
    
}
