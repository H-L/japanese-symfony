<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Timeslot
 *
 * @ORM\Table(name="time_slot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TimeslotRepository")
 */
class Timeslot
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
     * StartHour
     *
     * @var int
     *
     * @ORM\Column(name="start_hour", type="integer")
     */
    private $startHour;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="start_minute", type="integer")
     */
    private $startMinute;

    /**
     * @var int
     *
     * @ORM\Column(name="end_hour", type="integer")
     */
    private $endHour;

    /**
     * @var int
     *
     * @ORM\Column(name="end_minute", type="integer")
     */
    private $endMinute;

    /**
     * @var int
     *
     * @ORM\Column(name="dayOfWeek", type="integer")
     */
    private $dayOfWeek;

    /**
     * @ORM\ManyToOne(targetEntity="Maid", inversedBy="timeslots")
     * @ORM\JoinColumn(name="id_maid", referencedColumnName="id")
     */
    private $maid;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return int
     */
    public function getStartHour()
    {
        return $this->startHour;
    }

    /**
     * @param int $startHour
     */
    public function setStartHour($startHour)
    {
        $this->startHour = $startHour;
    }

    /**
     * @return int
     */
    public function getStartMinute()
    {
        return $this->startMinute;
    }

    /**
     * @param int $startMinute
     */
    public function setStartMinute($startMinute)
    {
        $this->startMinute = $startMinute;
    }

    /**
     * @return int
     */
    public function getEndHour()
    {
        return $this->endHour;
    }

    /**
     * @param int $endHour
     */
    public function setEndHour($endHour)
    {
        $this->endHour = $endHour;
    }

    /**
     * @return int
     */
    public function getEndMinute()
    {
        return $this->endMinute;
    }

    /**
     * @param int $endMinute
     */
    public function setEndMinute($endMinute)
    {
        $this->endMinute = $endMinute;
    }

    /**
     * Set dayOfWeek
     *
     * @param integer $dayOfWeek
     * @return Timeslot
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return integer
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }


    /**
     * @return mixed
     */
    public function getMaid()
    {
        return $this->maid;
    }

    /**
     * @param mixed $maid
     * @return Timeslot
     */
    public function setMaid($maid)
    {
        $this->maid = $maid;
        
        return $this;
    }

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        $diffHour = $this->endHour - $this->startHour;
        $diffMinute = $this->endMinute - $this->startMinute;
        //if timeslot is less than 1 hour long
        if ($diffHour < 1 || ($diffHour === 1 && $diffMinute < 0 )) {
            $context->buildViolation('Maids must work at least 1 hour')
                ->addViolation()
            ;
        }
    }

}
