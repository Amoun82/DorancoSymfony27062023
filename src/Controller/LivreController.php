<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(LivreRepository $al): Response
    {
        $listeLivre = $al->findAll() ;

        //dd($listeLivre) ;
        return $this->render('livre/liste.html.twig', [
            "livres" => $listeLivre
        ]);
    }

    #[Route('/livre/{id}', name: 'app_livre_fiche')]
    public function fiche($id,LivreRepository $al): Response
    {
        $livre = $al->find($id) ;

        //dd($listeLivre) ;
        return $this->render('livre/fiche.html.twig', [
            "livre" => $livre
        ]);
    }
}
