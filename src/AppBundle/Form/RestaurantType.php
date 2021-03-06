<?php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RestaurantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $recent = intval(date('Y', strtotime('today')));
        $old = intval(2000);

        $builder
            ->add('name')
            ->add('birthDate', DateType::class,  array(
                    'years' => range($old, $recent),
                    'placeholder' => array(
                        'year' => '2000',
                        'month' => 'Jan',
                        'day' => '1'
                    ),
                )
            )
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('description')
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('description')
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Restaurant',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_restaurant';
    }

}