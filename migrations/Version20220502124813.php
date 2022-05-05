<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502124813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jwt_token DROP CONSTRAINT fk_f53b9f217e3c61f9');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT fk_2de8c6a3a76ed395');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "usr_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "usr" (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, l_name VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, p_name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1762498CE7927C74 ON "usr" (email)');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE jwt_token ADD CONSTRAINT FK_F53B9F217E3C61F9 FOREIGN KEY (owner_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE jwt_token DROP CONSTRAINT FK_F53B9F217E3C61F9');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('DROP SEQUENCE "usr_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, l_name VARCHAR(255) NOT NULL, f_name VARCHAR(255) NOT NULL, p_name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('DROP TABLE "usr"');
        $this->addSql('ALTER TABLE jwt_token DROP CONSTRAINT fk_f53b9f217e3c61f9');
        $this->addSql('ALTER TABLE jwt_token ADD CONSTRAINT fk_f53b9f217e3c61f9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT fk_2de8c6a3a76ed395');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT fk_2de8c6a3a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
