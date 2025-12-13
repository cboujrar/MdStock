<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520210110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D95767F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_159D95767F2DEE08 ON bon_commande (facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D95767F2DEE08');
        $this->addSql('DROP INDEX UNIQ_159D95767F2DEE08 ON bon_commande');
        $this->addSql('ALTER TABLE bon_commande DROP facture_id');
    }
}
