<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee extends CoffeeShopItem
{
    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=100)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="restaurants", type="string", length=255, nullable=true)
     */
    private $restaurants;

    /**
     * @var string
     *
     * @ORM\Column(name="maidName", type="string", length=100, nullable=true)
     */
    private $maidName;

    /**
     * @var string
     *
     * @ORM\Column(name="favoriteThings", type="string", length=255, nullable=true)
     */
    private $favoriteThings;

    /**
     * @var string
     *
     * @ORM\Column(name="bloodType", type="string", length=255, nullable=true)
     */
    private $bloodType;

    /**
     * @var string
     *
     * @ORM\Column(name="blogUrl", type="string", length=255, nullable=true)
     */
    private $blogUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="twitterUrl", type="string", length=255, nullable=true)
     */
    private $twitterUrl;

    /**
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="employee")
     */
    private $timeSlots;
    
    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Employee
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
     * Set restaurants
     *
     * @param string $restaurants
     * @return Employee
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants = $restaurants;

        return $this;
    }

    /**
     * Get restaurants
     *
     * @return string 
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * Set maidName
     *
     * @param string $maidName
     * @return Employee
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
     * @return Employee
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
     * @return Employee
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
     * @return Employee
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
     * @return string
     */
    public function getBloodType()
    {
        return $this->bloodType;
    }

    /**
     * @param string $bloodType
     */
    public function setBloodType($bloodType)
    {
        $this->bloodType = $bloodType;
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
