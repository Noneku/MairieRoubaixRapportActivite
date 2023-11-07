<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106104415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite DROP INDEX UNIQ_6CB5B597E6531CE8, ADD INDEX IDX_6CB5B597E6531CE8 (url_index_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport_activite DROP INDEX IDX_6CB5B597E6531CE8, ADD UNIQUE INDEX UNIQ_6CB5B597E6531CE8 (url_index_id)');
    }
}
