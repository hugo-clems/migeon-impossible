<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
/**
 * User
 */

/**
 *  @ORM\Table()
 *  @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\ProviderRepository")
 * @UniqueEntity(fields = "username", targetClass = "MyfreelanceBundle\Entity\User", message="fos_user.username.already_used")
 **/
 class Provider extends User
{
    const PRIX_HEURE = 45;
    
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="Customer",mappedBy="provider")
     */
    protected $customerList;
    
    
    /**
     * @ORM\OneTOMany(targetEntity="Bill",mappedBy="provider")
     */
    protected $billList;
    
    



    public function getId(){
        return $this->id;
    }

    /**
     * Add customerList
     *
     * @param \MyfreelanceBundle\Entity\Customer $customerList
     *
     * @return Provider
     */
    public function addCustomerList(\MyfreelanceBundle\Entity\Customer $customerList)
    {
        $this->customerList[] = $customerList;

        return $this;
    }

    /**
     * Remove customerList
     *
     * @param \MyfreelanceBundle\Entity\Customer $customerList
     */
    public function removeCustomerList(\MyfreelanceBundle\Entity\Customer $customerList)
    {
        $this->customerList->removeElement($customerList);
    }

    /**
     * Get customerList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomerList()
    {
        return $this->customerList;
    }

    /**
     * Add billList
     *
     * @param \MyfreelanceBundle\Entity\Bill $billList
     *
     * @return Provider
     */
    public function addBillList(\MyfreelanceBundle\Entity\Bill $billList)
    {
        $this->billList[] = $billList;

        return $this;
    }

    /**
     * Remove billList
     *
     * @param \MyfreelanceBundle\Entity\Bill $billList
     */
    public function removeBillList(\MyfreelanceBundle\Entity\Bill $billList)
    {
        $this->billList->removeElement($billList);
    }

    /**
     * Get billList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillList()
    {
        return $this->billList;
    }
    
    public function getRoles() {
        $roleList = parent::getRoles();
        array_push($roleList,"ROLE_PROVIDER");
        return $roleList;
    }
    
    public function isProvider() {
        return true;
    }
    
    public function isCustomer() {
        return false;
    }
}
