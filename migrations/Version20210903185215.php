<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903185215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD type_id_id INT DEFAULT NULL, DROP type_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7714819A0 ON event (type_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7714819A0');
        $this->addSql('DROP INDEX IDX_3BAE0AA7714819A0 ON event');
        $this->addSql('ALTER TABLE event ADD type_id INT NOT NULL, DROP type_id_id');
    }
}
