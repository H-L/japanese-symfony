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
     * @ORM\OneToMany(targetEntity="Timeslot", mappedBy="restaurant")
     */
    private $timeslots;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="restaurant")
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
    public function getTimeslots()
    {
        return $this->timeslots;
    }

    /**
     * @param mixed $timeslots
     */
    public function setTimeslots($timeslots)
    {
        $this->timeslots = $timeslots;
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
        $this->timeslots = new ArrayCollection();
        $this->events = new ArrayCollection();
    }
}
