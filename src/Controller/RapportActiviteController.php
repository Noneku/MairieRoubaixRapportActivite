<?php

namespace App\Controller;

use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RapportActiviteController extends AbstractController
{

    #[Route('/', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapportActivite = new RapportActivite();
        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rapportActivite);
            $entityManager->flush();
        }

        return $this->render('rapport_activite/index.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rapport_activite_show', methods: ['GET'])]
    public function show(RapportActivite $rapportActivite): Response
    {
        return $this->render('rapport_activite/show.html.twig', [
            'rapport_activite' => $rapportActivite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rapport_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RapportActivite $rapportActivite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // return $this->redirectToRoute('app_rapport_activite_index', [], Response::HTTP_SEE_OTHER);

            return var_dump('test');
        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form,
        ]);
    }
}
