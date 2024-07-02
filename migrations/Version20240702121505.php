<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702121505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD date DATETIME NOT NULL, ADD location VARCHAR(255) NOT NULL, DROP date_debut, DROP date_fin, DROP nombre_gagnants, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE nom name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD nom VARCHAR(255) NOT NULL, ADD date_debut DATETIME DEFAULT NULL, ADD date_fin DATETIME DEFAULT NULL, ADD nombre_gagnants INT DEFAULT NULL, DROP name, DROP date, DROP location, CHANGE description description LONGTEXT NOT NULL');
    }
}
