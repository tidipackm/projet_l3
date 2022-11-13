<?php

namespace App\Controller;

use App\Entity\Championnat;
use App\Entity\FavorisEquipe;
use App\Repository\ChampionnatRepository;
use App\Repository\EquipeRepository;
use App\Repository\FavorisEquipeRepository;
use App\Repository\PalmaresRepository;
use Container7aUBWZI\getDoctrine_UlidGeneratorService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\FavorisEquipeType;



#[Route('/ficheEquipe', name: 'ficheEquipe_')]
class FicheEquipeController extends AbstractController
{
    #[Route('/', name: 'fiche')]
    public function ficheEquipe(EquipeRepository $equipe, PalmaresRepository $palmares, FavorisEquipeRepository $favorisEquipe): Response{
        $idEquipe = $_GET['id'];
    
    
    
        return $this->render('ficheEquipe/ficheEquipe.html.twig',['palmares' =>$palmares->findAll(), 'idEquipe' => $idEquipe, 'equipe' => $equipe->findAll(), 'favorisEquipe' => $favorisEquipe->findAll()]);
    
    
    }

    #[Route('/ajoutFavoris', name: 'ajouterFavoris')]
    public function ajouterFavoris(Request $request, ManagerRegistry $doctrine, EquipeRepository $equipe, PalmaresRepository $palmares, FavorisEquipeRepository $favorisEquipe) {
        $idEquipe = $_GET['id'];
        $idEquipeFav = $_GET['idEquipe'];
        $idUserFav = $_GET['idUser'];

        
        $entityManager = $doctrine->getManager();
        
        $newFavorisEquipe = new FavorisEquipe();
        $newFavorisEquipe->setIdEquipe($idEquipeFav);
        $newFavorisEquipe->setIdUser($idUserFav);

        $entityManager->persist($newFavorisEquipe);
        $entityManager->flush();

        return $this->render('ficheEquipe/ficheEquipe.html.twig',['palmares' =>$palmares->findAll(), 'idEquipe' => $idEquipe, 'equipe' => $equipe->findAll(), 'favorisEquipe' => $favorisEquipe->findAll()]);

    }


    //#[Route('/supprimerFavoris', name: 'supprimerFavoris')]
    //public function supprimer(FavorisEquipe $favorisEquipe, ManagerRegistry $doctrine)
    //{
      //  $id = $_GET['id'];
        //foreach ($favorisEquipe as $clef){
          //  if ($clef->getid() == $id){
            //    FavorisEquipe $favEquipe =  
              //  $em = $doctrine->getManager();
                //$em->remove($favorisEquipe);
                //$em->flush();
           // }
        //}

        //$this->addFlash('message', 'Equipe supprimée des favoris avec succès');
        //return new Response('Equipe supprimée des favoris');        
    //}

    #[Route('/{id}', name: 'supprimerFavoris', methods: ['POST'])]
    public function delete(Request $request, FavorisEquipe $favorisEquipe, FavorisEquipeRepository $favorisEquipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favorisEquipe->getId(), $request->request->get('_token'))) {
            $favorisEquipeRepository->remove($favorisEquipe, true);
        }

        return $this->redirectToRoute('ficheEquipe/ficheEquipe.html.twig', [], Response::HTTP_SEE_OTHER);
    }
}
