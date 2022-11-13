<?php

namespace App\Controller;
use App\Entity\Championnat;
use App\Entity\FavorisJoueur;
use App\Repository\EquipeRepository;
use App\Repository\FavorisEquipeRepository;
use App\Repository\FavorisJoueurRepository;
use App\Repository\JoueurRepository;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



#[Route('/ficheEffectif', name: 'ficheEffectif_')]
class FicheEffectifController extends AbstractController
{
    #[Route('/', name: 'fiche')]
    public function listeEffectif(EquipeRepository $equipe, JoueurRepository $joueur, FavorisJoueurRepository $favorisJoueurRepository): Response{
        $idEquipe = $_GET['id'];
        return $this->render('ficheEffectif/ficheEffectif.html.twig',['idEquipe' => $idEquipe, 'equipe' => $equipe->findAll(), 'joueur' => $joueur->findAll(), 'favorisJoueur' => $favorisJoueurRepository->findAll()]);
    }


    #[Route('/ajoutFavoris', name: 'ajoutFavoris')]
    public function ajoutFavorisEquipe(Request $request, ManagerRegistry $doctrine, JoueurRepository $joueur, EquipeRepository $equipe, FavorisJoueurRepository $favorisJoueurRepository) {
        $idEquipe = $_GET['id'];
        $idJoueurFav = $_GET['idJoueur'];
        $idUserFav = $_GET['idUser'];

        
        $entityManager = $doctrine->getManager();
        
        $favorisJoueur = new FavorisJoueur();
        $favorisJoueur->setIdJoueur($idJoueurFav);
        $favorisJoueur->setIdUser($idUserFav);

        $entityManager->persist($favorisJoueur);
        $entityManager->flush();

        return $this->render('ficheEffectif/ficheEffectif.html.twig',['idEquipe' => $idEquipe, 'equipe' => $equipe->findAll(),'favorisJoueur' => $favorisJoueurRepository->findAll(), 'joueur' => $joueur->findAll()]);

    }


    #[Route('/{id}', name: 'supprimerFavoris', methods: ['POST'])]
    public function delete(Request $request, FavorisJoueur $favorisJoueur, FavorisJoueurRepository $favorisJoueurRepository, EquipeRepository $equipe, JoueurRepository $joueur): Response
    {
        $idEquipe = $_GET['id'];

        if ($this->isCsrfTokenValid('delete'.$favorisJoueur->getId(), $request->request->get('_token'))) {
            $favorisJoueurRepository->remove($favorisJoueur, true);
        }

        return $this->render('ficheEffectif/ficheEffectif.html.twig',['idEquipe' => $idEquipe, 'equipe' => $equipe->findAll(),'favorisJoueur' => $favorisJoueurRepository->findAll(), 'joueur' => $joueur->findAll()]);
}
}