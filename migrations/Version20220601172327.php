<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601172327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compra_producto (compra_id INT NOT NULL, producto_id INT NOT NULL, PRIMARY KEY(compra_id, producto_id))');
        $this->addSql('CREATE INDEX IDX_C455FFD1F2E704D7 ON compra_producto (compra_id)');
        $this->addSql('CREATE INDEX IDX_C455FFD17645698E ON compra_producto (producto_id)');
        $this->addSql('ALTER TABLE compra_producto ADD CONSTRAINT FK_C455FFD1F2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compra_producto ADD CONSTRAINT FK_C455FFD17645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE compra_producto');
    }
}
