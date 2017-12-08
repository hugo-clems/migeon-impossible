<?php
namespace MyfreelanceBundle\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MyfreelanceBundle\Entity\Project;
use MyfreelanceBundle\Entity\Ticket;
use MyfreelanceBundle\Entity\Task;
use MyfreelanceBundle\Form\Customer\TaskCustomerType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller{
   
    public function indexAction(Project $project){
       
        return $this->render('MyfreelanceBundle:customer/project:index.html.twig',array('project'=>$project));
        
    }
    
    public function ticketAction(Project $project,Ticket $ticket,Request $request){
        $em = $this->getDoctrine()->getManager();
        //regarde s'il a acces
        if(!$this->controlAccessTicket($ticket)){
            throw new AccessDeniedHttpException();
        }
        $task = Task::create($ticket);
        $form = $this->createForm(TaskCustomerType::class,$task)->handleRequest($request);
        
        if($form->isValid()){
            $task->getTicket()->setState($em->getRepository('MyfreelanceBundle:State')->findOneByName('retour client'));
            $em->persist($task);
            $em->flush();
            $this->addFlash('success','La tache a bien été crée');
            return $this->redirectToRoute($request->get('_route'),array('ticket'=> $ticket->getId(),'project'=>$project->getId()));
        }
        
        return $this->render("MyfreelanceBundle:ticket:view.html.twig",array('ticket'=>$ticket,'form'=>$form->createView()));
    }
    
    private function controlAccessTicket(Ticket $ticket){
        $project = $ticket->getProject();
        return ($this->getUser()->getProjectList()->contains($project));
    }
}
