<?php

namespace App\Form;

use App\Entity\PimentoSearch;
use App\Entity\Color;
use App\Entity\Strength;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class PimentoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('search', SearchType::class, [
                'label' => 'Recherche',
                'required' => false,
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('minPrice', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('maxPrice', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('minStrength', EntityType::class, [
                'required' => false,
                'class' => Strength::class,
                'choice_label' => 'power',
                'label' => 'Force min',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('maxStrength', EntityType::class, [
                'required' => false,
                'class' => Strength::class,
                'choice_label' => 'power',
                'label' => 'Force max',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('color', EntityType::class, [
                'required' => false,
                'class' => Color::class,
                'choice_label' => 'name',
                'label' => 'Couleur',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => PimentoSearch::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
