<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\TaskRepository")
 */
class Task
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="nbHour", type="time")
     */
    private $nbHour;
    
    /**
     * @ORM\Column(name="description",type="text")
     */
    private $description;

 
    /**
     * @ORM\ManyToOne(targetEntity="Ticket",inversedBy="taskList")
     */
    private $ticket;
    

    public static function create(Ticket $ticket){
        $task = new Task();
        $task->setTicket($ticket)
                ->setDate(new \DateTime('NOW'));
        return $task;
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

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Task
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
     * Set nbHour
     *
     * @param integer $nbHour
     *
     * @return Task
     */
    public function setNbHour($nbHour)
    {
        $this->nbHour = $nbHour;

        return $this;
    }

    /**
     * Get nbHour
     *
     * @return int
     */
    public function getNbHour()
    {
        return $this->nbHour;
    }
    
    public function getNbHourInterval(){
        
        $originDate = new \DateTime("1970-01-01 00:00:00.000000");
        
        return $originDate->diff($this->nbHour);
    }

   
    /**
     * Set ticket
     *
     * @param \TicketBundle\Entity\Ticket $ticket
     *
     * @return Task
     */
    public function setTicket(Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \TicketBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
  

}
