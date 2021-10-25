<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Teacher Name',
                'required' => true
            ])
            ->add('email', TextType::class,
            [
                'label' => 'Teacher Email',
                'required' => true
            ])
            ->add('birthday', DateType::class, 
            [
                'label' => 'Teacher Birthday',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('major', TextType::class,
            [
                'label' => 'Major',
                'required' => true
            ])
            ->add('image', FileType::class,
            [
                'label' => "Teacher Image",
                'data_class' => null,
                'required' => is_null($builder->getData()->getImage())
            ])
            // ->add('courses', EntityType::class,
            // [
            //     'label' => 'Course',
            //     'class' => Course::class, 
            //     'choice_label' => "title",
            //     'multiple' => true,
            //     'expanded' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
