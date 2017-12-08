<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="state")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\StateRepository")
 */
class State
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
     * @ORM\OneToMany(targetEntity="Ticket",mappedBy="state")
     */
    private $taskList;

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
     * @return State
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
    public function getname()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->taskList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add taskList
     *
     * @param \MyfreelanceBundle\Entity\Ticket $taskList
     *
     * @return State
     */
    public function addTaskList(\MyfreelanceBundle\Entity\Ticket $taskList)
    {
        $this->taskList[] = $taskList;

        return $this;
    }

    /**
     * Remove taskList
     *
     * @param \MyfreelanceBundle\Entity\Ticket $taskList
     */
    public function removeTaskList(\MyfreelanceBundle\Entity\Ticket $taskList)
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
}
