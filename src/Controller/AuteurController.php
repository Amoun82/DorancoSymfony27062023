<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * Pour avoirune route dans un projet symfony, on utilise les attributs PHP 8
     * (ou les annotations si on utilise PHP 7)
     * Le constructeur de la classe Route a un argument obligatoire, le chemin relatif,
     * c'est-à-dire l'URL pour lequel cette méthode sera exécutée.
     * ⚠ le chemin dtoi tjs commencer par "/".
     */
    #[Route('/auteur', name: 'app_auteur')]
    public function index(AuteurRepository $auteurRepository): Response
    {
        /**
         * La méthode render() vas générer l'affichage ;
         * 1er argument : le fichier qui vas être utilisé par l'affichage
         * 2ème arguement (optionel) : il doit être de type array. Il contient
         *              les variables qui seront utilisés dans le fichier utilisé pour
         *              l'affichage. C'est un array ASSOCIATIF
         * 
         * NB : le nom du fichier est donné a partir  du dossier "template" 
         * 
         */

        $listeAuteur = $auteurRepository->findAll() ;

        //dd($listeAuteur) ;
        return $this->render('auteur/exo.html.twig', [
            "auteurs" => $listeAuteur
        ]);
    }

    #[Route('/auteur/test', name: 'app_auteur_test')]
    public function test()
    {
        return $this->render("base.html.twig", ["variable" => 75, "nombre" => 2, "prenom" => "Francois"]);
    }

    #[Route('/auteur/salut', name: 'app_auteur_salut')]
    public function salut()
    {
        return $this->render("auteur/salut.html.twig", ["prenom" => "stef"]);
    }

}
