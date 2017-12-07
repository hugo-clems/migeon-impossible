<?php

namespace MyfreelanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="MyfreelanceBundle\Repository\TypeRepository")
 */
class Type
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
     * @ORM\OneToMany(targetEntity="Ticket",mappedBy="type")
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
     * @return Type
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
     * @return Type
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
