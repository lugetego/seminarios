<?php

namespace App\Form;

use App\Entity\Evento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lugar')
            ->add('emails',null, array(
                'label'=>'Correo responsables',
            ))

            ->add('seminario',null, [
                'placeholder' => 'Seleccionar',
            ])
            ->add('fecha',DateType::class, array(
                'required' => true,
                'label'=>'Fecha',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                ],
            ))
            ->add('hora',TimeType::class, array(
                'required' => true,
                'label'=>'Hora',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                ],
            ))
            ->add('ponente')
            ->add('origen',null, array(
                'label'=>'Institución de origen',
            ))
            ->add('platica',null, array(
                'label'=>'Titulo',
                ))
            ->add('resumen')
            ->add('comentario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
