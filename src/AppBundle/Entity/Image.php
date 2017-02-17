<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Please, upload the product image.")
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

    public function __construct() {
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
}
