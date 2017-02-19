<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Timeslot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Timeslot controller.
 *
 * @Route("timeslot")
 */
class TimeslotController extends Controller
{
    /**
     * Lists all timeslot entities.
     *
     * @Route("/", name="timeslot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $timeslots = $em->getRepository('AppBundle:Timeslot')->findAll();

        return $this->render('back-office/timeSlot/schedule.html.twig', array(
            'timeslots' => $timeslots,
        ));
    }

    /**
     * Creates a new timeslot entity.
     *
     * @Route("/new", name="timeslot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $timeslot = new Timeslot();
        $form = $this->createForm('AppBundle\Form\TimeslotType', $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $timeslot->setStartTime();
            $timeslot->setEndTime();
            $em->persist($timeslot);
            $em->flush($timeslot);

            return $this->redirectToRoute('timeslot_show', array('id' => $timeslot->getId()));
        }

        return $this->render('timeslot/new.html.twig', array(
            'timeslot' => $timeslot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a timeslot entity.
     *
     * @Route("/{id}", name="timeslot_show")
     * @Method("GET")
     */
    public function showAction(Timeslot $timeslot)
    {
        $deleteForm = $this->createDeleteForm($timeslot);

        return $this->render('timeslot/show.html.twig', array(
            'timeslot' => $timeslot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing timeslot entity.
     *
     * @Route("timeslot/{id}/edit", name="timeslot_edit")
     * @Method({"POST"})
     */
    public function editAction(Request $request, Timeslot $timeslot)
    {
        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXmlHttpRequest()) {
                $data = $request->get('appbundle_timeslot');
                $timeslot->setStartHour($data['startHour']);
                $timeslot->setStartMinute($data['startMinute']);
                $timeslot->setEndHour($data['endHour']);
                $timeslot->setEndMinute($data['endMinute']);
                $timeslot->setDayOfWeek($data['dayOfWeek']);
                if($data['restaurant'] != 1) {
                    $timeslot->setRestaurant($data['restaurant']);
                }
                if($data['maid'] != 1) {
                    $timeslot->setMaid($em->getRepository('AppBundle:Maid')->find($data['maid']));
                }
                $em->persist($timeslot);
                $em->flush($timeslot);
            }
            $timeslots = $em->getRepository('AppBundle:Timeslot')->findAll();

            return  $this->render('back-office/timeSlot/schedule.html.twig', array(
                'timeslots' => $timeslots,
            ));
        } else {

            return $this->indexAction();
        }

    }

    /**
     * Deletes a timeslot entity.
     *
     * @Route("/{id}", name="timeslot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Timeslot $timeslot)
    {
        $form = $this->createDeleteForm($timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeslot);
            $em->flush($timeslot);
        }

        return $this->redirectToRoute('timeslot_index');
    }

    /**
     * Creates a form to delete a timeslot entity.
     *
     * @param Timeslot $timeslot The timeslot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Timeslot $timeslot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('timeslot_delete', array('id' => $timeslot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * create a form to edit an existing timeslot entity.
     *
     * @Route("timeslot/{id}/form/edit", name="timeslot_form_edit")
     * @Method({"POST"})
     */
    public function formEditAction(Request $request, Timeslot $timeslot)
    {
        $deleteForm = $this->createDeleteForm($timeslot);
        $editForm = $this->createForm('AppBundle\Form\TimeslotType', $timeslot);
        return $this->render('back-office/timeslot/edit.html.twig', array(
            'timeslot_to_edit' => $timeslot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
