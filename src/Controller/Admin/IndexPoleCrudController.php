<?php

namespace App\Controller\Admin;

use App\Entity\IndexPole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IndexPoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return IndexPole::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('indexName'),
            TextField::new('urlIndex')
        ];
    }
}
