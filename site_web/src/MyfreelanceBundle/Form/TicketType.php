<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('project', EntityType::class,array(
                    'class'=>"MyfreelanceBundle:Project",
                    'choice_label'=>"name",
                    'required'=>false
                    
                ))
                ->add('type', EntityType::class,array(
                    'class'=>'MyfreelanceBundle:Type',
                    'choice_label'=>'name'
                    
                ))
                ->add('state', EntityType::class,array(
                    'class'=>"MyfreelanceBundle:State",
                    'choice_label'=>'name'
                ))
                ->add('title')
                ->add('startDate', DateType::class,array(
                    'widget'=>'single_text',
                    'format'=>'dd/MM/yyyy',
                    'attr'=>['placeholder'=>'dd/mm/yyyyy'],
                    
                ))
                ->add('description')
                
                ;
               
        $builder
                ->addEventListener(FormEvents::PRE_SET_DATA,function(FormEvent $event){
                   $ticket = $event->getData();
                    if($ticket->getStartDate() == null){
                       $ticket->setStartDate(new \DateTime('NOW'));
                   }
                });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfreelance_ticketbundle_ticket';
    }


}
