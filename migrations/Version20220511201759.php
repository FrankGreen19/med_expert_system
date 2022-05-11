<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511201759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE medical_test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE xray_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE medical_test (id INT NOT NULL, usr_id INT DEFAULT NULL, xray_image_id INT DEFAULT NULL, cnn_result_id INT DEFAULT NULL, test_type VARCHAR(255) NOT NULL, fuzzy_result VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B8CD424C69D3FB ON medical_test (usr_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B8CD42449986509 ON medical_test (xray_image_id)');
        $this->addSql('CREATE INDEX IDX_8B8CD424D63D8D12 ON medical_test (cnn_result_id)');
        $this->addSql('CREATE TABLE xray_image (id INT NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE medical_test ADD CONSTRAINT FK_8B8CD424C69D3FB FOREIGN KEY (usr_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medical_test ADD CONSTRAINT FK_8B8CD42449986509 FOREIGN KEY (xray_image_id) REFERENCES xray_image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medical_test ADD CONSTRAINT FK_8B8CD424D63D8D12 FOREIGN KEY (cnn_result_id) REFERENCES illness (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE medical_test DROP CONSTRAINT FK_8B8CD42449986509');
        $this->addSql('DROP SEQUENCE medical_test_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE xray_image_id_seq CASCADE');
        $this->addSql('DROP TABLE medical_test');
        $this->addSql('DROP TABLE xray_image');
    }
}
