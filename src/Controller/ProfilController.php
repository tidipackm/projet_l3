<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Repository\ChampionnatRepository;
use App\Repository\EquipeRepository;
use App\Repository\FavorisEquipeRepository;
use App\Repository\FavorisJoueurRepository;
use App\Repository\JoueurRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Profil', name: 'profil_')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'profil')]
    public function profil(EquipeRepository $equipe, JoueurRepository $joueur, UserRepository $user, FavorisJoueurRepository $FavorisJoueur, FavorisEquipeRepository $FavorisEquipe): Response{
        $idUser = $_GET['idUser'];
        return $this->render('profil/profil.html.twig',['idUser' => $idUser, 'equipe' => $equipe->findAll(), 'joueur' => $joueur->findAll(), 'user' => $user->findAll(), 'favorisJoueur' => $FavorisJoueur->findAll(), 'favorisEquipe' => $FavorisEquipe->findAll()]);
    }
}
