<?php

namespace App\Controller\Admin;

use App\Entity\RapportActivite;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
            TextField::new('status', 'Etat'),
            DateTimeField::new('date')
                ->setFormat('dd-MM-Y HH:mm')
                ->setFormTypeOption('disabled', true),
            AssociationField::new('urlIndex'),

            // TextEditorField::new('indicateurFileName', 'Indicateur File')
            // ->setTemplatePath('admin/indicateur_file_widget.html.twig')
            // ->hideOnForm(),

            TextEditorField::new('indicateurFileName', 'Indicateur File')
                ->setTemplatePath('admin/indicateur_file_widget.html.twig')
                ->hideOnForm(),

            TextEditorField::new('realisationFileName', 'Realisation File')
                ->setTemplatePath('admin/realisation_file_widget.html.twig')
                ->hideOnForm(),

            TextEditorField::new('perspectiveFileName', 'Perspective File')
                ->setTemplatePath('admin/perspective_file_widget.html.twig')
                ->hideOnForm(),

            TextEditorField::new('rapportActiviteFileName', 'Rapport File')
            ->setTemplatePath('admin/rapportActivite_file_widget.html.twig')
            ->hideOnForm()
        ];
    }
}
