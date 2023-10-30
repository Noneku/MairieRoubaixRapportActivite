<?php

namespace App\Form;

use App\Entity\RapportActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RapportActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('missionPrincipale')
            ->add('indicateur')
            ->add('realisation')
            ->add('perspective')
            ->add('donneesFinance')
            ->add('donneesRH')
            ->add('status')
            ->add('indicateurFile', FileType::class, [
                'required' => false, // Permet de rendre le champ facultatif
                'label' => 'Fichier pour Indicateur', // Label personnalisé
            ])
            ->add('realisationFile', FileType::class, [
                'required' => false, // Permet de rendre le champ facultatif
                'label' => 'Fichier pour Réalisation', // Label personnalisé
            ])
            ->add('perspectiveFile', FileType::class, [
                'required' => false, // Permet de rendre le champ facultatif
                'label' => 'Fichier pour Perspective', // Label personnalisé
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RapportActivite::class,
        ]);
    }
}
