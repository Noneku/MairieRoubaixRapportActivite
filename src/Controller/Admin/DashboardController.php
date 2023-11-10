<?php

namespace App\Controller\Admin;

use App\Entity\Pole;
use App\Entity\IndexPole;
use App\Controller\Admin\PoleCrudController;
use App\Entity\RapportActivite;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        
        return $this->redirect($adminUrlGenerator->setController(PoleCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mairie-Roubaix');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // Créez une section "Gestion des Entités" pour organiser vos éléments de menu
        yield MenuItem::section('Gestion des Entités');

        // Ajoutez des liens vers vos contrôleurs CRUD pour les entités "Pole" et "IndexPole"
        yield MenuItem::linkToCrud('Poles', 'fa fa-tags', Pole::class);
        yield MenuItem::linkToCrud('IndexPole', 'fa fa-tags', IndexPole::class);
        yield MenuItem::linkToCrud('Rapport-Activté', 'fa fa-tags', RapportActivite::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa fa-tags', User::class);

        // Vous pouvez ajouter d'autres éléments de menu ici
    }
}
