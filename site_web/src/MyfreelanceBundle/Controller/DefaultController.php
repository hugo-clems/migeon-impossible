<?php

namespace MyfreelanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyfreelanceBundle\Entity\Customer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        //il customer
        if($this->getUser() instanceof Customer){
            return $this->redirectToRoute('myfreelance_customer_index');
        }
        
        return $this->render('MyfreelanceBundle::index.html.twig');
    }
}
