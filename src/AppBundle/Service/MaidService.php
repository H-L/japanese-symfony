<?php
namespace AppBundle\Service;

use AppBundle\Entity\Maid;
use AppBundle\Service\TimeService;

/**
 * Class MaidService
 *
 * @package AppBundle\Service
 */
class MaidService
{
    /**
     * @param $maid
     * @return array
     */
    public function howManyWorkHours(Maid $maid)
    {
        $timeslots = $maid->getTimeslots();
        $timeService = new TimeService();
        $workHours = array(
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
            $workHours[$slot->getDayOfWeek()] += ($interval[0] * 60 + $interval[1]) / 60;
        }
        $workHours['total'] = array_sum($workHours);
        return $workHours;
    }
}
