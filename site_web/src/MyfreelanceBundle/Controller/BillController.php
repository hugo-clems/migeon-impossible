<?php

namespace MyfreelanceBundle\Controller;

use MyfreelanceBundle\Entity\Bill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bill controller.
 *
 */
class BillController extends Controller
{
    /**
     * Lists all bill entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bills = $em->getRepository('MyfreelanceBundle:Bill')->findAll();

        return $this->render('MyfreelanceBundle:bill:index.html.twig', array(
            'bills' => $bills,
        ));
    }

    /**
     * Creates a new bill entity.
     *
     */
    public function newAction(Request $request)
    {
        $bill = new Bill();
        $form = $this->createForm('MyfreelanceBundle\Form\BillType', $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form = $this->createForm('MyfreelanceBundle\Form\BillType', $bill);
        
            $em = $this->getDoctrine()->getManager();
            foreach($bill->getTicketList() as $ticket){
                $bill->addTicketList($ticket);
            }
            
            $em->flush();
//            dump($bill);die;

            return $this->redirectToRoute('myfreelance_bill_edit', array('id' => $bill->getId()));
        }
        return_view:
        return $this->render('MyfreelanceBundle:bill:new.html.twig', array(
            'bill' => $bill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bill entity.
     *
     */
    public function showAction(Bill $bill)
    {
        //version sans pdf
       $html = $this->render('MyfreelanceBundle:bill:bill.pdf.twig',array('bill'=>$bill));
       
       $filename = sprintf('test-%s.pdf', date('Y-m-d'));
        
       //$pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);
        return $html;
    }

    /**
     * Displays a form to edit an existing bill entity.
     *
     */
    public function editAction(Request $request, Bill $bill)
    {
        $deleteForm = $this->createDeleteForm($bill);
        $editForm = $this->createForm('MyfreelanceBundle\Form\BillEditType', $bill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $bill->becomeNotPay();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('myfreelance_bill_edit', array('id' => $bill->getId()));
        }

        return $this->render('MyfreelanceBundle:bill:edit.html.twig', array(
            'bill' => $bill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bill entity.
     *
     */
    public function deleteAction(Request $request, Bill $bill)
    {
        $form = $this->createDeleteForm($bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bill);
            $em->flush();
        }

        return $this->redirectToRoute('myfreelance_bill_index');
    }

    /**
     * Creates a form to delete a bill entity.
     *
     * @param Bill $bill The bill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bill $bill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('myfreelance_bill_delete', array('id' => $bill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
