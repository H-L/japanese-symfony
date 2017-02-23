<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\Maid;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Response;

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
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('default/index.html.twig', array(
            'maids' => $maids,
            'restaurants' => $restaurant,
            'events' => $events,
            'reviews' => $reviews,
        ));
    }

    /**
     * @Route("/maid", name="_maid")
     */
    public function maidAction()
    {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $characterTraits = $em->getRepository('AppBundle:CharacterTrait')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();
        

        return $this->render('default/maid/maid.html.twig', array(
            'maids' => $maids,
            'reviews' => $reviews,
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
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('default/maid/show.html.twig', array(
            'maids' => $maids,
            'maid' => $maid,
            'reviews' => $reviews,
        ));
    }

    /**
     * @Route("/event", name="_event")
     */
    public function eventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('default/event/event.html.twig', array(
            'events' => $events,
            'reviews' => $reviews,
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/event/{id}", name="event_show")
     * @Method("GET")
     */
    public function eventShowAction(Event $event)
    {

        return $this->render('default/event/show.html.twig', array(
            'event' => $event,
        ));
    }

//    /**
//     * @Route("/galleries", name="galleries")
//     */
//    public function testingImageGalleriesAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $gallery = $em->getRepository('AppBundle:Gallery')->find(1);
//        $images = $gallery->getImages()->toArray();
//
//        return $this->render('galleries/index.html.twig', array(
//            'images' => $images,
//            'gallery' => $gallery,
//        ));
//    }

    /**
     * @Route("/back-office", name="back-office_index")
     */
    public function backOfficeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $restaurant = $em->getRepository('AppBundle:Restaurant')->findAll();
        $events = $em->getRepository('AppBundle:Event')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('back-office/index.html.twig', array(
            'maids' => $maids,
            'restaurants' => $restaurant,
            'events' => $events,
            'reviews' => $reviews,
        ));
    }
    /**
     * @Route("/contact", name="_contact")
     */
    public function contactAction()
    {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $restaurants = $em->getRepository('AppBundle:Restaurant')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('default/contact/index.html.twig', array(
            'restaurants' => $restaurants,
            'reviews' => $reviews,
            'maids' => $maids,
        ));
    }

    /**
     * @Route("/services", name="_services")
     */
    public function serviceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $maids = $em->getRepository('AppBundle:Maid')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('default/services/services.html.twig', array(
            'maids' => $maids,
            'reviews' => $reviews,
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
