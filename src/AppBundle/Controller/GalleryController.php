<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gallery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gallery controller.
 *
 * @Route("galleries")
 */
class GalleryController extends Controller
{
    /**
     * Lists all gallery entities.
     *
     * @Route("/", name="galleries_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('AppBundle:Gallery')->findAll();

        return $this->render('default/gallery/index.html.twig', array(
            'galleries' => $galleries,
        ));
    }

    /**
     * Creates a new gallery entity.
     *
     * @Route("/new", name="galleries_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gallery = new Gallery();
        $form = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush($gallery);

            return $this->redirectToRoute('galleries_show', array('id' => $gallery->getId()));
        }

        return $this->render('default/gallery/new.html.twig', array(
            'gallery' => $gallery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gallery entity.
     *
     * @Route("/{id}", name="galleries_show")
     * @Method("GET")
     */
    public function showAction(Gallery $gallery)
    {
        $deleteForm = $this->createDeleteForm($gallery);

        return $this->render('default/gallery/show.html.twig', array(
            'gallery' => $gallery,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gallery entity.
     *
     * @Route("/{id}/edit", name="galleries_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gallery $gallery)
    {
        $deleteForm = $this->createDeleteForm($gallery);
        $editForm = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('galleries_edit', array('id' => $gallery->getId()));
        }

        return $this->render('default/gallery/edit.html.twig', array(
            'gallery' => $gallery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gallery entity.
     *
     * @Route("/{id}", name="galleries_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gallery $gallery)
    {
        $form = $this->createDeleteForm($gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gallery);
            $em->flush($gallery);
        }

        return $this->redirectToRoute('galleries_index');
    }

    /**
     * Creates a form to delete a gallery entity.
     *
     * @param Gallery $gallery The gallery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gallery $gallery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('galleries_delete', array('id' => $gallery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
