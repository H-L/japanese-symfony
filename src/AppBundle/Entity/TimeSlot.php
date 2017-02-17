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
     * @var int
     *
     * @ORM\Column(name="start_hour", type="integer")
     */
    private $startHour;


    /**
     * @var int
     *
     * @ORM\Column(name="start_minute", type="integer")
     */
    private $startMinute;

    /**
     * @var int
     *
     * @ORM\Column(name="end_hour", type="integer")
     */
    private $endHour;


    /**
     * @var int
     *
     * @ORM\Column(name="end_minute", type="integer")
     */
    private $endMinute;

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
     * @ORM\ManyToOne(targetEntity="Maid", inversedBy="timeSlots")
     * @ORM\JoinColumn(name="id_maid", referencedColumnName="id")
     */
    private $maid;

    /**
     * @var array
     *
     * @ORM\Column(name="start_time", type="array")
     */
    private $startTime;
    
    /**
     * @var array
     *
     * @ORM\Column(name="end_time", type="array")
     */
    private $endTime;
    
    
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
     * @return int
     */
    public function getStartHour()
    {
        return $this->startHour;
    }

    /**
     * @param int $startHour
     */
    public function setStartHour($startHour)
    {
        $this->startHour = $startHour;
    }

    /**
     * @return int
     */
    public function getStartMinute()
    {
        return $this->startMinute;
    }

    /**
     * @param int $startMinute
     */
    public function setStartMinute($startMinute)
    {
        $this->startMinute = $startMinute;
    }

    /**
     * Set startTime
     * 
     * @return TimeSlot
     */
    public function setStartTime()
    {
        $this->startTime = [$this->getStartHour(), $this->getStartMinute()];

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
     * @return int
     */
    public function getEndHour()
    {
        return $this->endHour;
    }

    /**
     * @param int $endHour
     */
    public function setEndHour($endHour)
    {
        $this->endHour = $endHour;
    }

    /**
     * @return int
     */
    public function getEndMinute()
    {
        return $this->endMinute;
    }

    /**
     * @param int $endMinute
     */
    public function setEndMinute($endMinute)
    {
        $this->endMinute = $endMinute;
    }

    /**
     * Set endTime
     *
     * @return TimeSlot
     */
    public function setEndTime()
    {
        $this->endTime = [$this->getEndHour(), $this->getEndMinute()];

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
    public function getMaid()
    {
        return $this->maid;
    }

    /**
     * @param mixed $maid
     */
    public function setMaid($maid)
    {
        $this->maid = $maid;
    }

    public function __construct()
    {
        
    }
    
}
