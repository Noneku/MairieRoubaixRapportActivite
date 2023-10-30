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
    #[Route('/', name: 'app_rapport_activite')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $rapport = new RapportActivite();
        $form = $this->createForm(RapportActiviteType::class, $rapport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rapport);
            $entityManager->flush();

            // return $this->redirectToRoute('page_de_confirmation');
        }

        return $this->render('rapport_activite/index.html.twig', [
            'controller_name' => 'RapportActiviteController',
            'form' => $form
        ]);
    }
}
