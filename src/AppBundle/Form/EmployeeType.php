<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\VarDumper\VarDumper;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $legalStartDate = intval(date('Y', strtotime('-15 years')));
        $average = intval(date('Y', strtotime('-25 years')));
        $old = intval(date('Y', strtotime('-100 years')));

        $builder
            ->add('name')
            ->add('lastName')
            ->add('birthDate', DateType::class, array(
                'years' => range($old, $legalStartDate),
                'placeholder' => array(
                    'year' => $average, 'month' => 'Jan', 'day' => '1'
                ),
            ))
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('description')
        ;
        
        if($options['maid'] === true) {
            $builder
                ->add('maidName')
                ->add('bloodType')
                ->add('favoriteThings')
                ->add('blogUrl')
                ->add('twitterUrl')
            ;

        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employee',
            'maid' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_employee';
    }


}
