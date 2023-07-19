<?php

namespace App\Form;

use App\Entity\Color;
use App\Entity\Country;
use App\Entity\Pimento;
use App\Entity\Strength;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Vich\UploaderBundle\Form\Type\VichFileType;


class PimentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', SearchType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Ex : Piment parisien',
                    'class' => 'border-2 border-secondary',
                ]])
            ->add('price', SearchType::class, [
                'label' => 'Prix au kilo',
                'attr' => [
                    'placeholder' => 'Ex : 160',
                    'class' => 'border-2 border-secondary',
                ]])
            ->add('description', SearchType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Ex : Apprécié des enfants, ce piment est...',
                    'class' => 'border-2 border-secondary',
                ]])
            ->add('strength', EntityType::class, [
                'class' => Strength::class,
                'choice_label' => 'name',
                'label' => 'Indice Scoville',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('color', EntityType::class, [
                'class' => Color::class,
                'choice_label' => 'name',
                'label' => 'Couleur',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => 'Origine',
                'attr' => [
                    'class' => 'border-2 border-secondary',
                ]

            ])
            ->add('posterFile', VichFileType::class,[
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pimento::class,
        ]);
    }
}
