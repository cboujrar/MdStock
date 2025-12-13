<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507155822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_sortie ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_bon_sortie ADD CONSTRAINT FK_93591B1E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_93591B1E7294869C ON detail_bon_sortie (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_bon_sortie DROP FOREIGN KEY FK_93591B1E7294869C');
        $this->addSql('DROP INDEX IDX_93591B1E7294869C ON detail_bon_sortie');
        $this->addSql('ALTER TABLE detail_bon_sortie DROP article_id');
    }
}
