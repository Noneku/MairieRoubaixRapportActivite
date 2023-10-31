<?php

namespace App\Controller\Admin;

use App\Entity\RapportActivite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RapportActiviteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RapportActivite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('mission_principale'),
            TextEditorField::new('description'),
        ];
    }
    
}
