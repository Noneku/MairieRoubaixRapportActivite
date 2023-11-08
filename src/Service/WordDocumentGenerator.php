<?php

namespace App\Service;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class WordDocumentGenerator
{
    public function generateDocument($rapportActivite, $indicateurFile, $realisationFile, $perspectiveFile)
    {
        // Initialisation de PHPWord
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Ajout de contenu au document
        $section->addText('Rapport d\'activité');
        $section->addText('Mission Principale: ' . $rapportActivite->getMissionPrincipale());
        $section->addText('Indicateur: ' . $rapportActivite->getIndicateur());
        $section->addText('Réalisation: ' . $rapportActivite->getRealisation());
        $section->addText('Perspective: ' . $rapportActivite->getPerspective());

        // Génération du document Word
        $filename = 'rapport_activite_'. $rapportActivite->getId() . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);

        return $filename;
    }
}
