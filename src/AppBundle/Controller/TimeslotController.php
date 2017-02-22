<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Timeslot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Timeslot controller.
 *
 * @Route("/back-office/timeslot")
 */
class TimeslotController extends Controller
{
    /**
     * Lists all timeslot entities.
     *
     * @Route("/", name="back-office_timeslot_index")
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
     * @Route("/new", name="back-office_timeslot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $timeslot = new Timeslot();
        $em = $this->getDoctrine()->getManager();
        //if ajax request
        if ($request->isXmlHttpRequest()) {
            //get data from the form
            $data = $request->get('appbundle_timeslot');
            //get the maid
            $maid = $em->getRepository('AppBundle:Maid')->find($data['maid']);
            //initialise the response
            $response = JsonResponse::create();

            //Call services in order to proceed to check
            $timeService = $this->get('app.service.time_service');
            $maidService = $this->get('app.service.maid_service');
            //Get number of hours and minutes this timeslot represents
            $interval = $timeService
                ->getInterval($data['startHour'], $data['startMinute'], $data['endHour'], $data['endMinute']);
            //Precedent value of interval
            $intervalCurrentSlot = $timeService
                ->getInterval(
                    $timeslot->getStartHour(),
                    $timeslot->getStartMinute(),
                    $timeslot->getEndHour(),
                    $timeslot->getEndMinute()
                );
            $intervalCurrentSlot = $intervalCurrentSlot[0]*60 + $intervalCurrentSlot[1];
            //Get the total amount of work hours the maid has
            $workHours = $maidService->howManyWorkHours($maid);
            //Add to it the timeslot the user wants to edit, first deduce old value
            $workHours[$data['dayOfWeek']] += ($interval[0]*60 + $interval[1] - $intervalCurrentSlot)/60;

            //if timeslots is inferior to 1 hour, return error
            if ($interval[0] == 0) {
                $response->setStatusCode('400');
                $response->setContent('Maid must work at least one hour');

                return $response;
            }
            //if this timeslots would make the maid work more than 4 hours a day, return error
            if ($workHours[$data['dayOfWeek']] > 4) {
                $response->setStatusCode('400');
                $response->setContent('Maid cannot work more than 4 hours a day');

                return $response;
            }
            $timeslot->setStartHour($data['startHour']);
            $timeslot->setStartMinute($data['startMinute']);
            $timeslot->setEndHour($data['endHour']);
            $timeslot->setEndMinute($data['endMinute']);
            $timeslot->setDayOfWeek($data['dayOfWeek']);
            $timeslot->setMaid($maid);

            //if the maid already work on those hours, return error
            if ($maidService->doesSlotExists($maid, $timeslot) == true) {
                $response->setStatusCode('400');
                $response->setContent('Maid already work on those hours this day');

                return $response;
            }

            $em->persist($timeslot);
            $em->flush($timeslot);
            $timeslots = $em->getRepository('AppBundle:Timeslot')->findBy(array('maid'=>$maid));
        } else {
            $timeslots = $em->getRepository('AppBundle:Timeslot')->findAll();
        }

        return  $this->render('back-office/timeSlot/schedule.html.twig', array(
            'timeslots' => $timeslots,
        ));
    }

    /**
     * Finds and displays a timeslot entity.
     *
     * @Route("/{id}", name="back-office_timeslot_show")
     * @Method("GET")
     */
    public function showAction(Timeslot $timeslot)
    {
        $deleteForm = $this->createDeleteForm($timeslot);

        return $this->render('back-office/timeslot/show.html.twig', array(
            'timeslot' => $timeslot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing timeslot entity.
     *
     * @Route("timeslot/{id}/edit", name="back-office_timeslot_edit")
     * @Method({"POST"})
     * @param Request $request
     * @param Timeslot $timeslot
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function editAction(Request $request, Timeslot $timeslot)
    {
        $em = $this->getDoctrine()->getManager();
        //if ajax request
        if ($request->isXmlHttpRequest()) {
            //get data from the form
            $data = $request->get('appbundle_timeslot');
            //get the maid
            $maid = $em->getRepository('AppBundle:Maid')->find($data['maid']);
            //initialise the response
            $response = JsonResponse::create();

            //Call services in order to proceed to check
            $timeService = $this->get('app.service.time_service');
            $maidService = $this->get('app.service.maid_service');
            //Get number of hours and minutes this timeslot represents
            $interval = $timeService
                ->getInterval($data['startHour'], $data['startMinute'], $data['endHour'], $data['endMinute']);
            //Precedent value of interval
            $intervalCurrentSlot = $timeService
                ->getInterval(
                    $timeslot->getStartHour(),
                    $timeslot->getStartMinute(),
                    $timeslot->getEndHour(),
                    $timeslot->getEndMinute()
                );
            $intervalCurrentSlot = $intervalCurrentSlot[0]*60 + $intervalCurrentSlot[1];
            //Get the total amount of work hours the maid has
            $workHours = $maidService->howManyWorkHours($maid);
            //Add to it the timeslot the user wants to edit, first deduce old value
            $workHours[$data['dayOfWeek']] += ($interval[0]*60 + $interval[1] - $intervalCurrentSlot)/60;

            //if timeslots is inferior to 1 hour, return error
            if ($interval[0] == 0) {
                $response->setStatusCode('400');
                $response->setContent('Maid must work at least one hour');

                return $response;
            }
            //if this timeslots would make the maid work more than 4 hours a day, return error
            if ($workHours[$data['dayOfWeek']] > 4) {
                $response->setStatusCode('400');
                $response->setContent('Maid cannot work more than 4 hours a day');

                return $response;
            }
            $timeslot->setStartHour($data['startHour']);
            $timeslot->setStartMinute($data['startMinute']);
            $timeslot->setEndHour($data['endHour']);
            $timeslot->setEndMinute($data['endMinute']);
            $timeslot->setDayOfWeek($data['dayOfWeek']);
            $timeslot->setMaid($maid);

            //if the maid already work on those hours, return error
            if ($maidService->doesSlotExists($maid, $timeslot) == true) {
                $response->setStatusCode('400');
                $response->setContent('Maid already work on those hours this day');

                return $response;
            }
            $em->persist($timeslot);
            $em->flush($timeslot);
            $timeslots = $em->getRepository('AppBundle:Timeslot')->findBy(array('maid'=>$maid));
        } else {
            $timeslots = $em->getRepository('AppBundle:Timeslot')->findAll();
        }

        return  $this->render('back-office/timeSlot/schedule.html.twig', array(
            'timeslots' => $timeslots,
        ));
    }

    /**
     * Deletes a timeslot entity.
     *
     * @Route("/{id}", name="back-office_timeslot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Timeslot $timeslot)
    {
        $form = $this->createDeleteForm($timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $maid = $timeslot->getMaid();
            $maid->removeTimeslot($timeslot);
            $em->persist($maid);
            $em->remove($timeslot);
            $em->flush($timeslot);
        }

        return $this->redirectToRoute('back-office_maid_show', array('id' => $maid->getId()));
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
            ->setAction($this->generateUrl('back-office_timeslot_delete', array('id' => $timeslot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * create a form to edit an existing timeslot entity.
     *
     * @Route("timeslot/{id}/form/edit", name="back-office_timeslot_form_edit")
     * @Method({"POST"})
     */
    public function formEditAction(Request $request, Timeslot $timeslot)
    {
        $maid = $timeslot->getMaid();
        $deleteForm = $this->createDeleteForm($timeslot);
        $editForm = $this->createForm('AppBundle\Form\TimeslotType', $timeslot);
        $editForm->get('maid')->setData($maid);
        return $this->render('back-office/timeslot/edit.html.twig', array(
            'timeslot_to_edit' => $timeslot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
