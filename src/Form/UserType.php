<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Votre prénom ne peut pas contenir moins de {{ limit }} lettre.',
                        'max' => 60,
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez votre Nom'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Votre prénom ne peut pas contenir moins de {{ limit }} lettre.',
                        'max' => 60,
                    ])
                ]
            ])
            ->add('job', TextType::class,[
                'label' => 'Poste actuel',
                'attr' => [
                    'placeholder' => 'Entrer votre poste actuel'
                ],
            ])
            ->add('link_github', UrlType::class, [
                'label' => 'Lien Github',
                'attr' => [
                    'placeholder' => 'Entrez votre lien GitHub'
                ],
            ])
            ->add('link_linkedin', UrlType::class, [
                'label' => 'Lien LinkedIn',
                'attr' => [
                    'placeholder' => 'Entrez votre lien LinkedIn'
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Décrivez vous en quelques mots'
                ]

            ])
            ->add('skill', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'Développeur web back-end' => 'Développeur web back-end',
                    'Développeur web front-end' => 'Développeur web front-end',
                    'Développeur CMS' => 'Développeur CMS',
                    'Intégrateur web' => 'Intégrateur web',
                    'Web designer' => 'Web designer',
                    'architecture web / mobile' => 'architecture web / mobile',
                    'webmaster' => 'webmaster',
                    'chef de projet we' => 'chef de projet we',
                    'chef de projet CRM' => 'chef de projet CRM',
                    'country manager' => 'country manager',
                    'product owner' => 'product owner',
                ],
            ])->add('technology', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'HTML' => 'HTML',
                    'CSS' => 'CSS',
                    'Javascript' => 'Javascript',
                    'HTTP' => 'HTTP',
                    'Symfony' => 'Symfony',
                    'Laravel' => 'Laravel',
                    'NodeJS' => 'NodeJS',
                    'ASP net core' => 'ASP net core',
                    'Sitefinity' => 'Sitefinity',
                    'Site core' => 'Site core',
                    'Wordpress' => 'Wordpress',
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
