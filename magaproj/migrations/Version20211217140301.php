<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217140301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, acheteur_id INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, is_paid TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', paid_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6EEAA67D96A7BB5F (acheteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_detail (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_2C528446ECC6147F (production_id), INDEX IDX_2C52844682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critique (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, commentaire LONGTEXT NOT NULL, note INT NOT NULL, INDEX IDX_1F950324ECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, demande LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8B27C52B60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimation (id INT AUTO_INCREMENT NOT NULL, production_id INT NOT NULL, estimateur_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_D0527024ECC6147F (production_id), INDEX IDX_D0527024B402C58D (estimateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, auteur_id INT NOT NULL, contenu LONGTEXT NOT NULL, prix_final DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D3EDB1E0BCF5E72D (categorie_id), INDEX IDX_D3EDB1E060BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil_estimateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, resume VARCHAR(255) DEFAULT NULL, is_validated TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_46A2742AFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_acheteur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C9209E2CFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_production (user_id INT NOT NULL, production_id INT NOT NULL, INDEX IDX_748A770CA76ED395 (user_id), INDEX IDX_748A770CECC6147F (production_id), PRIMARY KEY(user_id, production_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C528446ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C52844682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024B402C58D FOREIGN KEY (estimateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profil_estimateur ADD CONSTRAINT FK_46A2742AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile_acheteur ADD CONSTRAINT FK_C9209E2CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_production ADD CONSTRAINT FK_748A770CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_production ADD CONSTRAINT FK_748A770CECC6147F FOREIGN KEY (production_id) REFERENCES production (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0BCF5E72D');
        $this->addSql('ALTER TABLE commande_detail DROP FOREIGN KEY FK_2C52844682EA2E54');
        $this->addSql('ALTER TABLE commande_detail DROP FOREIGN KEY FK_2C528446ECC6147F');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324ECC6147F');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024ECC6147F');
        $this->addSql('ALTER TABLE user_production DROP FOREIGN KEY FK_748A770CECC6147F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D96A7BB5F');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B60BB6FE6');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024B402C58D');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E060BB6FE6');
        $this->addSql('ALTER TABLE profil_estimateur DROP FOREIGN KEY FK_46A2742AFB88E14F');
        $this->addSql('ALTER TABLE profile_acheteur DROP FOREIGN KEY FK_C9209E2CFB88E14F');
        $this->addSql('ALTER TABLE user_production DROP FOREIGN KEY FK_748A770CA76ED395');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_detail');
        $this->addSql('DROP TABLE critique');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE estimation');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE profil_estimateur');
        $this->addSql('DROP TABLE profile_acheteur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_production');
    }
}
