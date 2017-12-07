<?php

namespace MyfreelanceBundle\Controller;

use MyfreelanceBundle\Entity\State;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * State controller.
 *
 */
class StateController extends Controller
{
    /**
     * Lists all state entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $states = $em->getRepository('MyfreelanceBundle:State')->findAll();

        return $this->render('MyfreelanceBundle:state:index.html.twig', array(
            'states' => $states,
        ));
    }

    /**
     * Creates a new state entity.
     *
     */
    public function newAction(Request $request)
    {
        $state = new State();
        $form = $this->createForm('MyfreelanceBundle\Form\StateType', $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($state);
            $em->flush();

            $this->addFlash('success',"L'etat a bien été ajouté");
            return $this->redirectToRoute('myfreelance_state_index');
        }

        return $this->render('MyfreelanceBundle:state:new.html.twig', array(
            'state' => $state,
            'form' => $form->createView(),
        ));
    }

    

    /**
     * Displays a form to edit an existing state entity.
     *
     */
    public function editAction(Request $request, State $state)
    {
        $deleteForm = $this->createDeleteForm($state);
        $editForm = $this->createForm('MyfreelanceBundle\Form\StateType', $state);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('myfreelance_state_edit', array('id' => $state->getId()));
        }

        return $this->render('MyfreelanceBundle:state:edit.html.twig', array(
            'state' => $state,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a state entity.
     *
     */
    
    public function deleteAction(Request $request, State $state)
    {
        
            $em = $this->getDoctrine()->getManager();
            $em->remove($state);
            $em->flush();
        

        return $this->redirectToRoute('myfreelance_state_index');
    }
    
//    public function deleteAction(Request $request, State $state)
//    {
//        $form = $this->createDeleteForm($state);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($state);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('myfreelance_state_index');
//    }
    
    

    /**
     * Creates a form to delete a state entity.
     *
     * @param State $state The state entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(State $state)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('myfreelance_state_delete', array('id' => $state->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
