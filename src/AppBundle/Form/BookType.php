<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('seats')
            ->add('date', ChoiceType::class, array(
                    'choices'  => array(
                        'Today' => 'today',
                        'Tomorrow' => 'tomorrow',
                        'Day After Tomorrow' => 'day_after_tomorrow',
                    )
                    )
            )
            ->add('showTime', ChoiceType::class, array(
            'choices'  => array(
                'Morning' => 'morning',
                'Afternoon' => 'evening',
                'Night' => 'night',
                )
                )
            )
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_book';
    }


}
