<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508193215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_sortie ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_sortie ADD CONSTRAINT FK_2843ABC87F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2843ABC87F2DEE08 ON bon_sortie (facture_id)');
        $this->addSql('ALTER TABLE facture ADD mode_paiment_id INT DEFAULT NULL, DROP mode_paiement');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410BDA57703 FOREIGN KEY (mode_paiment_id) REFERENCES mode_paiment (id)');
        $this->addSql('CREATE INDEX IDX_FE866410BDA57703 ON facture (mode_paiment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_sortie DROP FOREIGN KEY FK_2843ABC87F2DEE08');
        $this->addSql('DROP INDEX UNIQ_2843ABC87F2DEE08 ON bon_sortie');
        $this->addSql('ALTER TABLE bon_sortie DROP facture_id');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410BDA57703');
        $this->addSql('DROP INDEX IDX_FE866410BDA57703 ON facture');
        $this->addSql('ALTER TABLE facture ADD mode_paiement VARCHAR(100) NOT NULL, DROP mode_paiment_id');
    }
}
