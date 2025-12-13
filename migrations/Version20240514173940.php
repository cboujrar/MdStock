<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514173940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D957657F139E0');
        $this->addSql('DROP INDEX IDX_159D957657F139E0 ON bon_commande');
        $this->addSql('ALTER TABLE bon_commande DROP id_dbc_id');
        $this->addSql('ALTER TABLE detail_bon_commande ADD bon_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_bon_commande ADD CONSTRAINT FK_99EFF79B4B54061 FOREIGN KEY (bon_commande_id) REFERENCES bon_commande (id)');
        $this->addSql('CREATE INDEX IDX_99EFF79B4B54061 ON detail_bon_commande (bon_commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande ADD id_dbc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D957657F139E0 FOREIGN KEY (id_dbc_id) REFERENCES detail_bon_commande (id)');
        $this->addSql('CREATE INDEX IDX_159D957657F139E0 ON bon_commande (id_dbc_id)');
        $this->addSql('ALTER TABLE detail_bon_commande DROP FOREIGN KEY FK_99EFF79B4B54061');
        $this->addSql('DROP INDEX IDX_99EFF79B4B54061 ON detail_bon_commande');
        $this->addSql('ALTER TABLE detail_bon_commande DROP bon_commande_id');
    }
}
