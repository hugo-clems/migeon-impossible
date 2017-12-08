<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Society
 *
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\SocietyRepository")
 */
 class ProviderSociety extends Society
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
     *  @ORM\OneToMany(targetEntity="Bill",mappedBy="provider")
     */
    private $billList;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * Add billList
     *
     * @param \MyfreelanceBundle\Entity\Bill $billList
     *
     * @return ProviderSociety
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
}
