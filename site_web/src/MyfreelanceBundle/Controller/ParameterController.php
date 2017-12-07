<?php

namespace MyfreelanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyfreelanceBundle\Entity\Customer;
use MyfreelanceBundle\Form\CustomerType;
use MyfreelanceBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\Request;
use MyfreelanceBundle\Entity\Project;

class ParameterController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $customerList = $em->getRepository("MyfreelanceBundle:Customer")->findByProvider($this->getUser()->getId()); 
        
        return $this->render('MyfreelanceBundle:parameter:index.html.twig',array('customerList'=>$customerList));
    }
    
    public function editCustomerAction(Request $request){
         $em = $this->getDoctrine()->getManager();
         
         if($request->query->has('idCustomer')){
             $customerId = $request->query->get('idCustomer');
             $customer = $em->getRepository("MyfreelanceBundle:Customer")->find($customerId);
         }else{
            $customer = new Customer($this->getUser());
            
         }
         $form = $this->createForm(CustomerType::class,$customer)
                 ->handleRequest($request);
         
         if($form->isValid()){
             $em->persist($customer);
             $em->flush();
             $this->addFlash('success',"Le client {$customer->getName()} a été faite");
             
             return $this->redirectToRoute("myfreelance_parameter_customer_index");
         }
         
         return $this->render('MyfreelanceBundle:parameter:edit_customer.html.twig',array('form'=>$form->createView()));
    }
    
    public function editProjectAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        if($request->query->has('idCustomer')){
            $idCustomer = $request->query->get('idCustomer');
            $customer = $em->getRepository("MyfreelanceBundle:Customer")->find($idCustomer);
            $project = Project::newProject($customer);
        }elseif($request->query->has('idProject')){
            $projectId = $request->query->get('idProject');
            $project =$em->getRepository("MyfreelanceBundle:Project")->find($projectId);
            $customer = $project->getCustomer();
            
        }else{
         throw new \Symfony\Component\Config\Definition\Exception\Exception("no definitive project");  
        }
        
        $form = $this->createForm(ProjectType::class,$project)->handleRequest($request);
        
        if($form->isValid()){
             $em->persist($project);
             $em->flush();
             $this->addFlash('success',"Le Projet {$customer->getName()} a été faite");
             
             return $this->redirectToRoute("myfreelance_parameter_customer_index");
         }
        return $this->render("MyfreelanceBundle:parameter:edit_project.html.twig",array('form'=>$form->createView()));
    }
    
     public function deleteProjectAction(Project $project){
        if($project->getNumberTicket() > 0)
            throw new \Exception("Can't delete project");
        
        $em = $this->getDoctrine()->getManager();
        dump($this);die;
        $em->remove($project);
        
        $this->redirectToRoute("coucou");
        
    }
}

