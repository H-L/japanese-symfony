<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/galleries", name="galleries")
     */
    public function testingImageGalleriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('AppBundle:Gallery')->find(1);
        $images = $gallery->getImages()->toArray();

        // replace this example code with whatever you need
        return $this->render('galleries/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'images' => $images,
            'gallery' => $gallery,
        ));
    }
}
