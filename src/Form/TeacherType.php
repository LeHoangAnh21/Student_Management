<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Teacher;
use App\Entity\Category;
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
            ->add('major', EntityType::class,
            [
                'label' => 'Category',
                'class' => Category::class, 
                'choice_label' => "name"
            ])
            ->add('image', FileType::class,
            [
                'label' => "Teacher Image",
                'data_class' => null,
                'required' => is_null($builder->getData()->getImage())
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
