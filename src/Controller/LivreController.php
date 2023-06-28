<?php

namespace App\Controller;

use App\Entity\Livre;
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
    public function ajouter(Request $request, LivreRepository $livreRepository)
    {
        
        // dump($_POST) ;
        // exit ;

        if( $request->isMethod("POST"))
        {
            $titre = $request->request->get("titre");
            $resume = $request->request->get("resume") ;

            $livre = new Livre ;
            $livre->setTitre($titre) ;
            $livre->setResume($resume) ;

            $livreRepository->save($livre, true) ;

            return $this->redirectToRoute("app_livre") ;
        }
        return $this->render("livre/formulaire.html.twig") ;
    }

    #[Route("livre/{id}/moifier", name: "app_livre_modifier", requirements:["id" => "\d+"])]
    public function modifier(Request $request, LivreRepository $livreRepository, int $id)
    {
        $livre = $livreRepository->find($id);

        if( $request->isMethod("POST"))
        {
            $titre = $request->request->get("titre");
            $resume = $request->request->get("resume") ;

            $livre->setTitre($titre) ;
            $livre->setResume($resume) ;

            $livreRepository->save($livre, true) ;

            return $this->redirectToRoute("app_livre") ;
        }

        return $this->render("livre/formulaire.html.twig", ["livre" => $livre]) ;
    }
}
