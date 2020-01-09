<?php

namespace App\Form;

use App\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('loginname')
            ->add('password', PasswordType::class)
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth', BirthdayType::class, [
                // this is actually the default format for single_text
                'format' => 'dd-MM-yyyy',
            ])
            ->add('gender')
            ->add('street')
            ->add('postal_code')
            ->add('place')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Geslacht' => [
                        'Man' => 'Man',
                        'Vrouw' => 'Vrouw',
                    ],
                ],
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => user::class,
        ]);
    }
}
