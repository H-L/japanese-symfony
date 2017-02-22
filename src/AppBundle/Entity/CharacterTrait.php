<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CharacterTrait
 *
 * @ORM\Table(name="character_trait")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterTraitRepository")
 */
class CharacterTrait
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Maid", mappedBy="characterTrait")
     */
    private $maid;

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
     * @return CharacterTrait
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
     * @param mixed $maid
     */
    public function setMaid($maid)
    {
        $this->maid = $maid;
    }

    /**
     * @return mixed
     */
    public function getMaid()
    {
        return $this->maid;
    }

    public function __contruct()
    {
        $this->maid = new ArrayCollection();
    }
}

