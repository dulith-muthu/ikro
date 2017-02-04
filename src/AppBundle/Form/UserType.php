<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', RepeatedType::class,array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options'  => array('label' => 'Password*'),
                'second_options' => array('label' => 'Repeat Password*')
            ))
            ->add('email')
            ->add('role')
            ->add('save', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Users',
        ));
    }

    public function getName()
    {
        return 'app_bundle_user_type';
    }
}
