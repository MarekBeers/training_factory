<?php

namespace App\Form;

use App\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('loginname')
            ->add('password')
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth')
            ->add('gender')
            ->add('hiring_date')
            ->add('salary')
            ->add('street')
            ->add('postal_code')
            ->add('place')
//            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => user::class,
        ]);
    }
}
