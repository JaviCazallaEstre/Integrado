<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606174241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT fk_a7bb061510685f53');
        $this->addSql('DROP SEQUENCE campaña_id_seq CASCADE');
        $this->addSql('DROP TABLE "campaña"');
        $this->addSql('DROP INDEX idx_a7bb061510685f53');
        $this->addSql('ALTER TABLE producto ADD capacidad VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE producto DROP "campaña_id"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE campaña_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "campaña" (id INT NOT NULL, "campaña" VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE producto ADD "campaña_id" INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto DROP capacidad');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT fk_a7bb061510685f53 FOREIGN KEY ("campaña_id") REFERENCES "campaña" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_a7bb061510685f53 ON producto (campaña_id)');
    }
}
