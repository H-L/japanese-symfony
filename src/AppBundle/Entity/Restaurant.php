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
    private $review;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Timeslot", mappedBy="restaurant")
     */
    private $timeslot;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $profilePicture;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Gallery")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    private $gallery;
    
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
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getTimeslot()
    {
        return $this->timeslot;
    }

    /**
     * @param mixed $timeslot
     */
    public function setTimeslot($timeslot)
    {
        $this->timeslot = $timeslot;
    }

    /**
     * @return mixed
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @param mixed $profilePicture
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Restaurant constructor.
     */
    public function __construct()
    {
        $this->review = new ArrayCollection();
        $this->event = new ArrayCollection();
        $this->timeslot = new ArrayCollection();
    }
}
