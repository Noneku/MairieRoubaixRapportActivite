<?php

namespace App\Controller;

use App\Entity\IndexPole;
use App\Service\UrlChecker;
use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use App\Repository\IndexPoleRepository;
use App\Service\WordDocumentGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class RapportActiviteController extends AbstractController
{   
    
    #[Route('/{url}', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, WordDocumentGenerator $wordDocumentGenerator,IndexPoleRepository $indexPoleRepository ,$url): Response
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

            // Donwload the file to format .docx
            $responseFile = new Response(file_get_contents($wordFile));
            $responseFile->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $responseFile->headers->set('Content-Disposition', "attachment; filename=rapport_activite_{$url}.docx");

            // Clean up temporary files
            unlink($wordFile);

            return $responseFile;
            
        // $responseRedirect = new Response($this->redirectToRoute('app_rapport_activite_edit', [
        //          'id' => $rapportActivite->getId(),
        //          'url' => $url
        //      ]));
        }
        
        return $this->render('rapport_activite/index.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form->createView(),
            'urlIndex' => $url
        ]);
    }

    #[Route('/{url}/{id}/edit', name: 'app_rapport_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, $id, WordDocumentGenerator $wordDocumentGenerator): Response
    {
        //Get ID of rapportActivite and compare this with parameter in URL 
        $rapportActivite = $entityManager->getRepository(RapportActivite::class)->find($id);


        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             // Handle file uploads if needed
             $indicateurFile = $form->get('indicateurFile')->getData();
             $realisationFile = $form->get('realisationFile')->getData();
             $perspectiveFile = $form->get('perspectiveFile')->getData();
 
             // Persist the RapportActivite entity
             $rapportActivite->setStatus('Terminer');
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
        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapportActivite' => $rapportActivite,
            'form' => $form,
        ]);
    }
}
