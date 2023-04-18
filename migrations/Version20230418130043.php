<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418130043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__i23_users AS SELECT id, login, roles, password, nom, prenom, birthday FROM i23_users');
        $this->addSql('DROP TABLE i23_users');
        $this->addSql('CREATE TABLE i23_users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, panier_id INTEGER DEFAULT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, birthday DATE NOT NULL, CONSTRAINT FK_67D32048F77D927C FOREIGN KEY (panier_id) REFERENCES i23_paniers (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO i23_users (id, login, roles, password, nom, prenom, birthday) SELECT id, login, roles, password, nom, prenom, birthday FROM __temp__i23_users');
        $this->addSql('DROP TABLE __temp__i23_users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D32048AA08CB10 ON i23_users (login)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D32048F77D927C ON i23_users (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__i23_users AS SELECT id, login, roles, password, nom, prenom, birthday FROM i23_users');
        $this->addSql('DROP TABLE i23_users');
        $this->addSql('CREATE TABLE i23_users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, birthday DATE NOT NULL)');
        $this->addSql('INSERT INTO i23_users (id, login, roles, password, nom, prenom, birthday) SELECT id, login, roles, password, nom, prenom, birthday FROM __temp__i23_users');
        $this->addSql('DROP TABLE __temp__i23_users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67D32048AA08CB10 ON i23_users (login)');
    }
}
