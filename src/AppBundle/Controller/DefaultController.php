<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Maid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * Finds and displays a maid entity.
     *
     * @Route("/maid/{id}", name="_maid_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $maid = $em->getRepository('AppBundle:Maid')->find($id);

        return $this->render('default/maid/show.html.twig', array(
            'maid' => $maid,
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
     * @Route("/contact", name="_contact")
     */
    public function contactAction() {
        $em = $this->getDoctrine()->getManager();
        $restaurants = $em->getRepository('AppBundle:Restaurant')->findAll();

        return $this->render('default/contact/index.html.twig', array(
            'restaurants' => $restaurants,
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

    /**
     * @Route("/fake/users", name="fake_users")
     */
    public function fakeUsersAction()
    {
        return $this->render('users/index.html.twig', array(

        ));
    }
}
