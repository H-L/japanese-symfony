<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="_home")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $restaurant = $em->getRepository('AppBundle:Restaurant')->findAll();
        $events = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render('default/index.html.twig', array(
            'maids' => $maids,
            'restaurants' => $restaurant,
            'events' => $events,
        ));
    }

    /**
     * @Route("/maid", name="_maid")
     */
    public function maidAction() {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();

        return $this->render('default/maid/maid.html.twig', array(
            'maids' => $maids,
        ));
    }

    /**
     * @Route("/event", name="_event")
     */
    public function eventAction() {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render('default/event/event.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * @Route("/services", name="_services")
     */
    public function serviceAction()
    {
        return $this->render('default/services/services.html.twig', array(

        ));
    }
}
