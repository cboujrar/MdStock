<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506221413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_sortie DROP FOREIGN KEY FK_2843ABC87E86E7F');
        $this->addSql('DROP INDEX IDX_2843ABC87E86E7F ON bon_sortie');
        $this->addSql('ALTER TABLE bon_sortie DROP id_dbs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_sortie ADD id_dbs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_sortie ADD CONSTRAINT FK_2843ABC87E86E7F FOREIGN KEY (id_dbs_id) REFERENCES detail_bon_sortie (id)');
        $this->addSql('CREATE INDEX IDX_2843ABC87E86E7F ON bon_sortie (id_dbs_id)');
    }
}
