<?php

namespace MyfreelanceBundle\Form\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use MyfreelanceBundle\Form\Customer\TicketCustomerType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TaskCustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('date', DateType::class,array(
                    'widget' => "single_text",
                    'format' => 'dd/MM/yyyy HH:mm',
                    'disabled'=>'disabled'
                ))
                ->add('description')
                ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event){
                    $task = $event->getData();
                    $temp = new \DateTime();
                    $task->setNbHour($temp->setTimestamp(0));
                    
                    
                })
                ;
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Task',
            'em'=>'Doctrine\ORM\EntityManager'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfreelancebundle_task';
    }


}
