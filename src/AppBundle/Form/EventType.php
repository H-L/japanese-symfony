<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $todayYear = intval(date('Y', strtotime('today')));
        $builder
            ->add('name')
            ->add('description')
            ->add('start', DateTimeType::class, array(
                'with_seconds' => false,
                'years' => range($todayYear, 2100)

            ))
            ->add('end', DateTimeType::class, array(
                'with_seconds' => false,
                'years' => range($todayYear, 2100)
            ))
            ->add('profilePicture', EntityType::class, array(
                'class' => 'AppBundle\Entity\Image',
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
            ))
            ->add('restaurant', EntityType::class, array(
                'class' => 'AppBundle:Restaurant',
                'choice_label' => 'name',
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
