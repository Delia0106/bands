<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014171428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_musical (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_du_groupe VARCHAR(255) NOT NULL, origine VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, annee_debut VARCHAR(255) NOT NULL, annee_separation VARCHAR(255) DEFAULT NULL, fondateurs VARCHAR(255) DEFAULT NULL, membres INTEGER DEFAULT NULL, courant_musical VARCHAR(255) DEFAULT NULL, presentation VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE groupe_musical');
    }
}
