<?php

namespace App\Form;

use App\Entity\RapportActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RapportActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('missionPrincipale', TextareaType::class, [
                'label' => 'Mission Principale'
            ])
            ->add('indicateur', TextareaType::class, [
                'label' => 'Indicateur'
            ])
            ->add('realisation', TextareaType::class, [
                'label' => 'Réalisation'
            ])
            ->add('perspective', TextareaType::class, [
                'label' => 'Perspective'
            ])
            ->add('donneesFinance', TextareaType::class, [
                'label' => 'Données Finances'
            ])
            ->add('donneesRH', TextareaType::class, [
                'label' => 'Données Ressources Humaines'
            ])
            ->add('indicateurFile', FileType::class, [
                'required' => false,
                'label' => 'Fichier pour Indicateur'
            ])
            ->add('realisationFile', FileType::class, [
                'required' => false, // Permet de rendre le champ facultatif
                'label' => 'Fichier pour Réalisation', // Label personnalisé
            ])
            ->add('perspectiveFile', FileType::class, [
                'required' => false, // Permet de rendre le champ facultatif
                'label' => 'Fichier pour Perspective', // Label personnalisé
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RapportActivite::class,
        ]);
    }
}
