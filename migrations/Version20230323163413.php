<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323163413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE description description TINYTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(50) NOT NULL, CHANGE description description TINYTEXT DEFAULT NULL, CHANGE qty qty INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(150) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE qty qty INT DEFAULT NULL');
    }
}
