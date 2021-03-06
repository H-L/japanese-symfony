<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Please, upload the image.")
     * @Assert\Image()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="profilePicture")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Restaurant", mappedBy="profilePicture")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Maid", mappedBy="profilePicture")
     */
    private $maids;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Gallery", mappedBy="images")
     */
    private $galleries;

    /**
     * Add gallery
     *
     * @param \AppBundle\Entity\Gallery $gallery
     *
     * @return Image
     */
    public function addGallery(\AppBundle\Entity\Gallery $gallery)
    {
        $this->galleries[] = $gallery;

        return $this;
    }

    /**
     * Remove gallery
     *
     * @param \AppBundle\Entity\Gallery $gallery
     */
    public function removeGallery(\AppBundle\Entity\Gallery $gallery)
    {
        $this->galleries->removeElement($gallery);
    }

    /**
     * Get galleries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleries()
    {
        return $this->galleries;
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

    /**
     * @return mixed
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * @param mixed $restaurants
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants = $restaurants;
    }

    /**
     * @return mixed
     */
    public function getMaids()
    {
        return $this->maids;
    }

    /**
     * @param mixed $maids
     */
    public function setMaids($maids)
    {
        $this->maids = $maids;
    }

    public function __construct() {
        $this->galleries = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->restaurants = new ArrayCollection();
        $this->maids = new ArrayCollection();
    }
}
