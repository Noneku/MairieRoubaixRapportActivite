<?php

namespace App\Service;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class WordDocumentGenerator
{
    public function generateDocument($rapportActivite, $indicateurFile, $realisationFile, $perspectiveFile)
    {
        // Initializing PHPWord
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Adding content to the document
        $section->addText('Rapport d\'activité');
        $section->addText('Mission Principale: ' . $rapportActivite->getMissionPrincipale());
        $section->addText('Indicateur: ' . $rapportActivite->getIndicateur());
        $section->addText('Réalisation: ' . $rapportActivite->getRealisation());
        $section->addText('Perspective: ' . $rapportActivite->getPerspective());

        // Generating the Word document
        $filename = 'rapportDownload/rapport_activite_'. $rapportActivite->getId() .'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);

        return $filename;
    }

    public function loadDocument($wordFilePath)
    {
        return IOFactory::load($wordFilePath);
    }
}
