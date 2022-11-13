<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Repository\ChampionnatRepository;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ficheChampionnat', name: 'ficheChampionnat_')]
class FicheChampionnatController extends AbstractController
{
    #[Route('/', name: 'fiche')]
    public function ficheChampionnat(ChampionnatRepository $championnat, EquipeRepository $equipe): Response{
        $idChamp = $_GET['id'];
        return $this->render('ficheChampionnat/ficheChampionnat.html.twig',['championnat' =>$championnat->findAll(), 'idChamp' => $idChamp, 'equipe' => $equipe->findAll()]);
    }
}
