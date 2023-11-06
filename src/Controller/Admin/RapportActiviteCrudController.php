<?php

namespace App\Controller\Admin;

use App\Entity\IndexPole;
use App\Entity\RapportActivite;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RapportActiviteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RapportActivite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('mission_principale'),
            // TextField::new('missionPrincipale'),
            // TextField::new('indicateur'),
            // TextField::new('realisation'),
            // TextField::new('perspective'),
            // TextField::new('donneesFinance'),
            // TextField::new('donneesRH'),
            TextField::new('status'),
            AssociationField::new('urlIndex')
        ];
    }
    
}
