<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use MyfreelanceBundle\Form\TicketType;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('ticket', TicketStateType::class)
                ->add('date', DateType::class,array(
                    'widget' => "single_text",
                    'format' => 'dd/MM/yyyy HH:mm'
                ))
                ->add('nbHour', TimeType::class,array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    'attr'=>['placeholder'=>'hh:mm']
                ))
                ->add('description')
                ;
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Task'
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


class TicketStateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('state', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class,array(
                    'class'=>"MyfreelanceBundle:State",
                    'choice_label'=>'name')
                )
                ->add('percentage')
        ;
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
        return 'myfreelancebundle_ticket';
    }


}
