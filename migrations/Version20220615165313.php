<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615165313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE carrito_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE carrito (id INT NOT NULL, producto_id INT NOT NULL, usuario_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77E6BED57645698E ON carrito (producto_id)');
        $this->addSql('CREATE INDEX IDX_77E6BED5DB38439E ON carrito (usuario_id)');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT FK_77E6BED57645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT FK_77E6BED5DB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE carrito_id_seq CASCADE');
        $this->addSql('DROP TABLE carrito');
    }
}
