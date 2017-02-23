<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Maid;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TimeslotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startHour', ChoiceType::class, array(
                'choices'=> range(0, 23),
            ))
            ->add('startMinute', ChoiceType::class, array(
                'choices'=> array(
                    '00' => 0,
                    '15' => 1,
                    '30' => 2,
                    '45' => 45,
                )
            ))
            ->add('endHour', ChoiceType::class, array(
                'choices'=> range(0, 23)
            ))
            ->add('endMinute', ChoiceType::class, array(
                'choices'=> array(
                    '00' => 0,
                    '15' => 1,
                    '30' => 2,
                    '45' => 45,
                )
            ))
            ->add('dayOfWeek', ChoiceType::class, array(
                'choices'=> array(
                    'Monday' => 1,
                    'Tuesday' => 2,
                    'Wednesday' => 3,
                    'Thursday' => 4,
                    'Friday' => 5,
                    'Saturday' =>6,
                    'Sunday' => 0,
                ),
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
