<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521163726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_commande DROP FOREIGN KEY FK_99EFF79B4B54061');
        $this->addSql('DROP INDEX IDX_99EFF79B4B54061 ON detail_bon_commande');
        $this->addSql('ALTER TABLE detail_bon_commande DROP bon_commande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_commande ADD bon_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_bon_commande ADD CONSTRAINT FK_99EFF79B4B54061 FOREIGN KEY (bon_commande_id) REFERENCES bon_commande (id)');
        $this->addSql('CREATE INDEX IDX_99EFF79B4B54061 ON detail_bon_commande (bon_commande_id)');
    }
}
