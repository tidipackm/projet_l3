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

#[Route('/Admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin')]
    public function profil(EquipeRepository $equipe, JoueurRepository $joueur, UserRepository $user, FavorisJoueurRepository $FavorisJoueur, FavorisEquipeRepository $FavorisEquipe): Response{
        $idUser = $_GET['idUser'];
        return $this->render('admin/admin.html.twig',['idUser' => $idUser, 'equipe' => $equipe->findAll(), 'joueur' => $joueur->findAll(), 'user' => $user->findAll(), 'FavorisJoueur' => $FavorisJoueur->findAll(), 'FavorisEquipe' => $FavorisEquipe->findAll()]);
    }
}
