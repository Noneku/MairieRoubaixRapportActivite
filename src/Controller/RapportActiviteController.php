<?php

namespace App\Controller;

use App\Entity\IndexPole;
use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use App\Service\UrlChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RapportActiviteController extends AbstractController
{
    

    #[Route('/', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {


        $rapportActivite = new RapportActivite();

        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($rapportActivite);
            $entityManager->flush();

            //Return to edit page before to push in database
            return $this->redirectToRoute('app_rapport_activite_edit', ['id' => $rapportActivite->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rapport_activite/index.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_rapport_activite_show', methods: ['GET'])]
    // public function show(RapportActivite $rapportActivite): Response
    // {
    //     return $this->render('rapport_activite/show.html.twig', [
    //         'rapport_activite' => $rapportActivite,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_rapport_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, $id): Response
    {
        // $rapportActivite = $session->get('rapportActivite');
        $rapportActivite = $entityManager->getRepository(RapportActivite::class)->find($id);


        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($rapportActivite);
            $entityManager->flush();

            //Clear the session variable 'rapportActivite'
            $session->remove('rapportActivite');
        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapportActivite' => $rapportActivite,
            'form' => $form,
        ]);
    }
}
