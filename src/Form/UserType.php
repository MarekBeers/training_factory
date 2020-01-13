<?php

namespace App\Form;

use App\Entity\user;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('loginname', TextType::class ,[
                'label'=> 'Login naam',
            ])
            ->add('password', PasswordType::class, [
                'label'=> 'Wachtwoord',
            ])
            ->add('firstname', TextType::class ,[
                'label'=> 'Voornaam',
            ])
            ->add('preprovision', TextType::class ,[
                'label'=> 'Tussenvoegsel',
            ])
            ->add('lastname', TextType::class ,[
                'label'=> 'Achternaam',
            ])
            ->add('dateofbirth', BirthdayType::class, [
                // this is actually the default format for single_text
                'format' => 'dd-MM-yyyy',
                'label'=> 'Geboortedatum',
            ])
            ->add('street', TextType::class ,[
                'label'=> 'Straat',
            ])
            ->add('postal_code', TextType::class ,[
                'label'=> 'Postcode',
            ])
            ->add('place', TextType::class ,[
                'label'=> 'Plaats',
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Man' => 'Man',
                    'Vrouw' => 'Vrouw',
                ],
                'label'=> 'Geslacht',
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => user::class,
        ]);
    }
}
