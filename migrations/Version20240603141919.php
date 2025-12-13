<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603141919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE privilege (id INT AUTO_INCREMENT NOT NULL, lib_priv VARCHAR(100) NOT NULL, date_add DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE privilege_utilisateur (id INT AUTO_INCREMENT NOT NULL, id_priv_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, date_add DATE NOT NULL, INDEX IDX_212F90A4AA05FCB1 (id_priv_id), INDEX IDX_212F90A4C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE privilege_utilisateur ADD CONSTRAINT FK_212F90A4AA05FCB1 FOREIGN KEY (id_priv_id) REFERENCES privilege (id)');
        $this->addSql('ALTER TABLE privilege_utilisateur ADD CONSTRAINT FK_212F90A4C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE historique_operation DROP FOREIGN KEY FK_4AF2ED25C54C8C93');
        $this->addSql('DROP INDEX IDX_4AF2ED25C54C8C93 ON historique_operation');
        $this->addSql('ALTER TABLE historique_operation DROP type_id, CHANGE date date VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE privilege_utilisateur DROP FOREIGN KEY FK_212F90A4AA05FCB1');
        $this->addSql('ALTER TABLE privilege_utilisateur DROP FOREIGN KEY FK_212F90A4C6EE5C49');
        $this->addSql('DROP TABLE privilege');
        $this->addSql('DROP TABLE privilege_utilisateur');
        $this->addSql('ALTER TABLE historique_operation ADD type_id INT DEFAULT NULL, CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE historique_operation ADD CONSTRAINT FK_4AF2ED25C54C8C93 FOREIGN KEY (type_id) REFERENCES type_operation (id)');
        $this->addSql('CREATE INDEX IDX_4AF2ED25C54C8C93 ON historique_operation (type_id)');
    }
}
