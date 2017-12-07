<?php

namespace MyfreelanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller {
    
    private function findProject($id){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("MyfreelanceBundle:Project")->find($id);
        
    }
    public function indexAction($idProject){
        $em = $this->getDoctrine()->getManager();
        
        $project = $this->findProject($idProject);
        
        
        return $this->render("MyfreelanceBundle:project:index.html.twig",array('project'=>$project));
    }
    
   
    
    
}