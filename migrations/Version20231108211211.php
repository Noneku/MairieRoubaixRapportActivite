<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108211211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite ADD indicateur_file_name LONGTEXT DEFAULT NULL, ADD realisation_file_name LONGTEXT DEFAULT NULL, ADD perspective_file_name LONGTEXT DEFAULT NULL, DROP indicateur_file, DROP realisation_file, DROP perspective_file');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite ADD indicateur_file LONGTEXT DEFAULT NULL, ADD realisation_file LONGTEXT DEFAULT NULL, ADD perspective_file LONGTEXT DEFAULT NULL, DROP indicateur_file_name, DROP realisation_file_name, DROP perspective_file_name');
    }
}
