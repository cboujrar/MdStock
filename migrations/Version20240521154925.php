<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521154925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D95767294869C');
        $this->addSql('DROP INDEX IDX_159D95767294869C ON bon_commande');
        $this->addSql('ALTER TABLE bon_commande DROP article_id');
        $this->addSql('ALTER TABLE detail_bon_commande ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_bon_commande ADD CONSTRAINT FK_99EFF797294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_99EFF797294869C ON detail_bon_commande (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_commande ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D95767294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_159D95767294869C ON bon_commande (article_id)');
        $this->addSql('ALTER TABLE detail_bon_commande DROP FOREIGN KEY FK_99EFF797294869C');
        $this->addSql('DROP INDEX IDX_99EFF797294869C ON detail_bon_commande');
        $this->addSql('ALTER TABLE detail_bon_commande DROP article_id');
    }
}
