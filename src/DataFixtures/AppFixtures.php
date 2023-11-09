<?php

namespace App\DataFixtures;

use App\Entity\Pole;
use App\Entity\User;
use App\Entity\IndexPole;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $poleIndexData = $poleIndexData = [
            'Cabinet' => [
                "Cabinet du Maire" => "cabinet-du-maire",
                "Direction de la Communication" => "direction-de-la-communication",
                "Mission Roubaix Lumières" => "mission-roubaix-lumieres",
            ],
            'Direction générale des services' => [
                "Mission d'Appui Stratégique" => "mission-dappui-strategique",
                "Mission Développement Durable et Zéro Déchet" => "mission-developpement-durable",
            ],
            'Pôle rayonnement et vitalité de la ville' => [
                "Direction de la Culture" => "direction-de-la-culture",
                "Direction des Sports" => "direction-des-sports",
                "Direction de la Jeunesse" => "direction-de-la-jeunesse",
                "Direction du Développement Economique, de l’Insertion, de l’Emploi et de l’Enseignement supérieur" => "developpement-economique",
                "Mission Economie Circulaire" => "economie-circulaire",
                "Mission Parc des Sports" => "parc-des-sports",
            ],
            'Pôle enfance et famille' => [
                "Direction de la Petite Enfance" => "petite-enfance",
                "Direction de l’Enfance" => "enfance",
                "Mission Centres Sociaux" => "centres-sociaux",
            ],
            'Pôle coordination et ressources' => [
                "Secrétariat Général" => "secretariat-general",
                "Direction des Systèmes d’Information" => "systemes-information",
                "Direction des Ressources Humaines" => "ressources-humaines",
                "Direction des Finances et du Contrôle de Gestion" => "finances-controle-gestion",
                "Direction de la Commande Publique et des Affaires Juridiques" => "commande-publique",
                "Service Suivi et Accompagnement des Associations" => "suivi-associations",
            ],
            'Pôle aménagement de la ville et bâtiments' => [
                "Direction Habitat et Hygiène" => "habitat-hygiene",
                "Direction Immobilier et Urbanisme" => "immobilier-urbanisme",
                "Direction des Grands Projets Urbains" => "grands-projets-urbains",
                "Direction de l’Aménagement et des Constructions Publiques" => "amenagement-constructions-publiques",
                "Direction de la Maintenance, Performance Bâtimentaire" => "maintenance-batimentaire",
                "Direction de l’Espace Public et des Mobilités" => "espace-public-mobilites",
                "Mission Grand Boulevard, Centre-ville" => "mission-centre-ville",
                "Mission Canal-Union-La Lainière" => "mission-canal-union-lainiere",
            ],
            'Pôle proximité et citoyenneté' => [
                "Direction des Démarches Administratives" => "demarches-administratives",
                "Direction de la Mairie des Quartiers Est" => "mairie-quartiers-est",
                "Direction de la Mairie des Quartiers Ouest" => "mairie-quartiers-ouest",
                "Direction de la Mairie des Quartiers Nord" => "mairie-quartiers-nord",
                "Direction de la Mairie des Quartiers Sud" => "mairie-quartiers-sud",
                "Direction de la Mairie des Quartiers Centre" => "mairie-quartiers-centre",
                "Direction de la Coordination des Mairies de Quartier, de la Politique de la Ville et de la Participation citoyenne" => "coordination-mairies-quartier",
                "Mission Gestion Urbaine et Sociale de Proximité" => "gestion-urbaine-sociale",
            ],
            'Pôle sécurité et qualité de vie' => [
                "Direction de la Propreté Urbaine" => "proprete-urbaine",
                "Direction de la Prévention, de la Sécurité et de la Tranquillité Publique" => "securite-tranquillite-publique",
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

        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('admin');

        $manager->persist($user);
        $manager->flush();
    }
}
