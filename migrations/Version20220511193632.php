<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511193632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE async_job ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE async_job ADD CONSTRAINT FK_8DA5C76BA76ED395 FOREIGN KEY (user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8DA5C76BA76ED395 ON async_job (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE async_job DROP CONSTRAINT FK_8DA5C76BA76ED395');
        $this->addSql('DROP INDEX IDX_8DA5C76BA76ED395');
        $this->addSql('ALTER TABLE async_job DROP user_id');
    }
}
