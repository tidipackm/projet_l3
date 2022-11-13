<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Form\ChampionnatType;
use App\Repository\ChampionnatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/championnat', name: 'championnatController_')]
class ChampionnatController extends AbstractController
{
    #[Route('/', name: 'app_championnat_index', methods: ['GET'])]
    public function index(ChampionnatRepository $championnatRepository): Response
    {
        return $this->render('championnat/index.html.twig', [
            'championnats' => $championnatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_championnat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChampionnatRepository $championnatRepository): Response
    {
        $championnat = new Championnat();
        $form = $this->createForm(ChampionnatType::class, $championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $championnatRepository->save($championnat, true);

            return $this->redirectToRoute('championnatController_app_championnat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('championnat/new.html.twig', [
            'championnat' => $championnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_championnat_show', methods: ['GET'])]
    public function show(Championnat $championnat): Response
    {
        return $this->render('championnat/show.html.twig', [
            'championnat' => $championnat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_championnat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Championnat $championnat, ChampionnatRepository $championnatRepository): Response
    {
        $form = $this->createForm(ChampionnatType::class, $championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $championnatRepository->save($championnat, true);

            return $this->redirectToRoute('championnatController_app_championnat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('championnat/edit.html.twig', [
            'championnat' => $championnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_championnat_delete', methods: ['POST'])]
    public function delete(Request $request, Championnat $championnat, ChampionnatRepository $championnatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$championnat->getId(), $request->request->get('_token'))) {
            $championnatRepository->remove($championnat, true);
        }

        return $this->redirectToRoute('championnatController_app_championnat_index', [], Response::HTTP_SEE_OTHER);
    }
}
