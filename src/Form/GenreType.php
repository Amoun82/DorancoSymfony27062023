<?php

namespace App\Form;

use App\Entity\Genre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                "constraints" => [
                    new Length([
                        "min" => 2,
                        "max" => 50,
                        "minMessage" => "Le libelle doit contenir au minimum {{ limit }} caractères",
                        "maxMessage" => "Le libelle ne doit pas contenir plus de {{ limit }} caractères"
                    ])
                ]
            ])
            ->add('mots_cles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Genre::class,
        ]);
    }
}
