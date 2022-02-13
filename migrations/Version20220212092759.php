<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220212092759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit1 (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(100) NOT NULL, fournisseur VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit1');
        $this->addSql('ALTER TABLE produit CHANGE libelle libelle VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fournisseur fournisseur VARCHAR(80) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
