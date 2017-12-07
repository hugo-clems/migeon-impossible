<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Ticket",mappedBy="project")
     */
    private $ticketList;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Customer",inversedBy="projectList")
     */
    private $customer;


    public static function newProject(Customer $customer){
        $project = new Project();
        $project->setDate(new \DateTime('NOW'));
        $project->setCustomer($customer);
        
        return $project;
        
    }
    
    public function getNumberTicket(){
        return $this->getTicketList()->count();
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
     * @return Project
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Project
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
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set customer
     *
     * @param \MyfreelanceBundle\Entity\Customer $customer
     *
     * @return Project
     */
    public function setCustomer(\MyfreelanceBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \MyfreelanceBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticketList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticketList
     *
     * @param \MyfreelanceBundle\Entity\Ticket $ticketList
     *
     * @return Project
     */
    public function addTicketList(\MyfreelanceBundle\Entity\Ticket $ticketList)
    {
        $this->ticketList[] = $ticketList;

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
    
    public function advancement(){
        return 0.5;
    }
    
    public function percentageAdvancement(){
        return $this->advancement()*100;
    }
    
    public function isDeletable(){
        return $this->getTicketList()->count()<=0;
    }
    
    public function countAllTicket(){
        return $this->getTicketList()->count();
    }
    
    public function countOpenTicket(){
        $i = 0;
        foreach($this->getTicketList() as $ticket){
            ($ticket->getState()->getName() == 'fini')?:$i++;
        }
        return $i;
    }
}
