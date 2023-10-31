<?php

namespace App\Controller;

use App\Entity\IndexPole;
use App\Service\UrlChecker;
use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use App\Service\WordDocumentGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RapportActiviteController extends AbstractController
{
    

    #[Route('/', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, WordDocumentGenerator $wordDocumentGenerator): Response
    {
        $rapportActivite = new RapportActivite();
        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file uploads if needed
            $indicateurFile = $form->get('indicateurFile')->getData();
            $realisationFile = $form->get('realisationFile')->getData();
            $perspectiveFile = $form->get('perspectiveFile')->getData();

            // Persist the RapportActivite entity
            $entityManager->persist($rapportActivite);
            $entityManager->flush();

            // Generate the Word document using the WordDocumentGenerator service
            $wordFile = $wordDocumentGenerator->generateDocument($rapportActivite, $indicateurFile, $realisationFile, $perspectiveFile);

            // Handle the response, for example, you can send the file as a download
            $response = new Response(file_get_contents($wordFile));
            $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $response->headers->set('Content-Disposition', 'attachment; filename="rapport_activite.docx"');

            // Clean up temporary files
            unlink($wordFile);

            return $response;
        }

        return $this->render('rapport_activite/index.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form->createView(),
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
    public function edit(Request $request, EntityManagerInterface $entityManager, $id, WordDocumentGenerator $wordDocumentGenerator): Response
    {
        // $rapportActivite = $session->get('rapportActivite');
        $rapportActivite = $entityManager->getRepository(RapportActivite::class)->find($id);


        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             // Handle file uploads if needed
             $indicateurFile = $form->get('indicateurFile')->getData();
             $realisationFile = $form->get('realisationFile')->getData();
             $perspectiveFile = $form->get('perspectiveFile')->getData();
 
             // Persist the RapportActivite entity
             $entityManager->persist($rapportActivite);
             $entityManager->flush();
 
             // Generate the Word document using the WordDocumentGenerator service
             $wordFile = $wordDocumentGenerator->generateDocument($rapportActivite, $indicateurFile, $realisationFile, $perspectiveFile);
 
             // Handle the response, for example, you can send the file as a download
             $response = new Response(file_get_contents($wordFile));
             $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
             $response->headers->set('Content-Disposition', 'attachment; filename="rapport_activite.docx"');
 
             // Clean up temporary files
             unlink($wordFile);
 
             return $response;

        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapportActivite' => $rapportActivite,
            'form' => $form,
        ]);
    }
}
