<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701164628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, nombre_gagnants INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gagnant (id INT AUTO_INCREMENT NOT NULL, tirage_id INT DEFAULT NULL, participant_id INT DEFAULT NULL, rang INT NOT NULL, INDEX IDX_53D089C82579054 (tirage_id), INDEX IDX_53D089C9D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, participant_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, date_inscription DATETIME DEFAULT NULL, INDEX IDX_5E90F6D69D1C3019 (participant_id), INDEX IDX_5E90F6D6FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, consentement_rgpd TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tirage (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, date_tirage DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_2A145AFFFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gagnant ADD CONSTRAINT FK_53D089C82579054 FOREIGN KEY (tirage_id) REFERENCES tirage (id)');
        $this->addSql('ALTER TABLE gagnant ADD CONSTRAINT FK_53D089C9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE tirage ADD CONSTRAINT FK_2A145AFFFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gagnant DROP FOREIGN KEY FK_53D089C82579054');
        $this->addSql('ALTER TABLE gagnant DROP FOREIGN KEY FK_53D089C9D1C3019');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69D1C3019');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FD02F13');
        $this->addSql('ALTER TABLE tirage DROP FOREIGN KEY FK_2A145AFFFD02F13');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE gagnant');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE tirage');
    }
}
