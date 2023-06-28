<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurFormType;
use App\Repository\AuteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuteurController extends AbstractController
{
    /**
     * Pour avoirune route dans un projet symfony, on utilise les attributs PHP 8
     * (ou les annotations si on utilise PHP 7)
     * Le constructeur de la classe Route a un argument obligatoire, le chemin relatif,
     * c'est-à-dire l'URL pour lequel cette méthode sera exécutée.
     * ⚠ le chemin dtoi tjs commencer par "/".
     */
    #[Route('/auteurs', name: 'app_auteur')]
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
        return $this->render('auteur/liste.html.twig', [
            "auteurs" => $listeAuteur
        ]);
    }

    #[Route('/auteur/{id}', name: 'app_auteur_fiche', requirements:['id' => '\d+'])]
    public function fiche($id,AuteurRepository $ar)
    {
        $auteur = $ar->find($id) ;
        return $this->render("auteur/fiche.html.twig", [
            "auteur" => $auteur
            ]) ;
    }

    #[Route("auteur/{id}/modifider", name: "app_auteur_modifier", requirements:["id" => "\d+"])]
    public function modifier($id, Request $rq, AuteurRepository $ar)
    {
        $auteur = $ar->find($id) ;
        $form = $this->createForm(AuteurFormType::class, $auteur) ;
        $form->handleRequest($rq);
        if($form->isSubmitted() && $form->isValid())
        {
            $ar->save($auteur, true) ;
            return $this->redirectToRoute("app_auteur") ;
        }
        return $this->render("auteur/formulaire.html.twig", [
            "formAuteur" => $form->createView(),
            "auteur" => $auteur
        ]);
    }

    #[Route("auteur/{id}/supprimer", name: "app_auteur_supprimer", requirements:["id" => "\d+"])]
    public function supprimer($id, AuteurRepository $ar, Request $rq)
    {
        $auteur = $ar->find($id) ;

        if ($rq->isMethod("POST"))
        {
            $ar->remove($auteur, true) ;

            return $this->redirectToRoute("app_auteur") ;
        }

        return $this->render("auteur/suppression.html.twig", ["auteur" => $auteur]) ;

    }


    #[Route('/auteur/ajouter', name: 'app_auteur_ajouter')]
    public function ajouter(Request $rq, AuteurRepository $ar)
    {
        $auteur = new Auteur ;
        $form = $this->createForm(AuteurFormType::class, $auteur) ;
        $form->handleRequest($rq);
        if($form->isSubmitted() && $form->isValid())
        {
            $ar->save($auteur, true) ;
            return $this->redirectToRoute("app_auteur") ;
        }
        return $this->render("auteur/formulaire.html.twig", [
            "formAuteur" => $form->createView()
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
