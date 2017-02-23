<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CharacterTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Charactertrait controller.
 *
 * @Route("back-office/charactertrait")
 */
class CharacterTraitController extends Controller
{
    /**
     * Lists all characterTrait entities.
     *
     * @Route("/", name="back-office_charactertrait_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $characterTraits = $em->getRepository('AppBundle:CharacterTrait')->findAll();

        return $this->render('back-office/charactertrait/index.html.twig', array(
            'characterTraits' => $characterTraits,
        ));
    }

    /**
     * Creates a new characterTrait entity.
     *
     * @Route("/new", name="back-office_charactertrait_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $characterTrait = new Charactertrait();
        $form = $this->createForm('AppBundle\Form\CharacterTraitType', $characterTrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($characterTrait);
            $em->flush($characterTrait);

            return $this->redirectToRoute('back-office_charactertrait_show', array('id' => $characterTrait->getId()));
        }

        return $this->render('back-office/charactertrait/new.html.twig', array(
            'characterTrait' => $characterTrait,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a characterTrait entity.
     *
     * @Route("/{id}", name="back-office_charactertrait_show")
     * @Method("GET")
     */
    public function showAction(CharacterTrait $characterTrait)
    {
        $deleteForm = $this->createDeleteForm($characterTrait);

        return $this->render('back-office/charactertrait/show.html.twig', array(
            'characterTrait' => $characterTrait,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing characterTrait entity.
     *
     * @Route("/{id}/edit", name="back-office_charactertrait_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CharacterTrait $characterTrait)
    {
        $deleteForm = $this->createDeleteForm($characterTrait);
        $editForm = $this->createForm('AppBundle\Form\CharacterTraitType', $characterTrait);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back-office_charactertrait_edit', array('id' => $characterTrait->getId()));
        }

        return $this->render('back-office/charactertrait/edit.html.twig', array(
            'characterTrait' => $characterTrait,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a characterTrait entity.
     *
     * @Route("/{id}", name="back-office_charactertrait_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CharacterTrait $characterTrait)
    {
        $form = $this->createDeleteForm($characterTrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($characterTrait);
            $em->flush($characterTrait);
        }

        return $this->redirectToRoute('back-office_charactertrait_index');
    }

    /**
     * Creates a form to delete a characterTrait entity.
     *
     * @param CharacterTrait $characterTrait The characterTrait entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CharacterTrait $characterTrait)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back-office_charactertrait_delete', array('id' => $characterTrait->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
