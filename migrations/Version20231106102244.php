<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106102244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE index_pole DROP FOREIGN KEY FK_56E09AB2BCA476D7');
        $this->addSql('DROP INDEX IDX_56E09AB2BCA476D7 ON index_pole');
        $this->addSql('ALTER TABLE index_pole DROP rapport_activite_id');
        $this->addSql('ALTER TABLE rapport_activite ADD url_index_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_activite ADD CONSTRAINT FK_6CB5B597E6531CE8 FOREIGN KEY (url_index_id) REFERENCES index_pole (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CB5B597E6531CE8 ON rapport_activite (url_index_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE index_pole ADD rapport_activite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE index_pole ADD CONSTRAINT FK_56E09AB2BCA476D7 FOREIGN KEY (rapport_activite_id) REFERENCES rapport_activite (id)');
        $this->addSql('CREATE INDEX IDX_56E09AB2BCA476D7 ON index_pole (rapport_activite_id)');
        $this->addSql('ALTER TABLE rapport_activite DROP FOREIGN KEY FK_6CB5B597E6531CE8');
        $this->addSql('DROP INDEX UNIQ_6CB5B597E6531CE8 ON rapport_activite');
        $this->addSql('ALTER TABLE rapport_activite DROP url_index_id');
    }
}
