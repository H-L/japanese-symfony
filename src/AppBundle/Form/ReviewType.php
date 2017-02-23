<?php

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rate', ChoiceType::class ,array(
                'choices' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ),
                'choice_label' => function ($value, $key, $index) {
                    if ($value == $index) {
                        return false;
                    }
                    return strtoupper($key);

                    // or if you want to translate some key
                    //return 'form.choice.'.$key;
                },
                'expanded' => true,
            ))
            ->add('comment')
            ->add('maid', EntityType::class, array(
                'class' => 'AppBundle\Entity\Maid',
                'choice_label' => 'name',
            ))
            ->add('user', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'choice_label' => 'username',
            ))
            ->add('restaurant', EntityType::class, array(
                'class' => 'AppBundle\Entity\Restaurant',
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
            'data_class' => 'AppBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_review';
    }


}
