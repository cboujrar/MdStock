<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527165201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique_operation (id INT AUTO_INCREMENT NOT NULL, entite VARCHAR(50) NOT NULL, utilisateur VARCHAR(50) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_operation (id INT AUTO_INCREMENT NOT NULL, historique_operation_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, INDEX IDX_AD47E77DE0A45FE0 (historique_operation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_operation ADD CONSTRAINT FK_AD47E77DE0A45FE0 FOREIGN KEY (historique_operation_id) REFERENCES historique_operation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_operation DROP FOREIGN KEY FK_AD47E77DE0A45FE0');
        $this->addSql('DROP TABLE historique_operation');
        $this->addSql('DROP TABLE type_operation');
    }
}
