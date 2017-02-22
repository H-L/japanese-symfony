<?php
namespace AppBundle\Service;

use AppBundle\Entity\Maid;
use AppBundle\Entity\Timeslot;

/**
 * Class MaidService
 *
 * @package AppBundle\Service
 */
class MaidService
{
    /**
     * Returns the number of work hours the maid has in a week, day by day.
     *
     * @param $maid
     * @return array
     */
    public function howManyWorkHours(Maid $maid)
    {
        $timeslots = $maid->getTimeslots();
        $timeService = new TimeService();
        //initialise work array for a week : 0 is sunday, 6 is saturday
        $workHours = array(
            0 =>0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            'total'=> 0,
        );
        foreach ($timeslots as $slot) {
            $interval = $timeService
                ->getInterval(
                    $slot->getStartHour(),
                    $slot->getStartMinute(),
                    $slot->getEndHour(),
                    $slot->getEndMinute()
                );
            //addition intervals of work for everyday
            $workHours[$slot->getDayOfWeek()] += ($interval[0] * 60 + $interval[1]) / 60;
        }
        $workHours['total'] = array_sum($workHours);
        return $workHours;
    }
    public function getSchedule(Maid $maid) {
        $timeslots = $maid->getTimeslots();
        $byDay = array(
          0 => 0

        );
    }
    /**
     * @param Maid $maid
     * @param Timeslot $timeslot
     * @return bool
     */
    public function doesSlotExists(Maid $maid, Timeslot $timeslot)
    {
        $timeService = new TimeService();
        //start time slot in minutes
        $s1 = $timeslot->getStartHour()* 60 + $timeslot->getStartMinute();
        $interval1 = $timeService
            ->getInterval(
                $timeslot->getStartHour(),
                $timeslot->getStartMinute(),
                $timeslot->getEndHour(),
                $timeslot->getEndMinute()
            );
        $minutesInt1 = ($interval1[0] * 60 + $interval1[1]);
        //end time slot in minutes
        $e1 = $s1 + $minutesInt1;
        //same, but with end as reference
        $eB1 = $timeslot->getEndHour()* 60 + $timeslot->getEndMinute();
        $sB1 = $eB1 - $minutesInt1;

        $timeslots = $maid->getTimeslots();
        foreach ($timeslots as $slot) {
            if ($timeslot->getDayOfWeek() == $slot->getDayOfWeek()) {
                $s2 = $slot->getStartHour()* 60 + $slot->getStartMinute();
                $interval2 = $timeService
                    ->getInterval(
                        $slot->getStartHour(),
                        $slot->getStartMinute(),
                        $slot->getEndHour(),
                        $slot->getEndMinute()
                    );
                $minutesInt2 = ($interval2[0] * 60 + $interval2[1]);
                $e2 = $s2 + $minutesInt2;
                $eB2 = $slot->getEndHour()* 60 + $slot->getEndMinute();
                $sB2 = $eB2 - $minutesInt2;
                if ($e1 > $s2 && $e1 < $e2) {
                    return true;
                }
                if ($sB1 < $eB2 && $sB1 > $sB2) {
                    return true;
                }
                if ((($s1 < $s2 && $eB1 > $eB2) || ($e1 > $e2 && $sB1 < $sB2)) && $minutesInt1 > $minutesInt2) {
                    return true;
                }
            }
        }
        return false;
    }
}
