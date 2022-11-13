<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109002216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championnat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, id_championnat_id INT NOT NULL, name VARCHAR(255) NOT NULL, stadium VARCHAR(255) NOT NULL, INDEX IDX_2449BA155F1CB0AE (id_championnat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris_equipe (id INT AUTO_INCREMENT NOT NULL, id_equipe_id INT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_1E2F8EA8EDB3A7AE (id_equipe_id), INDEX IDX_1E2F8EA879F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris_joueur (id INT AUTO_INCREMENT NOT NULL, id_joueur_id INT NOT NULL, id_user_id INT NOT NULL, INDEX IDX_C7179D7829D76B4B (id_joueur_id), INDEX IDX_C7179D7879F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, id_equipe_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, number INT NOT NULL, age INT NOT NULL, INDEX IDX_FD71A9C5EDB3A7AE (id_equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE palmares (id INT AUTO_INCREMENT NOT NULL, id_equipe_id INT NOT NULL, nb_championnat INT NOT NULL, nb_cup INT NOT NULL, nb_cl INT NOT NULL, nb_el INT NOT NULL, UNIQUE INDEX UNIQ_FF4EE649EDB3A7AE (id_equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, role VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA155F1CB0AE FOREIGN KEY (id_championnat_id) REFERENCES championnat (id)');
        $this->addSql('ALTER TABLE favoris_equipe ADD CONSTRAINT FK_1E2F8EA8EDB3A7AE FOREIGN KEY (id_equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE favoris_equipe ADD CONSTRAINT FK_1E2F8EA879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris_joueur ADD CONSTRAINT FK_C7179D7829D76B4B FOREIGN KEY (id_joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE favoris_joueur ADD CONSTRAINT FK_C7179D7879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5EDB3A7AE FOREIGN KEY (id_equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE palmares ADD CONSTRAINT FK_FF4EE649EDB3A7AE FOREIGN KEY (id_equipe_id) REFERENCES equipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA155F1CB0AE');
        $this->addSql('ALTER TABLE favoris_equipe DROP FOREIGN KEY FK_1E2F8EA8EDB3A7AE');
        $this->addSql('ALTER TABLE favoris_equipe DROP FOREIGN KEY FK_1E2F8EA879F37AE5');
        $this->addSql('ALTER TABLE favoris_joueur DROP FOREIGN KEY FK_C7179D7829D76B4B');
        $this->addSql('ALTER TABLE favoris_joueur DROP FOREIGN KEY FK_C7179D7879F37AE5');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5EDB3A7AE');
        $this->addSql('ALTER TABLE palmares DROP FOREIGN KEY FK_FF4EE649EDB3A7AE');
        $this->addSql('DROP TABLE championnat');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE favoris_equipe');
        $this->addSql('DROP TABLE favoris_joueur');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE palmares');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
