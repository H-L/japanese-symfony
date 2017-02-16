<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("/employees")
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities that are maids
     *
     * @Route("/maids", name="_maid_index")
     * @Method("GET")
     */
    public function indexMaidAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Employee')->createQueryBuilder('p');
        $query
            ->add('where', $query->expr()->isNotNull('p.maidName'))
            ->orderBy('p.id', 'ASC');
        $employees = $query->getQuery()->getResult();

        return $this->render('employee/maid/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new maid employee entity.
     *
     * @Route("/maids/new", name="_maid_new")
     * @Method({"GET", "POST"})
     */
    public function newMaidAction(Request $request)
    {
        $employee = new Employee();
        $options = array(
            'maid'=> true,
        );
        $form = $this->createForm('AppBundle\Form\EmployeeType', $employee, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $employee->getId()));
        }

        return $this->render('employee/maid/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/maids/{id}", name="_maid_show")
     * @Method("GET")
     */
    public function showMaidAction(Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('employee/maid/show.html.twig', array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("maids/{id}/edit", name="_maid_edit")
     * @Method({"GET", "POST"})
     */
    public function editMaidAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $options = array(
            'maid'=> true,
        );
        $editForm = $this->createForm('AppBundle\Form\EmployeeType', $employee, $options);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('_edit', array('id' => $employee->getId()));
        }

        return $this->render('employee/maid/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Lists all employee entities
     *
     * @Route("/", name="_index")
     * @Method("GET") 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Employee')->createQueryBuilder('p');
        $query
            ->add('where', $query->expr()->isNull('p.maidName'))
            ->orderBy('p.id', 'ASC');
        $employees = $query->getQuery()->getResult();

        return $this->render('employee/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $options = array(
            'maid'=> false,
        );
        $form = $this->createForm('AppBundle\Form\EmployeeType', $employee, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $employee->getId()));
        }

        return $this->render('employee/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/{id}", name="_show")
     * @Method("GET")
     */
    public function showAction(Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('employee/show.html.twig', array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $options = array(
            'maid'=> false,
        );
        $editForm = $this->createForm('AppBundle\Form\EmployeeType', $employee, $options);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('_edit', array('id' => $employee->getId()));
        }

        return $this->render('employee/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush($employee);
        }

        return $this->redirectToRoute('_index');
    }


    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employee $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}