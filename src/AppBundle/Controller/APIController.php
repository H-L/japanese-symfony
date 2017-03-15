<?php
namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Maid;
use AppBundle\Entity\Restaurant;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;

class APIController extends FOSRestController
{
    /**
     * @ApiDoc(
     * resource="/api/maids",
     * description="Gets all maids",
     * )
     * @Route("/api/maids")
     * @Method("GET")
     */
    public function getAllMaidAction()
    {
        $serializer = $this->get('jms_serializer');
        $maids = $this->getDoctrine()->getRepository('AppBundle:Maid')->findAll();
        $response = JsonResponse::create();
        if (count($maids) === 0) {
            return 'there are no maids';
        }
        $maids = $serializer->serialize($maids, 'json');
        $response->setContent($maids);

        return $response;
    }

    /**
     * @ApiDoc(
     * resource="/api/maid/{id}",
     * description="Get one maid by her id"
     * )
     * input={
     *   "class"="AppBundle\Entity\Maid",
     * },
     * @Route("/api/maid/{id}")
     * @Method("GET")
     * @param $maid
     */
    public function getMaid(Maid $maid)
    {
        $serializer = $this->get('jms_serializer');
        $response = JsonResponse::create();
        $response->setContent($serializer->serialize($maid, 'json'));

        return $response;
    }

    /**
     * @ApiDoc(
     * resource="/api/maid/{id}/schedule",
     * description="Get the weekly schedule of one maid",
     * input={
     *   "class"="AppBundle\Entity\Maid",
     * })
     * @Route("/api/maid/{id}/schedule")
     * @Method("GET")
     * @param $maid
     */
    public function getMaidSchedule(Maid $maid)
    {
        $serializer = $this->get('jms_serializer');
        $response = JsonResponse::create();
        $service = $this->get('app.service.maid_service');

        $schedule = $service->getSchedule($maid);
        $schedule = $serializer->serialize($schedule, 'json');
        $response->setContent($schedule);

        return$response;
    }

    /**
     * @ApiDoc(
     * resource="/api/restaurants",
     * description="Get all restaurants",
     * )
     * @Route("/api/restaurants")
     * @Method("GET")
     */
    public function getAllRestaurantsAction()
    {
        $serializer = $this->get('jms_serializer');
        $restaurants = $this->getDoctrine()->getRepository('AppBundle:Restaurant')->findAll();
        $response = JsonResponse::create();
        if (count($restaurants) === 0) {
            return new View("there are no restaurant", Response::HTTP_NOT_FOUND);
        }
        $restaurants = $serializer->serialize($restaurants, 'json');
        $response->setContent($restaurants);

        return $response;
    }

    /**
     * @ApiDoc(
     * resource="/api/restaurant/{id}",
     * description="Get one restaurant by its id",
     * input={
     *   "class"="AppBundle\Entity\Restaurant",
     * },)
     * @Route("/api/restaurant/{id}")
     * @Method("GET")
     * @param $restaurant
     */
    public function getRestaurant(Restaurant $restaurant)
    {
        $serializer = $this->get('jms_serializer');
        $response = JsonResponse::create();
        $response->setContent($serializer->serialize($restaurant, 'json'));

        return $response;
    }

    /**
     * @ApiDoc(
     * resource="/api/restaurant/{id}",
     * description="Get all maids of one restaurant",
     * input={
     *   "class"="AppBundle\Entity\Restaurant",
     * },)
     * @Route("/api/restaurant/{id}/maids")
     * @Method("GET")
     * @param $restaurant
     */
    public function getMaidByRestaurant(Restaurant $restaurant)
    {
        $serializer = $this->get('jms_serializer');
        $response = JsonResponse::create();
        $maids = $restaurant->getMaids();

        $response->setContent($serializer->serialize($maids, 'json'));

        return $response;
    }
}