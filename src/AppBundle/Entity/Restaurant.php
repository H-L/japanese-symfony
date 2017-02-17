<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RestaurantRepository")
 */
class Restaurant extends CoffeeShopItem
{
    /**
     * @ORM\OneToMany(targetEntity="Maid", mappedBy="restaurant")
     */
    private $maids;

    /**
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="restaurant")
     */
    private $timeSlots;

    /**
     * @ORM\OneToMany(targetEntity="Restaurant", mappedBy="maids")
     */
    private $events;
    
    /**
     * Set maids
     *
     * @param mixed $maids
     * @return Restaurant
     */
    public function setMaids($maids)
    {
        $this->maids = $maids;

        return $this;
    }

    /**
     * Get maids
     *
     * @return mixed
     */
    public function getMaids()
    {
        return $this->maids;
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

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }
    
    public function __construct()
    {
        $this->timeSlots = new ArrayCollection();
        $this->events = new ArrayCollection();
    }
}
