<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506221253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_sortie ADD idbs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_bon_sortie ADD CONSTRAINT FK_93591B1E135FAC79 FOREIGN KEY (idbs_id) REFERENCES bon_sortie (id)');
        $this->addSql('CREATE INDEX IDX_93591B1E135FAC79 ON detail_bon_sortie (idbs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_sortie DROP FOREIGN KEY FK_93591B1E135FAC79');
        $this->addSql('DROP INDEX IDX_93591B1E135FAC79 ON detail_bon_sortie');
        $this->addSql('ALTER TABLE detail_bon_sortie DROP idbs_id');
    }
}
