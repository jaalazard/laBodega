<?php

namespace App\Form;

use App\Entity\PimentoSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PimentoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->setMethod('GET')
        ->add('search', SearchType::class, [
            'label' => 'Recherche',
            'required' => false,
        ])
        ->add('minPrice', NumberType::class, [
            'required' => false,
        ])
        ->add('maxPrice', NumberType::class, [
            'required' => false,
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