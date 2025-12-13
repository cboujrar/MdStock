<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428150023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, id_depot_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(100) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_23A0E669F34925F (id_categorie_id), INDEX IDX_23A0E66D5CB384B (id_depot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bon_commande (id INT AUTO_INCREMENT NOT NULL, id_dbc_id INT DEFAULT NULL, code_status_id INT DEFAULT NULL, id_fournisseur_id INT DEFAULT NULL, date_commande DATE NOT NULL, observation VARCHAR(255) DEFAULT NULL, date_livraison DATE NOT NULL, INDEX IDX_159D957657F139E0 (id_dbc_id), INDEX IDX_159D9576C7B27885 (code_status_id), INDEX IDX_159D95765A6AC879 (id_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bon_sortie (id INT AUTO_INCREMENT NOT NULL, id_dbs_id INT DEFAULT NULL, quantite INT NOT NULL, observation VARCHAR(100) DEFAULT NULL, INDEX IDX_2843ABC87E86E7F (id_dbs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(100) NOT NULL, capacite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_bon_commande (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_bon_sortie (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, id_bc_id INT NOT NULL, date_paiement DATE NOT NULL, totale DOUBLE PRECISION NOT NULL, mode_paiement VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_FE8664107BC6D6CF (id_bc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, telephone INT NOT NULL, email INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_bc (id INT AUTO_INCREMENT NOT NULL, code_status INT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66D5CB384B FOREIGN KEY (id_depot_id) REFERENCES depot (id)');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D957657F139E0 FOREIGN KEY (id_dbc_id) REFERENCES detail_bon_commande (id)');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D9576C7B27885 FOREIGN KEY (code_status_id) REFERENCES status_bc (id)');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D95765A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE bon_sortie ADD CONSTRAINT FK_2843ABC87E86E7F FOREIGN KEY (id_dbs_id) REFERENCES detail_bon_sortie (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664107BC6D6CF FOREIGN KEY (id_bc_id) REFERENCES bon_commande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669F34925F');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66D5CB384B');
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D957657F139E0');
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D9576C7B27885');
        $this->addSql('ALTER TABLE bon_commande DROP FOREIGN KEY FK_159D95765A6AC879');
        $this->addSql('ALTER TABLE bon_sortie DROP FOREIGN KEY FK_2843ABC87E86E7F');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664107BC6D6CF');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE bon_commande');
        $this->addSql('DROP TABLE bon_sortie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE detail_bon_commande');
        $this->addSql('DROP TABLE detail_bon_sortie');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE status_bc');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
