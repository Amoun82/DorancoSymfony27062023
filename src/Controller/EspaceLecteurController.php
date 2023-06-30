<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Emprunt;
use App\Repository\EmpruntRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/espace-lecteur', name: 'app_espace_lecteur')]

class EspaceLecteurController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('espace_lecteur/index.html.twig', [
            'controller_name' => 'EspaceLecteurController',
        ]);
    }

    #[Route('/emprunter-livre-{id}', name: '_emprunter')]
    public function emprunter(Livre $livre, EmpruntRepository $er )
    {
        $emprunt = new Emprunt ;
        $emprunt->setLivre( $livre ) ;
        $emprunt->setDateEmprunt( new \DateTime() ) ;
        // La méthode 'getUser' permet de récupérer un objet Abonne avec les informations de l'utilisateur connecté
        // si getUser retourne null, alors il n'y a pas d'utilisateur connecté.
        $emprunt->setAbonne( $this->getUser() ) ;
        $er->save($emprunt, true) ;
        return $this->redirectToRoute("app_espace_lecteur_index") ;
    }
}
