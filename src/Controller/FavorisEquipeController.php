<?php

namespace App\Controller;

use App\Entity\FavorisEquipe;
use App\Form\FavorisEquipeType;
use App\Repository\FavorisEquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/favoris/equipe')]
class FavorisEquipeController extends AbstractController
{
    #[Route('/', name: 'app_favoris_equipe_index', methods: ['GET'])]
    public function index(FavorisEquipeRepository $favorisEquipeRepository): Response
    {
        return $this->render('favoris_equipe/index.html.twig', [
            'favoris_equipes' => $favorisEquipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favoris_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavorisEquipeRepository $favorisEquipeRepository): Response
    {
        $favorisEquipe = new FavorisEquipe();
        $form = $this->createForm(FavorisEquipeType::class, $favorisEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisEquipeRepository->save($favorisEquipe, true);

            return $this->redirectToRoute('app_favoris_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris_equipe/new.html.twig', [
            'favoris_equipe' => $favorisEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_equipe_show', methods: ['GET'])]
    public function show(FavorisEquipe $favorisEquipe): Response
    {
        return $this->render('favoris_equipe/show.html.twig', [
            'favoris_equipe' => $favorisEquipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favoris_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FavorisEquipe $favorisEquipe, FavorisEquipeRepository $favorisEquipeRepository): Response
    {
        $form = $this->createForm(FavorisEquipeType::class, $favorisEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisEquipeRepository->save($favorisEquipe, true);

            return $this->redirectToRoute('app_favoris_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris_equipe/edit.html.twig', [
            'favoris_equipe' => $favorisEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, FavorisEquipe $favorisEquipe, FavorisEquipeRepository $favorisEquipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favorisEquipe->getId(), $request->request->get('_token'))) {
            $favorisEquipeRepository->remove($favorisEquipe, true);
        }

        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }
}
