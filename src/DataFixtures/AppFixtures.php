<?php

namespace App\DataFixtures;

use App\Entity\IndexPole;
use App\Entity\Pole;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $poleIndexData = $poleIndexData = [
            'Cabinet' => [
                "Cabinet du Maire" => "https://exemple.com/cabinet-du-maire",
                "Direction de la Communication" => "https://exemple.com/direction-de-la-communication",
                "Mission Roubaix Lumières" => "https://exemple.com/mission-roubaix-lumieres",
            ],
            'Direction générale des services' => [
                "Mission d'Appui Stratégique" => "https://exemple.com/mission-dappui-strategique",
                "Mission Développement Durable et Zéro Déchet" => "https://exemple.com/mission-developpement-durable",
            ],
            'Pôle rayonnement et vitalité de la ville' => [
                "Direction de la Culture" => "https://exemple.com/direction-de-la-culture",
                "Direction des Sports" => "https://exemple.com/direction-des-sports",
                "Direction de la Jeunesse" => "https://exemple.com/direction-de-la-jeunesse",
                "Direction du Développement Economique, de l’Insertion, de l’Emploi et de l’Enseignement supérieur" => "https://exemple.com/developpement-economique",
                "Mission Economie Circulaire" => "https://exemple.com/economie-circulaire",
                "Mission Parc des Sports" => "https://exemple.com/parc-des-sports",
            ],
            'Pôle enfance et famille' => [
                "Direction de la Petite Enfance" => "https://exemple.com/petite-enfance",
                "Direction de l’Enfance" => "https://exemple.com/enfance",
                "Mission Centres Sociaux" => "https://exemple.com/centres-sociaux",
            ],
            'Pôle coordination et ressources' => [
                "Secrétariat Général" => "https://exemple.com/secretariat-general",
                "Direction des Systèmes d’Information" => "https://exemple.com/systemes-information",
                "Direction des Ressources Humaines" => "https://exemple.com/ressources-humaines",
                "Direction des Finances et du Contrôle de Gestion" => "https://exemple.com/finances-controle-gestion",
                "Direction de la Commande Publique et des Affaires Juridiques" => "https://exemple.com/commande-publique",
                "Service Suivi et Accompagnement des Associations" => "https://exemple.com/suivi-associations",
            ],
            'Pôle aménagement de la ville et bâtiments' => [
                "Direction Habitat et Hygiène" => "https://exemple.com/habitat-hygiene",
                "Direction Immobilier et Urbanisme" => "https://exemple.com/immobilier-urbanisme",
                "Direction des Grands Projets Urbains" => "https://exemple.com/grands-projets-urbains",
                "Direction de l’Aménagement et des Constructions Publiques" => "https://exemple.com/amenagement-constructions-publiques",
                "Direction de la Maintenance, Performance Bâtimentaire" => "https://exemple.com/maintenance-batimentaire",
                "Direction de l’Espace Public et des Mobilités" => "https://exemple.com/espace-public-mobilites",
                "Mission Grand Boulevard, Centre-ville" => "https://exemple.com/mission-centre-ville",
                "Mission Canal-Union-La Lainière" => "https://exemple.com/mission-canal-union-lainiere",
            ],
            'Pôle proximité et citoyenneté' => [
                "Direction des Démarches Administratives" => "https://exemple.com/demarches-administratives",
                "Direction de la Mairie des Quartiers Est" => "https://exemple.com/mairie-quartiers-est",
                "Direction de la Mairie des Quartiers Ouest" => "https://exemple.com/mairie-quartiers-ouest",
                "Direction de la Mairie des Quartiers Nord" => "https://exemple.com/mairie-quartiers-nord",
                "Direction de la Mairie des Quartiers Sud" => "https://exemple.com/mairie-quartiers-sud",
                "Direction de la Mairie des Quartiers Centre" => "https://exemple.com/mairie-quartiers-centre",
                "Direction de la Coordination des Mairies de Quartier, de la Politique de la Ville et de la Participation citoyenne" => "https://exemple.com/coordination-mairies-quartier",
                "Mission Gestion Urbaine et Sociale de Proximité" => "https://exemple.com/gestion-urbaine-sociale",
            ],
            'Pôle sécurité et qualité de vie' => [
                "Direction de la Propreté Urbaine" => "https://exemple.com/proprete-urbaine",
                "Direction de la Prévention, de la Sécurité et de la Tranquillité Publique" => "https://exemple.com/securite-tranquillite-publique",
            ],
        ];
        
        //FIXTURE ENTITY POLE
            foreach ($poleIndexData as $key => $indexNom) {
            $pole = new Pole();
            $pole->setPoleName($key);
            $manager->persist($pole);
            //FIXTURE ENTITY INDEXPOL
                foreach ($indexNom as $key => $value) {
                    $index = new IndexPole();
                    $index->setPole($pole);
                    $index->setIndexName($key);
                    $index->setUrlIndex($value);

                    $manager->persist($index);
                }
                //Flush in DataBase IndexPole
                $manager->flush();
            }
        //Flush in DataBase Pole
        $manager->flush();
    }
}
