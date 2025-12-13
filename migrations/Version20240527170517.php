<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527170517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_operation DROP FOREIGN KEY FK_AD47E77DE0A45FE0');
        $this->addSql('DROP INDEX IDX_AD47E77DE0A45FE0 ON type_operation');
        $this->addSql('ALTER TABLE type_operation DROP historique_operation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_operation ADD historique_operation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_operation ADD CONSTRAINT FK_AD47E77DE0A45FE0 FOREIGN KEY (historique_operation_id) REFERENCES historique_operation (id)');
        $this->addSql('CREATE INDEX IDX_AD47E77DE0A45FE0 ON type_operation (historique_operation_id)');
    }
}
