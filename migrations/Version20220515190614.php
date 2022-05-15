<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515190614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medical_test DROP CONSTRAINT fk_8b8cd424d63d8d12');
        $this->addSql('DROP INDEX idx_8b8cd424d63d8d12');
        $this->addSql('ALTER TABLE medical_test ADD cnn_result JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_test DROP cnn_result_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE medical_test ADD cnn_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_test DROP cnn_result');
        $this->addSql('ALTER TABLE medical_test ADD CONSTRAINT fk_8b8cd424d63d8d12 FOREIGN KEY (cnn_result_id) REFERENCES illness (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8b8cd424d63d8d12 ON medical_test (cnn_result_id)');
    }
}
