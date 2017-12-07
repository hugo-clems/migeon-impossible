<?php

namespace MyfreelanceBundle\Twig;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Twig_Extension;
use MyfreelanceBundle\Entity\State;
/**
 * Description of TwigFilter
 *
 * @author alexa
 */
class TwigExtension extends Twig_Extension {
    
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('time',array($this,'timeFilter')),
            new \Twig_SimpleFilter('price',array($this,'priceFilter')),
            new \Twig_SimpleFilter('state',array($this,'stateFilter'))
        );
    }
    
    
    public function timeFilter($arg1,$arg2 = ":"){
        $nbHour = 0;
        $nbHour += ($arg1->format('h') > 0)?$arg1->format('h'):0;
        $nbHour += ($arg1->format('d') > 1)?($arg1->format('d')-1)*24:0;
        $nbHour += ($arg1->format('m') > 1)? ($arg1->format('m')-1)*24*31:0;
        
        return $nbHour.$arg2.$arg1->format('i');
    }
    
    public function priceFilter($number, $decimals = 2, $decPoint = '.', $thousandsSep = ' ')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price =  $price. "€";

        return $price;
    }
    
    public function stateFilter(State $state){
       return $state->getname();
        
    }
        
        
        
    
    
}
