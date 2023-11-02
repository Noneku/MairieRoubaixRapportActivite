<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorUrlNotFoundController extends AbstractController
{
    #[Route('/error_url', name: 'app_error_url')]
    public function index(): Response
    {
        return $this->render('error_url_not_found/index.html.twig', [
            'controller_name' => 'ErrorUrlNotFoundController',
        ]);
    }
}
