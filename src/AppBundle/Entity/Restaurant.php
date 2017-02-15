<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RestaurantRepository")
 */
class Restaurant extends CoffeeShopItem
{
    /**
     * @var string
     *
     * @ORM\Column(name="employees", type="string", length=255)
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="restaurant")
     */
    private $timeSlots;
    
    /**
     * Set employees
     *
     * @param string $employees
     * @return Restaurant
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;

        return $this;
    }

    /**
     * Get employees
     *
     * @return string 
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @return mixed
     */
    public function getTimeSlots()
    {
        return $this->timeSlots;
    }

    /**
     * @param mixed $timeSlots
     */
    public function setTimeSlots($timeSlots)
    {
        $this->timeSlots = $timeSlots;
    }

    public function __construct()
    {
        $this->timeSlots = new ArrayCollection();
    }
}
