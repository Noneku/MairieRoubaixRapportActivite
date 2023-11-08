<?php

namespace App\Controller;

use App\Entity\IndexPole;
use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use App\Service\WordDocumentGenerator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Vich\UploaderBundle\Handler\UploadHandler;

class RapportActiviteController extends AbstractController
{   
    
    #[Route('/{url}', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $url): Response
    {
        $rapportActivite = new RapportActivite();
        $indexPoleRepository = $entityManager->getRepository(IndexPole::class);
        $indexPole = $indexPoleRepository->findOneBySomeField($url);


        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Persist the RapportActivite entity
            $rapportActivite->setUrlIndex($indexPole);
            $rapportActivite->setDate(new DateTime());
            $entityManager->persist($rapportActivite);
            $entityManager->flush();
            
        //Return to edit page before to push in database
        return $this->redirectToRoute('app_rapport_activite_edit',[
            'id' => $rapportActivite->getId(),
            'url' => $url
        ], Response::HTTP_SEE_OTHER);
        }
        

        return $this->render('rapport_activite/index.html.twig', [
            'rapport_activite' => $rapportActivite,
            'form' => $form->createView(),
            'urlIndex' => $url,
        ]);
    }

    #[Route('/{url}/{id}/edit', name: 'app_rapport_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, $id, $url, WordDocumentGenerator $wordDocumentGenerator): Response
    {
        //Get ID of rapportActivite and compare this with parameter in URL 
        $rapportActivite = $entityManager->getRepository(RapportActivite::class)->find($id);
        

        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);
        
        // Handle file uploads if needed
        $indicateurFile = $rapportActivite->getIndicateurFile();
        $realisationFile = $rapportActivite->getRealisationFile();
        $perspectiveFile = $rapportActivite->getPerspectiveFile();

        if ($form->isSubmitted() && $form->isValid()) {

            
             // Persist the RapportActivite entity
             $rapportActivite->setStatus('Terminer');
             $entityManager->persist($rapportActivite);
             $entityManager->flush();
 
             // Generate the Word document using the WordDocumentGenerator service
             $wordFile = $wordDocumentGenerator->generateDocument($rapportActivite, $indicateurFile, $realisationFile, $perspectiveFile);
 
             // Handle the response, for example, you can send the file as a download
             $responseFile = new Response(file_get_contents($wordFile));
             $responseFile->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
             $responseFile->headers->set('Content-Disposition', 'attachment; filename="rapport_activite_N°' . $rapportActivite->getId() .".docx");
 
            // Clean up temporary files
             unlink($wordFile);

             return $responseFile;
        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapportActivite' => $rapportActivite,
            'form' => $form,
            'urlIndex' => $url
        ]);
    }
}