<?php

namespace App\Form;

use App\Entity\Time;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class,[
                'label'=> 'Jour de réservation souhaité *'
            ])
            ->add('hour',TimeType::class , [
                'label'=> 'Heure de réservation souhaité *',
                'input' => 'datetime',
                'widget' => 'choice',
                'hours'=> [
                  8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23
                ],
                'minutes'=> [
                    00, 30
                ],
                'placeholder' => [
                    'hour' => 'Heures', 'minute' => 'Minutes',
                ],
            ])
            /*->add('user')*/
            ->add('terrain')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Time::class,
        ]);
    }
}
