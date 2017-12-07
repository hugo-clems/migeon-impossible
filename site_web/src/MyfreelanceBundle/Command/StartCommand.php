<?php

namespace MyfreelanceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use MyfreelanceBundle\Entity\State;
use MyfreelanceBundle\Entity\Type;

class StartCommand extends ContainerAwareCommand{
    protected function configure() {
        $this
                ->setName('app:start')
                ->setDescription('add state and type')
                ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $stateArray = ['nouveau','en cours','attente retour client','retour client','fini'];
        
        $typeArray = ['bug','evolution','a qualifier'];
        
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        foreach ($stateArray as $stateLabel){
            $state = new State();
            $state->setName($stateLabel);
            $em->persist($state);
        }
        
        foreach ($typeArray as $typeLabel){
            $type = new Type();
            $type->setName($typeLabel);
            $em->persist($type);
        }
        
        $em->flush();
        
        return true;
        
    }
}
