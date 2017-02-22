<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ImageType;

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
        $characterTraits = $em->getRepository('AppBundle:CharacterTrait')->findAll();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

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
}
