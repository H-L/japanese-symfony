<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Maid
 *
 * @ORM\Table(name="maid")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaidRepository")
 */
class Maid extends CoffeeShopItem
{
    /**
     * @var string
     * @ORM\Column(name="lastName", type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="maids")
     */
    private $restaurant;

    /**
     * @var string
     * @ORM\Column(name="maidName", type="string", length=100, nullable=true)
     */
    private $maidName;

    /*
     * @var string
     * @ORM\Column(name="favoriteThings", type="string", length=255, nullable=true)
     */
    private $favoriteThings;

    /**
     * @var string
     * @ORM\Column(name="bloodType", type="string", length=255, nullable=true)
     */
    private $bloodType;

    /**
     * @var string
     * @ORM\Column(name="blogUrl", type="string", length=255, nullable=true)
     */
    private $blogUrl;

    /**
     * @var string
     * @ORM\Column(name="twitterUrl", type="string", length=255, nullable=true)
     */
    private $twitterUrl;

    /**
     * @ORM\OneToMany(targetEntity="Timeslot", mappedBy="maid")
     */
    private $timeslots;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="maid")
     */
    private $review;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CharacterTrait", inversedBy="maid")
     */
    private $characterTrait;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rank", inversedBy="maid")
     */
    private $rank;

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
     * Set lastName
     *
     * @param string $lastName
     * @return Maid
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set restaurant
     *
     * @param mixed $restaurant
     * @return Maid
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Set maidName
     *
     * @param string $maidName
     * @return Maid
     */
    public function setMaidName($maidName)
    {
        $this->maidName = $maidName;

        return $this;
    }

    /**
     * Get maidName
     *
     * @return string
     */
    public function getMaidName()
    {
        return $this->maidName;
    }

    /**
     * Set favoriteThings
     *
     * @param string $favoriteThings
     * @return Maid
     */
    public function setFavoriteThings($favoriteThings)
    {
        $this->favoriteThings = $favoriteThings;

        return $this;
    }

    /**
     * Get favoriteThings
     *
     * @return string
     */
    public function getFavoriteThings()
    {
        return $this->favoriteThings;
    }

    /**
     * Set blogUrl
     *
     * @param string $blogUrl
     * @return Maid
     */
    public function setBlogUrl($blogUrl)
    {
        $this->blogUrl = $blogUrl;

        return $this;
    }

    /**
     * Get blogUrl
     *
     * @return string
     */
    public function getBlogUrl()
    {
        return $this->blogUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     * @return Maid
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;

        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Get Blootype
     * @return string
     */
    public function getBloodType()
    {
        return $this->bloodType;
    }

    /**
     * Set BloodType
     * @param string $bloodType
     * @return Restaurant
     */
    public function setBloodType($bloodType)
    {
        $this->bloodType = $bloodType;
        
        return $this;
    }

    /**
     * Get Timeslots
     *
     * @return mixed
     */
    public function getTimeslots()
    {
        return $this->timeslots;
    }

    /**
     * Set TimeSlots
     *
     * @param mixed $timeslots
     * @return Maid
     */
    public function setTimeslots($timeslots)
    {
        $this->timeslots = $timeslots;

        return $this;
    }

    /**
     * Add Timeslot
     *
     * @param $timeslot
     * @return Restaurant
     */
    public function addTimeslot($timeslot)
    {
        $this->timeslots[] = $timeslot;

        return $this;
    }

    /**
     * Remove timeslot
     *
     * @param mixed $timeslot
     * @return Restaurant
     */
    public function removeTimeSlot($timeslot)
    {
        $this->timeslots->removeElement($timeslot);

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
     * @param mixed $characterTrait
     * @return $this
     */
    public function setCharacterTrait($characterTrait)
    {
        $this->characterTrait = $characterTrait;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharacterTrait()
    {
        return $this->characterTrait;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
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
     * Maid constructor.
     */
    public function __construct()
    {
        $this->timeslots = new ArrayCollection();
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
}
