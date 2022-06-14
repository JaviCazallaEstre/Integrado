<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601170322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE campaña_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE compra_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cosecha_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE producto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE campaña (id INT NOT NULL, campaña VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE compra (id INT NOT NULL, usuario_id INT DEFAULT NULL, fecha DATE NOT NULL, coste DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EC131FFDB38439E ON compra (usuario_id)');
        $this->addSql('CREATE TABLE cosecha (id INT NOT NULL, cosecha VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE producto (id INT NOT NULL, variedad_id INT DEFAULT NULL, campaña_id INT DEFAULT NULL, cosecha_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, precio DOUBLE PRECISION NOT NULL, descripcion VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A7BB061591391A54 ON producto (variedad_id)');
        $this->addSql('CREATE INDEX IDX_A7BB061510685F53 ON producto (campaña_id)');
        $this->addSql('CREATE INDEX IDX_A7BB06159C69A17D ON producto (cosecha_id)');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFDB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061591391A54 FOREIGN KEY (variedad_id) REFERENCES variedad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061510685F53 FOREIGN KEY (campaña_id) REFERENCES campaña (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06159C69A17D FOREIGN KEY (cosecha_id) REFERENCES cosecha (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD apellidos VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD tipo_via VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD nombre_via VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD numero_via VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD escalera VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD bloque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD puerta VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD piso VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD localidad VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD provincia VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT FK_A7BB061510685F53');
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT FK_A7BB06159C69A17D');
        $this->addSql('DROP SEQUENCE campaña_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE compra_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cosecha_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE producto_id_seq CASCADE');
        $this->addSql('DROP TABLE campaña');
        $this->addSql('DROP TABLE compra');
        $this->addSql('DROP TABLE cosecha');
        $this->addSql('DROP TABLE producto');
        $this->addSql('ALTER TABLE "user" DROP apellidos');
        $this->addSql('ALTER TABLE "user" DROP tipo_via');
        $this->addSql('ALTER TABLE "user" DROP nombre_via');
        $this->addSql('ALTER TABLE "user" DROP numero_via');
        $this->addSql('ALTER TABLE "user" DROP escalera');
        $this->addSql('ALTER TABLE "user" DROP bloque');
        $this->addSql('ALTER TABLE "user" DROP puerta');
        $this->addSql('ALTER TABLE "user" DROP piso');
        $this->addSql('ALTER TABLE "user" DROP localidad');
        $this->addSql('ALTER TABLE "user" DROP provincia');
    }
}
