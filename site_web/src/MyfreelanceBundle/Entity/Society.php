<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Society
 *
 * @ORM\Table(name="society")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr",type="string")
 * @ORM\DiscriminatorMap({"customer"="CustomerSociety","provider"="ProviderSociety"})
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\SocietyRepository")
 * 
 */
abstract class Society
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
     * @ORM\OneToMany(targetEntity="User",mappedBy="society")
     */
    private $userList;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=255)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="siren", type="string", length=255)
     */
    private $siren;

    /**
     * @var string
     *
     * @ORM\Column(name="legalForm", type="string", length=255)
     */
    private $legalForm;

    

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
     * Set name
     *
     * @param string $name
     *
     * @return Society
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
     * Set address
     *
     * @param string $address
     *
     * @return Society
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Society
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Society
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Society
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Society
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set siren
     *
     * @param string $siren
     *
     * @return Society
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * Get siren
     *
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set legalForm
     *
     * @param string $legalForm
     *
     * @return Society
     */
    public function setLegalForm($legalForm)
    {
        $this->legalForm = $legalForm;

        return $this;
    }

    /**
     * Get legalForm
     *
     * @return string
     */
    public function getLegalForm()
    {
        return $this->legalForm;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userList
     *
     * @param \MyfreelanceBundle\Entity\User $userList
     *
     * @return Society
     */
    public function addUserList(\MyfreelanceBundle\Entity\User $userList)
    {
        $this->userList[] = $userList;

        return $this;
    }

    /**
     * Remove userList
     *
     * @param \MyfreelanceBundle\Entity\User $userList
     */
    public function removeUserList(\MyfreelanceBundle\Entity\User $userList)
    {
        $this->userList->removeElement($userList);
    }

    /**
     * Get userList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserList()
    {
        return $this->userList;
    }
}
