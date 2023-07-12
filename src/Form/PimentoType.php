<?php

namespace App\Form;

use App\Entity\Pimento;
use App\Entity\Strength;
use App\Entity\Color;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PimentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('strength', EntityType::class, [
                'class' => Strength::class,
                'choice_label' => 'name',
            ])
            ->add('Color', EntityType::class, [
                'class' => Color::class,
                'choice_label' => 'name',
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pimento::class,
        ]);
    }
}
