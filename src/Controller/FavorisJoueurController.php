<?php

namespace App\Controller;

use App\Entity\FavorisJoueur;
use App\Form\FavorisJoueurType;
use App\Repository\FavorisJoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/favoris/joueur')]
class FavorisJoueurController extends AbstractController
{
    #[Route('/', name: 'app_favoris_joueur_index', methods: ['GET'])]
    public function index(FavorisJoueurRepository $favorisJoueurRepository): Response
    {
        return $this->render('favoris_joueur/index.html.twig', [
            'favoris_joueurs' => $favorisJoueurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favoris_joueur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavorisJoueurRepository $favorisJoueurRepository): Response
    {
        $favorisJoueur = new FavorisJoueur();
        $form = $this->createForm(FavorisJoueurType::class, $favorisJoueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisJoueurRepository->save($favorisJoueur, true);

            return $this->redirectToRoute('app_favoris_joueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris_joueur/new.html.twig', [
            'favoris_joueur' => $favorisJoueur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_joueur_show', methods: ['GET'])]
    public function show(FavorisJoueur $favorisJoueur): Response
    {
        return $this->render('favoris_joueur/show.html.twig', [
            'favoris_joueur' => $favorisJoueur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favoris_joueur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FavorisJoueur $favorisJoueur, FavorisJoueurRepository $favorisJoueurRepository): Response
    {
        $form = $this->createForm(FavorisJoueurType::class, $favorisJoueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisJoueurRepository->save($favorisJoueur, true);

            return $this->redirectToRoute('app_favoris_joueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris_joueur/edit.html.twig', [
            'favoris_joueur' => $favorisJoueur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_joueur_delete', methods: ['POST'])]
    public function delete(Request $request, FavorisJoueur $favorisJoueur, FavorisJoueurRepository $favorisJoueurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favorisJoueur->getId(), $request->request->get('_token'))) {
            $favorisJoueurRepository->remove($favorisJoueur, true);
        }

        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }
    
}
