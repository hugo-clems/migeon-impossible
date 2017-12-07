<?php

namespace MyfreelanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyfreelanceBundle\Entity\Ticket;
use MyfreelanceBundle\Form\TicketType;
use MyfreelanceBundle\Form\TaskType;
use MyfreelanceBundle\Entity\Task;

class TicketController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ticketList = $em->getRepository("MyfreelanceBundle:Ticket")->findByUser($this->getUser());
        return $this->render('MyfreelanceBundle:ticket:index.html.twig',array('ticketList'=>$ticketList));
    }
    
    public function editAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if($request->query->has('idProject')){
            $idProject= $request->query->get('idProject');
             $project = $em->getRepository("MyfreelanceBundle:Project")->find($idProject);
             $ticket = Ticket::createWithProject($project);
        }else{
            $ticket = new Ticket();
        }
        
        $form = $this->createForm(TicketType::class, $ticket)->handleRequest($request);
        
        if($form->isValid()){
            $em->persist($ticket);
            $em->flush();
            $this->addFlash("success", "Le ticket n° {$ticket->getId()} a bien été ajouté:modifié");
            
            if($request->query->has('idProject')){
                return $this->redirectToRoute("myfreelance_project_index",array('idProject'=>$idProject));
            }
            return $this->redirectToRoute("myfreelance_ticket_index");
            
            
        }
        
        
        return $this->render("MyfreelanceBundle:ticket:edit.html.twig",array('form'=>$form->createView()));
        
        
        
    }
    
    public function viewAction(Request $request, $idTicket){
        $em = $this->getDoctrine()->getManager();
        
        $ticket = $em->getRepository("MyfreelanceBundle:Ticket")->find($idTicket);
        
        $task = Task::create($ticket);
        $form = $this->createForm(TaskType::class,$task)->handleRequest($request);
        
        if($form->isValid()){
            $em->persist($task);
            $em->flush();
            $this->addFlash('success','La tache a bien été crée');
            return $this->redirectToRoute($request->get('_route'),array('idTicket'=>$idTicket));
        }
        
        return $this->render("MyfreelanceBundle:ticket:view.html.twig",array('ticket'=>$ticket,'form'=>$form->createView()));
    }
}
