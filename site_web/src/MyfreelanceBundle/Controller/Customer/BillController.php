<?php
namespace MyfreelanceBundle\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MyfreelanceBundle\Entity\Project;
use MyfreelanceBundle\Entity\Ticket;
use MyfreelanceBundle\Entity\Task;
use MyfreelanceBundle\Form\Customer\TaskCustomerType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Symfony\Component\HttpFoundation\Request;

class BillController extends Controller{
   
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        
        $billList = $em->getRepository("MyfreelanceBundle:Bill")->findByCustomer($this->getUser());
        return $this->render('MyfreelanceBundle:customer/bill:index.html.twig',array('billList'=>$billList));
        
    }
   
}
