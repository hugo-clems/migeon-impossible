<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\BillRepository")
 */
class Bill
{
    const NOT_PAY = 1;
    const PAY = 2;
    const CONSTRUCT = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="settlementDate", type="datetime",nullable= true)
     */
    private $settlementDate;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;
    
    
    /**
     *  @ORM\ManyToOne(targetEntity="CustomerSociety",inversedBy="billList")
    */
    private $customer;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProviderSociety",inversedBy="billList")
     */
    private $provider;
    
    /**
     *  @ORM\OneToMany(targetEntity="Ticket",mappedBy="bill",cascade={"persist"})
     */
    private $ticketList;
    
  
    
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $title;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Bill
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set settlementDate
     *
     * @param \DateTime $settlementDate
     *
     * @return Bill
     */
    public function setSettlementDate($settlementDate)
    {
        $this->settlementDate = $settlementDate;

        return $this;
    }

    /**
     * Get settlementDate
     *
     * @return \DateTime
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Bill
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticketList = new \Doctrine\Common\Collections\ArrayCollection();
    }



     
   

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

        /**
     * Add ticketList
     *
     * @param \MyfreelanceBundle\Entity\Ticket $ticketList
     *
     * @return Bill
     */
    public function addTicketList(\MyfreelanceBundle\Entity\Ticket $ticket)
    {
        $this->ticketList[] = $ticket;
        $ticket->setBill($this);

        return $this;
    }

    /**
     * Remove ticketList
     *
     * @param \MyfreelanceBundle\Entity\Ticket $ticketList
     */
    public function removeTicketList(\MyfreelanceBundle\Entity\Ticket $ticketList)
    {
        $this->ticketList->removeElement($ticketList);
    }

    /**
     * Get ticketList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketList()
    {
        return $this->ticketList;
    }
    
    public function getNumero(){
        return str_pad($this->id,6,0,STR_PAD_LEFT);
    }
    
    public function becomeNotPay(){
        $this->etat = $this::NOT_PAY;
    }
    
    public function etatLabel(){
        switch($this->etat){
            case self::CONSTRUCT:
                return "Construction";
                break;
            case self::NOT_PAY:
                return 'Non Payer';
                break;
            case self::PAY:
                return "pay";
                break;
        }
    }
    
    
    public function isConstruct(){
        return $this->etat == self::CONSTRUCT;
    }
    
    public function getPriceHT(){
        $price = 0;
        foreach($this->getTicketList() as $ticket){
            $price += $ticket->getPrice();
        }
        return $price;
        
    }
    
    public function getPriceTTC(){
        return $this->getPriceHT();
    }



    /**
     * Set customer
     *
     * @param \MyfreelanceBundle\Entity\CustomerSociety $customer
     *
     * @return Bill
     */
    public function setCustomer(\MyfreelanceBundle\Entity\CustomerSociety $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \MyfreelanceBundle\Entity\CustomerSociety
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set provider
     *
     * @param \MyfreelanceBundle\Entity\ProviderSociety $provider
     *
     * @return Bill
     */
    public function setProvider(\MyfreelanceBundle\Entity\ProviderSociety $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \MyfreelanceBundle\Entity\ProviderSociety
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
