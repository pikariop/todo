<?php

namespace OP\TodoAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="symfony")
 */
class Task
{
	/**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */

	protected $id;

	/**
	* @ORM\Column(type="string", length=1000)
	*/
	protected $text;

	/**
	* @ORM\Column(type="datetime")
	*/
	protected $deadline;

   /**
   * @ORM\Column(type="datetime")
   */
	protected $dateAdded;


   /**
   * @ORM\Column(type="datetime", nullable="true")
   */
	protected $dateCompleted;

	/**
	* @ORM\Column(type="boolean")
	*/
	protected $completed = false;


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
     * Set text
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set deadline
     *
     * @param datetime $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * Get deadline
     *
     * @return datetime 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set dateAdded
     *
     * @param datetime $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * Get dateAdded
     *
     * @return datetime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set dateCompleted
     *
     * @param datetime $dateCompleted
     */
    public function setDateCompleted($dateCompleted)
    {
        $this->dateCompleted = $dateCompleted;
    }

    /**
     * Get dateCompleted
     *
     * @return datetime 
     */
    public function getDateCompleted()
    {
        return $this->dateCompleted;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * Get completed
     *
     * @return boolean 
     */
    public function getCompleted()
    {
        return $this->completed;
    }
}
