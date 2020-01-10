<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\training;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($this->router->generate('adminhome'));
        }

        $builder
            ->add('time')
            ->add('date')
            ->add('location')
            ->add('max_persons')
            ->add('instructor_id')

            ->add('training_id', EntityType::class,  [
                // looks for choices from this entity
                'class' => training::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'naam',

                // used to render a select box, check boxes or radios
                 //'multiple' => true,
                 'expanded' => true,
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
