<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormError;

use MyfreelanceBundle\Entity\Bill;

use Doctrine\ORM\EntityRepository;


class BillType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//                ->add('settlementDate')
                ->add('customer', EntityType::class,array(
                    'class'=>'MyfreelanceBundle:CustomerSociety',
                    'choice_label'=>'name'
                ))
                ->add('title')
                ->add('ticketList', EntityType::class,array(
                    'class'=>'MyfreelanceBundle:Ticket',
                    'choice_label'=>'title',
                    'query_builder'=> function( EntityRepository $er){
                        return $er->qbGoToTheBill();
                        },
                    'multiple'=>true,
                    'expanded'=>true
                ))
               
//                ->add('ticketList', CollectionType::class,array(
//                ))
                ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $form){
                    $bill = $form->getData();
                    $bill->setDate(new \DateTime("NOW"));
                    $bill->setEtat(Bill::CONSTRUCT);
                    
                })
               
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Bill'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfreelancebundle_bill';
    }


}
