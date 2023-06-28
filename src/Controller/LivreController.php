<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\AuteurRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/livres', name: 'app_livre')]
    public function index(LivreRepository $al): Response
    {
        $listeLivre = $al->findAll() ;

        //dd($listeLivre) ;
        return $this->render('livre/liste.html.twig', [
            "livres" => $listeLivre
        ]);
    }

    #[Route('/livre/{id}', name: 'app_livre_fiche', requirements: ['id' => '[0-9]+'])]
    public function fiche($id,LivreRepository $al): Response
    {
        $livre = $al->find($id) ;

        //dd($listeLivre) ;
        return $this->render('livre/fiche.html.twig', [
            "livre" => $livre
        ]);
    }

    #[Route("/livre/ajouter", name:"app_livre_ajouter")]
    public function ajouter(Request $request, LivreRepository $livreRepository, AuteurRepository $auteurRepository)
    {
        
        // dump($_POST) ;
        // exit ;

        if( $request->isMethod("POST"))
        {
            $titre = $request->request->get("titre");
            $resume = $request->request->get("resume") ;

            $auteur_id = $request->request->get("auteur_id") ;
            $auteur = $auteurRepository->find($auteur_id) ;

            $livre = new Livre ;
            $livre->setTitre($titre) ;
            $livre->setResume($resume) ;
            $livre->setAuteur($auteur) ;


            $livreRepository->save($livre, true) ;

            return $this->redirectToRoute("app_livre") ;
        }
        return $this->render("livre/formulaire.html.twig", [
            "auteurs" => $auteurRepository->findAll()
            ]) ;
    }

    #[Route("livre/{id}/moifier", name: "app_livre_modifier", requirements:["id" => "\d+"])]
    public function modifier(Request $request, LivreRepository $livreRepository, int $id, AuteurRepository $auteurRepository)
    {
        $livre = $livreRepository->find($id);

        if( $request->isMethod("POST"))
        {
            $titre = $request->request->get("titre");
            $resume = $request->request->get("resume") ;

            $livre->setTitre($titre) ;
            $livre->setResume($resume) ;
            $livre->setAuteur($auteurRepository->find($request->request->get("auteur_id")));

            $livreRepository->save($livre, true) ;

            return $this->redirectToRoute("app_livre") ;
        }

        return $this->render("livre/formulaire.html.twig", [
            "livre" => $livre, "auteurs" => $auteurRepository->findAll()
            ]) ;
    }

    #[Route("livre/{id}/supprimer", name: "app_livre_supprimer", requirements:["id" => "\d+"])]
    public function supprimer(Request $request, LivreRepository $livreRepository, int $id)
    {
        $livre = $livreRepository->find($id);

        if ($request->isMethod("POST"))
        {
            $livreRepository->remove($livre, true) ;

            return $this->redirectToRoute("app_livre") ;
        }

        return $this->render("livre/suppression.html.twig", ["livre" => $livre]) ;

    }

}
