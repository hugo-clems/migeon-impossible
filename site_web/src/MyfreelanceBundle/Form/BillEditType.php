<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use MyfreelanceBundle\Entity\User;

use Symfony\Component\Form\FormError;

use MyfreelanceBundle\Entity\Bill;

use Doctrine\ORM\EntityRepository;


class BillEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//                ->add('settlementDate')
                
                ->add('ticketList', CollectionType::class,array(
                    'entry_type'=> TicketBillType::class
                ))
               
               
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


class TicketBillType extends AbstractType{
     /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
               ->add('price', MoneyType::class)
                ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
                    $data = $event->getData();
                    $form = $event->getForm();
                    $data->initPrice();
                });
               
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

    
}
