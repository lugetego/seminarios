<?php

namespace App\Form;

use App\Entity\Seminario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;



class SeminarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('lugar')
            ->add('hora', TimeType::class, [
                // renders it as a single text box
                'input'  => 'datetime',
                'widget' => 'single_text',
                'placeholder' => [
                    'hour' => 'Hour', 'minute' => 'Minute',
                ],
            ])
            ->add('estatus', CheckboxType::class, [
                'label_attr' => ['class' => 'checkbox-switch'],
                'label' => 'Activo'
            ])
            ->add('responsables')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seminario::class,
        ]);
    }


}
