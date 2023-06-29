<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('nom', TextType::class, [
                "label"         => "Nom ou Pseudo",
                "constraints"   => [
                    new NotBlank([
                        "message" => "Le mon de l'auteur ne peut pas être vide !"
                    ]),
                    new Length([
                        "max"           => 30,
                        "maxMessage"    => "Le nom ne doit pas comporter plus de 30 caratères",
                        "min"           => 4,
                        "minMessage"    => "Le nom doit contenir au minimum {{ limit }} caractères"
                    ])
                    ],
                    "required" => false
            ])
            ->add('bio')
            ->add('naissance', DateType::class,[
                "widget" => "single_text",
                "label" => "Date de naissance",
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
