<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeSlot
 *
 * @ORM\Table(name="time_slot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TimeSlotRepository")
 */
class TimeSlot
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
     * @var array
     *
     * @ORM\Column(name="startTime", type="array")
     */
    private $startTime;

    /**
     * @var array
     *
     * @ORM\Column(name="endTime", type="array")
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(name="dayOfWeek", type="integer")
     */
    private $dayOfWeek;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="timeSlots")
     * @ORM\JoinColumn(name="id_restaurant", referencedColumnName="id")
     */
    private $restaurant;


    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="timeSlots")
     * @ORM\JoinColumn(name="id_employee", referencedColumnName="id")
     */
    private $employee;


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
     * Set startTime
     *
     * @param array $startTime
     * @return TimeSlot
     */
    public function setStartTime(array $startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return array 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param array $endTime
     * @return TimeSlot
     */
    public function setEndTime(array $endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return array 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set dayOfWeek
     *
     * @param integer $dayOfWeek
     * @return TimeSlot
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return integer 
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }
    
}
