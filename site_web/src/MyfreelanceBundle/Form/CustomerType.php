<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('address')
                ->add('zipCode')
                ->add('city')
                ->add("siren")
                ->add('siret')
                ->add('legalForm')
                ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event){
                    $data = $event->getData();
                    $data->setUsername("null");
                    $data->setEmail("null");
                    $data->setEnabled(true);
                    $data->setPassword("123");
                })
                ->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event){
                    $data = $event->getData();
                    $data->setSurname($data->getName());
                })
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfreelance_parameterbundle_customer';
    }
    
    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


}
