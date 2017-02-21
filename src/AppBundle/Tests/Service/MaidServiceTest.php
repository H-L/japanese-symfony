<?php
namespace AppBundle\Tests\Service;

use AppBundle\Service\MaidService;
use PHPUnit\Framework\TestCase;

/**
 * Class MaidServiceTest
 * @package AppBundle\Tests\Service
 */
class MaidServiceTest extends TestCase
{
    
    public function testHowManyWorkHours()
    {
        $service = new MaidService();
        $this->assertEquals(array(
            0 => null,
            1 => 75,
            2 => null,
            3 => null,
            4 => null,
            5 => null,
            6 => null,
        ), $service->howManyWorkHours());
    }
    
}