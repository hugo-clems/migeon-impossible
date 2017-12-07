<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\TicketRepository")
 */
class Ticket
{
    
    const PRIX_HEURE = 30;
    const STATE_UNTREATED = 0;
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="taskList")
     */
    private $type;
    
     /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="State", inversedBy="taskList")
     */
    private $state;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bill",inversedBy="ticketList",cascade={"persist"})
     */
    private $bill;
    /**
     *
     * @var float
     * 
     * @ORM\Column(name="percentage",type="float",options={"comments":"pourcentage d'avancement"})
     * 
     * 
     */
    private $percentage = 0;

    
    /**
     * @ORM\ManyToOne(targetEntity="Project",inversedBy="ticketList")
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="Task",mappedBy="ticket")
     */
    private $taskList;
    
    /**
     * @ORM\Column(name="price",type="float",nullable=true)
     */
    private $price;
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
     * Set title
     *
     * @param string $title
     *
     * @return Ticket
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Ticket
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ticket
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
     * Constructor
     */
    public function __construct()
    {
        $this->taskList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Ticket
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set percentage
     *
     * @param float $percentage
     *
     * @return Ticket
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return float
     */
    public function getPercentage()
    {
        return (int) $this->percentage;
    }

    /**
     * Set project
     *
     * @param Project $project
     *
     * @return Ticket
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add taskList
     *
     * @param Task $taskList
     *
     * @return Ticket
     */
    public function addTaskList(Task $taskList)
    {
        $this->taskList[] = $taskList;

        return $this;
    }

    /**
     * Remove taskList
     *
     * @param Task $taskList
     */
    public function removeTaskList(Task $taskList)
    {
        $this->taskList->removeElement($taskList);
    }

    /**
     * Get taskList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTaskList()
    {
        return $this->taskList;
    }
    
    public function stateLabel(){
        switch($this->state){
            case self::STATE_UNTREATED:
                return "non traiter";
        }
    }
    
    public static function createWithProject(Project $project){
       $ticket = new Ticket();
       $ticket->setProject($project);
       $ticket->setStartDate(new \DateTime('NOW'));
       
       return $ticket;
    }

    /**
     * Set type
     *
     * @param \MyfreelanceBundle\Entity\Type $type
     *
     * @return Ticket
     */
    public function setType(\MyfreelanceBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \MyfreelanceBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set bill
     *
     * @param \MyfreelanceBundle\Entity\Bill $bill
     *
     * @return Ticket
     */
    public function setBill(\MyfreelanceBundle\Entity\Bill $bill = null)
    {
        $this->bill = $bill;

        return $this;
    }

    /**
     * Get bill
     *
     * @return \MyfreelanceBundle\Entity\Bill
     */
    public function getBill()
    {
        return $this->bill;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getNbHour(){
        
        $originDate = new \DateTime("1970-01-01 00:00:00.000000");
        foreach($this->getTaskList() as $task){
            $date = $task->getNbHour();
            $originDate->add($task->getNbHourInterval());
        }
        
        return $originDate;
    }
    
    /**
     * @return time to work in 
     */
        
    public function getTimeToWork(){
        $arg1 = $this->getNbHour();
        $nbMinute = 0;
        $nbMinute += ($arg1->format('h') > 0)?$arg1->format('h')*60:0;
        $nbMinute += ($arg1->format('d') > 1)?($arg1->format('d')-1)*60*24:0;
        $nbMinute += ($arg1->format('m') > 1)? ($arg1->format('m')-1)*60*24*31:0;
        $nbMinute += $arg1->format('i');
        return $nbMinute;
    }
    
    public function initPrice(){
        $price = ($this->getTimeToWork()/60)* 30;
        $this->setPrice($price);
        return $price;
    }
    


}
