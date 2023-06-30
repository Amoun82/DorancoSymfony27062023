<?php

namespace App\Form;

use App\Entity\Abonne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            ->add('roles', ChoiceType::class, [
                "choices"   => [
                    "Directeur"         => "ROLE_ADMIN",
                    "Bibliothécaire"   => "ROLE_BIBLIO",
                    "Lecteur"           => "ROLE_LECTEUR",
                    "Abonné"            => "ROLE_USER"
                ],
                "multiple"  => true,
                "expanded"  => true,
                "label"     => "Droit d'accès"
            ])
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('naissance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonne::class,
        ]);
    }
}
