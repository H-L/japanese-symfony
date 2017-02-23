<?php
namespace AppBundle\Tests\Service;

use AppBundle\Service\TimeService;
use PHPUnit\Framework\TestCase;

/**
 * Class TimeServiceTest
 * @package AppBundle\Tests\Service
 */
class TimeServiceTest extends TestCase
{
    /**
     * @dataProvider intervalData
     * @param $startHour
     * @param $startMinute
     * @param $endHour
     * @param $endMinute
     * @param $expected
     */
    public function testGetInterval($startHour, $startMinute, $endHour, $endMinute, $expected)
    {
        $service = new TimeService();
        $this->assertEquals($expected, $service->getInterval($startHour, $startMinute, $endHour, $endMinute));
    }

    /**
     * @return array
     */
    public function intervalData()
    {
        return [
            [23, 15, 0, 15, [1, 0]],
            [23, 15, 23, 30, [0, 15]],
            [23, 30, 0, 15, [0, 45]],
            [23, 15, 0, 30, [1, 15]],
            [23, 59, 0, 58, [0, 59]],
            [23, 59, 1, 1, [1, 2]],
            [8, 10, 12, 1, [3, 51]],
        ];
    }
}
