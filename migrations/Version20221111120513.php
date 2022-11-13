<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111120513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris_joueur DROP FOREIGN KEY FK_C7179D7829D76B4B');
        $this->addSql('ALTER TABLE favoris_joueur DROP FOREIGN KEY FK_C7179D7879F37AE5');
        $this->addSql('DROP INDEX IDX_C7179D7829D76B4B ON favoris_joueur');
        $this->addSql('DROP INDEX IDX_C7179D7879F37AE5 ON favoris_joueur');
        $this->addSql('ALTER TABLE favoris_joueur ADD id_joueur INT NOT NULL, ADD id_user INT NOT NULL, DROP id_joueur_id, DROP id_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris_joueur ADD id_joueur_id INT NOT NULL, ADD id_user_id INT NOT NULL, DROP id_joueur, DROP id_user');
        $this->addSql('ALTER TABLE favoris_joueur ADD CONSTRAINT FK_C7179D7829D76B4B FOREIGN KEY (id_joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE favoris_joueur ADD CONSTRAINT FK_C7179D7879F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C7179D7829D76B4B ON favoris_joueur (id_joueur_id)');
        $this->addSql('CREATE INDEX IDX_C7179D7879F37AE5 ON favoris_joueur (id_user_id)');
    }
}
