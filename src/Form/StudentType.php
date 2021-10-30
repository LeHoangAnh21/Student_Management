<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\Category;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Student Name',
                'required' => true
            ])
            ->add('email', TextType::class,
            [
                'label' => 'Student Email',
                'required' => true
            ])
            ->add('studentId', TextType::class,
            [
                'label' => 'Student ID',
                'required' => true
            ])
            ->add('birthday', DateType::class, 
            [
                'label' => 'Student Birthday',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('major', EntityType::class,
            [
                'label' => 'Category',
                'class' => Category::class, 
                'choice_label' => "name"
                
            ])
            ->add('image', FileType::class,
            [
                'label' => "Student Image",
                'data_class' => null,
                'required' => is_null($builder->getData()->getImage())
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
