<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Maid;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TimeslotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startHour', ChoiceType::class, array(
                'choices'=> range(0,23)
            ))
            ->add('startMinute', ChoiceType::class, array(
                'choices'=> array(
                    0 => '00',
                    15 => '15',
                    30 => '30',
                    45 => '45',
                )
            ))
            ->add('endHour', ChoiceType::class, array(
                'choices'=> range(0,23)
            ))
            ->add('endMinute', ChoiceType::class, array(
                'choices'=> array(
                    0 => '00',
                    15 => '15',
                    30 => '30',
                    45 => '45',
                )
            ))
            ->add('dayOfWeek', ChoiceType::class, array(
                'choices'=> array(
                    1 => 'Monday',
                    2 => 'Tuesday',
                    3 => 'Wednesday',
                    4 => 'Thursday',
                    5 => 'Friday',
                    6 => 'Saturday',
                    0 => 'Sunday',
                ),
            ))
            ->add('restaurant', EntityType::class, array(
                'class' => 'AppBundle:Restaurant',
                'choice_label' => 'name',
            ))
            ->add('maid', EntityType::class, array(
                'class' => 'AppBundle:Maid',
                'choice_label' => 'name',
            ))
         ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Timeslot'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_timeslot';
    }
}
