<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831140911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item RENAME COLUMN quantity TO order_ref_id');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09E238517C FOREIGN KEY (order_ref_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_52EA1F09E238517C ON order_item (order_ref_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_item DROP CONSTRAINT FK_52EA1F09E238517C');
        $this->addSql('DROP INDEX IDX_52EA1F09E238517C');
        $this->addSql('ALTER TABLE order_item RENAME COLUMN order_ref_id TO quantity');
    }
}
