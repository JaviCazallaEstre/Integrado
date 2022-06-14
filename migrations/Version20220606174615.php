<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606174615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE campana_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE campana (id INT NOT NULL, campana VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE producto ADD campana_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615CAF4BE34 FOREIGN KEY (campana_id) REFERENCES campana (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A7BB0615CAF4BE34 ON producto (campana_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT FK_A7BB0615CAF4BE34');
        $this->addSql('DROP SEQUENCE campana_id_seq CASCADE');
        $this->addSql('DROP TABLE campana');
        $this->addSql('DROP INDEX IDX_A7BB0615CAF4BE34');
        $this->addSql('ALTER TABLE producto DROP campana_id');
    }
}
