<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du projet',
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre projet',
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le nom de votre projet ne peut pas contenir moins de {{ limit }} lettre.',
                        'max' => 60,
                    ])
                ]

            ] )
            ->add('start_date', DateType::class, [
                'label' => 'Date de debut du projet',
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
            ])
            ->add('end_date', DateType::class, [
                'label' => 'Date de fin souhaité du projet',
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                ])
            ->add('nb_employees', IntegerType::class ,[
                'attr' => [
                    'min' => 0,
                    'max' => 50,
                ]
            ])
            ->add('short_description', TextType::class, [
                'label' => 'description courte',
                'attr' => [
                    'placeholder' =>'entrez une description courte '
                ]
            ])
            ->add('details', TextareaType::class, [
                'label' => 'Détails projet',
                'attr' => [
                    'placeholder' => 'Vous pouvez preciser plus de votre projet ici ....'
                ]
            ])
            ->add('project_skill', ChoiceType::class, [
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
            ])->add('project_technology', ChoiceType::class, [
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
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
