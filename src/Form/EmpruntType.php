<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Abonne;
use App\Entity\Emprunt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateEmprunt', DateType::class ,[
                "widget" => "single_text",
                "label" => "Emprunté le"
            ])
            ->add('dateRetour', DateType::class, [
                "widget" => "single_text",
                "label" => "Rendu le ",
                "required" => false
            ])
            ->add('livre', EntityType::class, [
                "class" => Livre::class,
                "choice_label" => function($livre){
                    return $livre->getTitre()." - ".$livre->getAuteur()->getIdentite() ;
                },
                "placeholder" => ""
            ])
            ->add('abonne', EntityType::class, [
                "class" => Abonne::class,
                "choice_label" => "pseudo",
                "placeholder" => ""
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
