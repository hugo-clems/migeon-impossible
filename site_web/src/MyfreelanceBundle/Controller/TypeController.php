<?php

namespace MyfreelanceBundle\Controller;

use MyfreelanceBundle\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Type controller.
 *
 */
class TypeController extends Controller
{
    /**
     * Lists all type entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('MyfreelanceBundle:Type')->findAll();

        return $this->render('MyfreelanceBundle:type:index.html.twig', array(
            'types' => $types,
        ));
    }

    /**
     * Creates a new type entity.
     *
     */
    public function newAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm('MyfreelanceBundle\Form\TypeType', $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            $this->addFlash('success',"L'etat a bien été ajouté");
            return $this->redirectToRoute('myfreelance_type_index');
        }

        return $this->render('MyfreelanceBundle:type:new.html.twig', array(
            'type' => $type,
            'form' => $form->createView(),
        ));
    }

    

    /**
     * Displays a form to edit an existing type entity.
     *
     */
    public function editAction(Request $request, Type $type)
    {
        $deleteForm = $this->createDeleteForm($type);
        $editForm = $this->createForm('MyfreelanceBundle\Form\TypeType', $type);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('myfreelance_type_edit', array('id' => $type->getId()));
        }

        return $this->render('MyfreelanceBundle:type:edit.html.twig', array(
            'type' => $type,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a type entity.
     *
     */
    
    public function deleteAction(Request $request, Type $type)
    {
        
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        

        return $this->redirectToRoute('myfreelance_type_index');
    }
    
//    public function deleteAction(Request $request, Type $type)
//    {
//        $form = $this->createDeleteForm($type);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($type);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('myfreelance_type_index');
//    }
    
    

    /**
     * Creates a form to delete a type entity.
     *
     * @param Type $type The type entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type $type)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('myfreelance_type_delete', array('id' => $type->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
