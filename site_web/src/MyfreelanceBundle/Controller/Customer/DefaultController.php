<?php

namespace MyfreelanceBundle\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use MyfreelanceBundle\Entity\Customer;
use MyfreelanceBundle\Entity\Ticket;
use MyfreelanceBundle\Form\Customer\TicketCustomerType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        //il customer
        return $this->render('MyfreelanceBundle:customer:index.html.twig',array('projectList'=>$user->getProjectList()));
    }
    
    public function editTicketAction(Ticket $ticket = null,Request $request){
        $em = $this->getDoctrine()->getManager();
        
        if(!($ticket instanceof Ticket)){
            $ticket = new Ticket();
        }
        
        $form = $this->createForm(TicketCustomerType::class, $ticket,array('user'=>$this->getUser(),'em'=>$em))->handleRequest($request);
        
        if($form->isValid()){
            $em->persist($ticket);
            $em->flush();
            $this->addFlash('success', "Le ticket a été bien ajouté");
            return $this->redirectToRoute('myfreelance_customer_index');
        }
        
        return $this->render("MyfreelanceBundle:customer:edit_ticket.html.twig",array('form'=>$form->createView()));
    }
       
       
}
