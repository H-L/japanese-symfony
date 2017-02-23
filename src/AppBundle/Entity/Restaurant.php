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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="restaurant")
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="restaurant")
     */
    private $reviews;
    
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
        $this->event->removeElement($maid);

        return $this;
    }
    

    /**
     * Get event
     *
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param mixed $event
     * @return Restaurant
     */
    public function setEvent($event)
    {
        $this->event = $event;

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
        $this->event[] = $event;
    }

    /**
     * Remove event
     *
     * @param mixed $event
     * @return Restaurant
     */
    public function removeEvent($event)
    {
        $this->event->removeElement($event);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Add review
     *
     * @param mixed $review
     * @return Restaurant
     */
    public function addReview($review)
    {
        $this->reviews[] = $review;
    }

    /**
     * Remove event
     *
     * @param mixed $review
     * @return Restaurant
     */
    public function removeReview($review)
    {
        $this->reviews->removeElement($review);

        return $this;
    }

    /**
     * Restaurant constructor.
     */
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->event = new ArrayCollection();
    }
}
