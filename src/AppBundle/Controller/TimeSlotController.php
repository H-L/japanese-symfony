<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TimeSlot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Timeslot controller.
 *
 * @Route("timeslot")
 */
class TimeSlotController extends Controller
{
    /**
     * Lists all timeSlot entities.
     *
     * @Route("/", name="timeslot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $timeSlots = $em->getRepository('AppBundle:TimeSlot')->findAll();

        return $this->render('timeslot/index.html.twig', array(
            'timeSlots' => $timeSlots,
        ));
    }

    /**
     * Creates a new timeSlot entity.
     *
     * @Route("/new", name="timeslot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $timeSlot = new Timeslot();
        $form = $this->createForm('AppBundle\Form\TimeSlotType', $timeSlot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $timeSlot->setStartTime();
            $timeSlot->setEndTime();
            $em->persist($timeSlot);
            $em->flush($timeSlot);

            return $this->redirectToRoute('timeslot_show', array('id' => $timeSlot->getId()));
        }

        return $this->render('timeslot/new.html.twig', array(
            'timeSlot' => $timeSlot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a timeSlot entity.
     *
     * @Route("/{id}", name="timeslot_show")
     * @Method("GET")
     */
    public function showAction(TimeSlot $timeSlot)
    {
        $deleteForm = $this->createDeleteForm($timeSlot);

        return $this->render('timeslot/show.html.twig', array(
            'timeSlot' => $timeSlot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing timeSlot entity.
     *
     * @Route("/{id}/edit", name="timeslot_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TimeSlot $timeSlot)
    {
        $deleteForm = $this->createDeleteForm($timeSlot);
        $editForm = $this->createForm('AppBundle\Form\TimeSlotType', $timeSlot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timeslot_edit', array('id' => $timeSlot->getId()));
        }

        return $this->render('timeslot/edit.html.twig', array(
            'timeSlot' => $timeSlot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a timeSlot entity.
     *
     * @Route("/{id}", name="timeslot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TimeSlot $timeSlot)
    {
        $form = $this->createDeleteForm($timeSlot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeSlot);
            $em->flush($timeSlot);
        }

        return $this->redirectToRoute('timeslot_index');
    }

    /**
     * Creates a form to delete a timeSlot entity.
     *
     * @param TimeSlot $timeSlot The timeSlot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TimeSlot $timeSlot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('timeslot_delete', array('id' => $timeSlot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
