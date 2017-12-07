<?php

namespace MyfreelanceBundle\Form\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class TicketCustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $em = $options['em'];
        $builder
                ->add('project', EntityType::class,array(
                    'class'=>"MyfreelanceBundle:Project",
                    'choice_label'=>"name",
                    'required'=>false,
                    'query_builder' => function (EntityRepository $er) use ($user){
                        $qb = $er->createQueryBuilder('project');
                        return $er->createQueryBuilder('project')->leftJoin('project.customer','c')
                               ->where($qb->expr()->like('c.id',"?1"))
                               ->setParameter(1,$user)
                               ;
                    }
                    
                ))
               
                ->add('title')
                ->add('startDate', DateType::class,array(
                    'widget'=>'single_text',
                    'format'=>'dd/MM/yyyy',
                    'attr'=>['placeholder'=>'dd/mm/yyyyy'],
                    
                ))
                ->add('description')
                ->addEventListener(FormEvents::PRE_SET_DATA,function(FormEvent $event) use ($em){
                    $ticket = $event->getData();
                    $ticket->setType($em->getRepository('MyfreelanceBundle:Type')->findOneByName('a qualifier'));
                    $ticket->setState($em->getRepository('MyfreelanceBundle:State')->findOneByName('nouveau'));
                    
                });
                
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
            'data_class' => 'MyfreelanceBundle\Entity\Ticket',
            'user'=>'MyfreelanceBundle\Entity\Customer',
            'em'=>'Doctrine\ORM\EntityRepository'
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
