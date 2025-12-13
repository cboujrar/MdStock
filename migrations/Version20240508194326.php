<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508194326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D95767F2DEE08 FOREIGN KEY (facture_id) REFERENCES bon_commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_159D95767F2DEE08 ON bon_commande (facture_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664107BC6D6CF');
        $this->addSql('DROP INDEX UNIQ_FE8664107BC6D6CF ON facture');
        $this->addSql('ALTER TABLE facture DROP id_bc_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D95767F2DEE08');
        $this->addSql('DROP INDEX UNIQ_159D95767F2DEE08 ON bon_commande');
        $this->addSql('ALTER TABLE bon_commande DROP facture_id');
        $this->addSql('ALTER TABLE facture ADD id_bc_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664107BC6D6CF FOREIGN KEY (id_bc_id) REFERENCES bon_commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE8664107BC6D6CF ON facture (id_bc_id)');
    }
}
