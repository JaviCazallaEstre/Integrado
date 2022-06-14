<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610165043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto ADD capacidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615522BE0B9 FOREIGN KEY (capacidad_id) REFERENCES capacidad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A7BB0615522BE0B9 ON producto (capacidad_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT FK_A7BB0615522BE0B9');
        $this->addSql('DROP INDEX IDX_A7BB0615522BE0B9');
        $this->addSql('ALTER TABLE producto DROP capacidad_id');
    }
}
