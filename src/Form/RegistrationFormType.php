<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre Email'
                ],
                'constraints' => [
                    new Email(),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Accepter les conditions',
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'label' => 'Password',
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe ne correspondent pas',
                'required' => true,

                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez votre mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot se passe doit contenir min {{ limit }} characters',
                            'max' => 50,
                        ]),
                    ],
                ],

                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                    'attr' => ['placeholder' => 'Confirmation de votre Mot de passe'],
                ],

                'mapped' => false,
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
