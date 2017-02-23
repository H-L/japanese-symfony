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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="restaurant")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="restaurant")
     */
    private $review;
    
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
     * Add maid
     *
     * @param mixed $maid
     * @return Restaurant
     */
    public function addMaid($maid)
    {
        $this->maids[] = $maid;

        return $this;
    }

    /**
     * Remove maid
     *
     * @param mixed $maid
     * @return Restaurant
     */
    public function removeMaid($maid)
    {
        $this->events->removeElement($maid);

        return $this;
    }
    

    /**
     * Get events
     *
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set events
     *
     * @param mixed $events
     * @return Restaurant
     */
    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * Add event
     *
     * @param mixed $event
     * @return Restaurant
     */
    public function addEvent($event)
    {
        $this->events[] = $event;
    }

    /**
     * Remove event
     *
     * @param mixed $event
     * @return Restaurant
     */
    public function removeEvent($event)
    {
        $this->events->removeElement($event);

        return $this;
    }
    
    /**
     * Restaurant constructor.
     */
    public function __construct()
    {
        $this->timeslots = new ArrayCollection();
        $this->review = new ArrayCollection();
        $this->events = new ArrayCollection();
    }
}
