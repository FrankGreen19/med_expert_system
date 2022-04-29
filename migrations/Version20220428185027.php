<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428185027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE illness_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE symptom_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE illness (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE illness_symptom (illness_id INT NOT NULL, symptom_id INT NOT NULL, PRIMARY KEY(illness_id, symptom_id))');
        $this->addSql('CREATE INDEX IDX_10E6A6992E23A096 ON illness_symptom (illness_id)');
        $this->addSql('CREATE INDEX IDX_10E6A699DEEFDA95 ON illness_symptom (symptom_id)');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE symptom (id INT NOT NULL, title VARCHAR(255) NOT NULL, short_title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, role_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, l_name VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, p_name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT FK_10E6A6992E23A096 FOREIGN KEY (illness_id) REFERENCES illness (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE illness_symptom ADD CONSTRAINT FK_10E6A699DEEFDA95 FOREIGN KEY (symptom_id) REFERENCES symptom (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT FK_10E6A6992E23A096');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE illness_symptom DROP CONSTRAINT FK_10E6A699DEEFDA95');
        $this->addSql('DROP SEQUENCE illness_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE symptom_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, l_name VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, p_name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE illness');
        $this->addSql('DROP TABLE illness_symptom');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE symptom');
        $this->addSql('DROP TABLE "user"');
    }
}
