<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108205038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite CHANGE indicateur_file indicateur_file LONGTEXT DEFAULT NULL, CHANGE realisation_file realisation_file LONGTEXT DEFAULT NULL, CHANGE perspective_file perspective_file LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite CHANGE indicateur_file indicateur_file LONGBLOB DEFAULT NULL, CHANGE realisation_file realisation_file LONGBLOB DEFAULT NULL, CHANGE perspective_file perspective_file LONGBLOB DEFAULT NULL');
    }
}
