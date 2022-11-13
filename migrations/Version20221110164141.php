<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110164141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris_equipe DROP FOREIGN KEY FK_1E2F8EA879F37AE5');
        $this->addSql('ALTER TABLE favoris_equipe DROP FOREIGN KEY FK_1E2F8EA8EDB3A7AE');
        $this->addSql('DROP INDEX IDX_1E2F8EA8EDB3A7AE ON favoris_equipe');
        $this->addSql('DROP INDEX IDX_1E2F8EA879F37AE5 ON favoris_equipe');
        $this->addSql('ALTER TABLE favoris_equipe ADD id_equipe INT NOT NULL, ADD id_user INT NOT NULL, DROP id_equipe_id, DROP id_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris_equipe ADD id_equipe_id INT DEFAULT NULL, ADD id_user_id INT DEFAULT NULL, DROP id_equipe, DROP id_user');
        $this->addSql('ALTER TABLE favoris_equipe ADD CONSTRAINT FK_1E2F8EA879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris_equipe ADD CONSTRAINT FK_1E2F8EA8EDB3A7AE FOREIGN KEY (id_equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_1E2F8EA8EDB3A7AE ON favoris_equipe (id_equipe_id)');
        $this->addSql('CREATE INDEX IDX_1E2F8EA879F37AE5 ON favoris_equipe (id_user_id)');
    }
}
