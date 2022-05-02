<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220430195428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE jwt_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE jwt_token (id INT NOT NULL, owner_id INT NOT NULL, refresh_token VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F53B9F217E3C61F9 ON jwt_token (owner_id)');
        $this->addSql('ALTER TABLE jwt_token ADD CONSTRAINT FK_F53B9F217E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT FK_10E6A6992E23A096');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT FK_10E6A699DEEFDA95');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT FK_10E6A6992E23A096 FOREIGN KEY (illness_id) REFERENCES illness (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT FK_10E6A699DEEFDA95 FOREIGN KEY (symptom_id) REFERENCES symptom (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD is_active BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE jwt_token_id_seq CASCADE');
        $this->addSql('DROP TABLE jwt_token');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT fk_10e6a6992e23a096');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT fk_10e6a699deefda95');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT fk_10e6a6992e23a096 FOREIGN KEY (illness_id) REFERENCES illness (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT fk_10e6a699deefda95 FOREIGN KEY (symptom_id) REFERENCES symptom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP is_active');
    }
}
