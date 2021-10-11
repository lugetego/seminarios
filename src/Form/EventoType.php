<?php

namespace App\Form;

use App\Entity\Evento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lugar')
            ->add('seminario',null, [
                'placeholder' => 'Seleccionar',
            ])
            ->add('fecha',DateTimeType::class, array(
                'required' => true,
                'label'=>'Fecha y hora',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                ],
            ))
          //  ->add('hora')
            ->add('ponente')
            ->add('origen')
            ->add('platica')
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
