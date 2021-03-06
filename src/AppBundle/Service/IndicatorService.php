<?php

namespace AppBundle\Service;

use AppBundle\Entity\Maid;
use AppBundle\Entity\Timeslot;
use Symfony\Component\VarDumper\VarDumper;

class IndicatorService
{
    public function getBestRestaurant($restaurants)
    {
        $score = array();
        foreach ($restaurants as $restaurant) {
            $score[$restaurant->getId()] = 0;
        }
        foreach ($restaurants as $restaurant) {
            foreach ($restaurant->getReviews() as $review) {
                if($review->getRate() > 3) {
                    $score[$restaurant->getId()] = $score[$restaurant->getId()] + 1;
                }
            }
        }
        foreach ($restaurants as $restaurant) {
            if($restaurant->getId() == array_search(max($score),$score)) {
                return [$restaurant, max($score)];
            }
        }
    }
}