<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
class SecurityController  extends BaseController{
    
    
    protected function renderLogin(array $data)
    {
        return $this->render('UserBundle:Security:login.html.twig', $data);
    }
    
    public function checkAction() {
        parent::checkAction();
    }
}

