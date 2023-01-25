<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un nom',
                    ]),
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères',
                        'max' => '50',
                        'maxMessage' => 'Votre nom doit contenir maximum {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'label'=> 'Prénom *',
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un prénom',
                    ]),
                    new Assert\Length([
                        'min' => '2',
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères',
                        'max' => '50',
                        'maxMessage' => 'Votre prénom doit contenir maximum {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('phone', TextType::class, [
                'label'=> 'Téléphone *',
                'attr' => [
                    'minlength' => '8',
                    'maxlength' => '10'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un numéro de téléphone',
                    ]),
                    new Assert\Length([
                        'min' => '8',
                        'minMessage' => 'Votre numéro doit contenir au moins {{ limit }} caractères',
                        'max' => '10',
                        'maxMessage' => 'Votre numéro doit contenir maximum {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'attr' => [
                    'min' => '2',
                    'max' => '180'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Entrez une adresse mail']),
                    new Assert\Email(['message' => 'Entrez une adresse mail valide']),
                    new Assert\Length([
                        'min' =>2,
                        'max' => 180,
                        'minMessage' => 'L\'adresse mail doit faire plus de {{ limit }} caractères',
                        'maxMessage' => 'L\'adresse mail doit faire moins de {{ limit }} caractères'])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter nos termes *',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes pour continuer',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe *',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
