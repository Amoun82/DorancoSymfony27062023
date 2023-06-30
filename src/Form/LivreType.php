<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('resume')
            ->add('auteur', EntityType::class, [
                "class"         => Auteur::class,
                "choice_label"  => "identite",
                "placeholder"   => "Choississez un auteur..."
            ])
            ->add("genres", EntityType::class, [
                "class"         => Genre::class,
                "choice_label"  => "libelle",
                "multiple"      => true,
                "expanded"      => true

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
