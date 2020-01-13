<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time')
            ->add('date')
            ->add('location')
            ->add('max_persons', IntegerType::class)
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
