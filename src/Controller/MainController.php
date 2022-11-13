<?php

namespace App\Controller;

use App\Repository\ChampionnatRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ChampionnatRepository $championnatRepository, UserRepository $userRepository): Response
    {

        return $this->render('main/index.html.twig', ['championnat' => $championnatRepository->findAll(), 'user' => $userRepository->findAll()]);
    }
}
