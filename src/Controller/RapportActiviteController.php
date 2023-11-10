<?php

namespace App\Controller;

use DateTime;
use App\Entity\IndexPole;
use App\Entity\RapportActivite;
use App\Form\RapportActiviteType;
use Vich\UploaderBundle\Entity\File;
use App\Service\WordDocumentGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RapportActiviteController extends AbstractController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    #[Route('/{url}', name: 'app_rapport_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $url): Response
    {
        $rapportActivite = new RapportActivite();
        $indexPoleRepository = $entityManager->getRepository(IndexPole::class);
        $indexPole = $indexPoleRepository->findOneBySomeField($url);


        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $indicateurFile = $form->get('indicateurFile')->getData();

            if ($indicateurFile instanceof File) {
                echo ("yes");
            }

            // Persist the RapportActivite entity
            $rapportActivite->setUrlIndex($indexPole);
            $rapportActivite->setDate(new DateTime());
            $entityManager->persist($rapportActivite);
            $entityManager->flush();

            //Return to edit page before to push in database
            return $this->redirectToRoute('app_rapport_activite_edit', [
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
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        $id,
        $url,
        WordDocumentGenerator $wordDocumentGenerator
    ): Response {
        // Get ID of RapportActivite and compare this with the parameter in the URL
        $rapportActivite = $entityManager->getRepository(RapportActivite::class)->find($id);

        $form = $this->createForm(RapportActiviteType::class, $rapportActivite);
        $form->handleRequest($request);

        // Handle file uploads if needed
        $indicateurFile = $rapportActivite->getIndicateurFile();
        $realisationFile = $rapportActivite->getRealisationFile();
        $perspectiveFile = $rapportActivite->getPerspectiveFile();

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Specify the directory in the public folder
                $publicDirectory = $this->params->get('kernel.project_dir') . '/public/';
                $wordDocumentPath = 'uploads/word_files/'; // Adjust the path as needed

                // Generate the Word document using the WordDocumentGenerator service
                $wordDocument = $wordDocumentGenerator->generateDocument(
                    $rapportActivite,
                    $indicateurFile,
                    $realisationFile,
                    $perspectiveFile,
                    $publicDirectory . $wordDocumentPath
                );

                // Load the generated Word document into PHPWord
                $phpWordDocument = $wordDocumentGenerator->loadDocument($publicDirectory . $wordDocument);

                // Set properties for RapportActivite entity
                $rapportActivite->setRapportActiviteFile($phpWordDocument);
                $rapportActivite->setRapportActiviteFileName(
                    'rapport_activite_N°' . $rapportActivite->getId() . '.docx'
                );
                $rapportActivite->setStatus('Terminer');

                // Persist the RapportActivite entity
                $entityManager->persist($rapportActivite);
                $entityManager->flush();

                // Create a response with the file for download
                $responseFile = new Response(file_get_contents($publicDirectory . $wordDocument));
                $responseFile->headers->set(
                    'Content-Type',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                );
                $responseFile->headers->set(
                    'Content-Disposition',
                    'attachment; filename="rapport_activite_N°' . $rapportActivite->getId() . '.docx"'
                );

                // Clean up temporary files
                // unlink($publicDirectory . $wordDocument);

                return $responseFile;
            } catch (\Exception $e) {
                // Handle exceptions, log, and provide appropriate response
                return new Response('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return $this->render('rapport_activite/edit.html.twig', [
            'rapportActivite' => $rapportActivite,
            'form' => $form,
            'urlIndex' => $url
        ]);
    }
}
