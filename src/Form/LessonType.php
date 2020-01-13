<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time', TimeType::class ,[
                'label'=> 'Tijd stip',
            ])
            ->add('date', DateType::class ,[
                'label'=> 'Datum',
            ])
            ->add('location', TextType::class ,[
                'label'=> 'Zaal',
            ])
            ->add('max_persons', IntegerType::class, [
                'label'=> 'Max aantal personen',
            ])
            ->add('training_id', EntityType::class,  [
                'class' => training::class,
                'choice_label' => 'naam',
                'label'=> 'Training',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
