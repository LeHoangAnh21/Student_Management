<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030024031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher ADD major_id INT DEFAULT NULL, DROP major');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5E93695C7 FOREIGN KEY (major_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5E93695C7 ON teacher (major_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5E93695C7');
        $this->addSql('DROP INDEX IDX_B0F6A6D5E93695C7 ON teacher');
        $this->addSql('ALTER TABLE teacher ADD major VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP major_id');
    }
}
