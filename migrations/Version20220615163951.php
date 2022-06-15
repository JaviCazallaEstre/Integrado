<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615163951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE carrito_id_seq CASCADE');
        $this->addSql('DROP TABLE carrito');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE carrito_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE carrito (id INT NOT NULL, producto_id INT DEFAULT NULL, usuario_id INT NOT NULL, cantidad INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_77e6bed5db38439e ON carrito (usuario_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_77e6bed57645698e ON carrito (producto_id)');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT fk_77e6bed57645698e FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT fk_77e6bed5db38439e FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
