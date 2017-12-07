<?php

namespace MyfreelanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('date', DateType::class,array(
                    'widget'=>'single_text',
                    'format'=>'dd/MM/yyyy',
                    'attr'=>array('placeholer'=>'dd/MM/yyyy')
                ))
                ->add('description')
//                ->add('customer', EntityType::class,array(
//                    'class'=>'MyfreelanceBundle:Customer',
//                    'choice_label'=>'name'
//                ))
                ;
//        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event){
//            $data = $event->getData();
//            dump($data);die;
//            
//        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyfreelanceBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myfreelancebundle_project';
    }


}
