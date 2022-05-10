<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510180503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT fk_c74f21957e3c61f9');
        $this->addSql('DROP INDEX uniq_c74f21957e3c61f9');
        $this->addSql('ALTER TABLE refresh_token ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE refresh_token ADD valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE refresh_token DROP owner_id');
        $this->addSql('ALTER TABLE refresh_token ALTER refresh_token TYPE VARCHAR(128)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F2195C74F2195 ON refresh_token (refresh_token)');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT fk_2de8c6a3a76ed395');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT fk_2de8c6a3a76ed395 FOREIGN KEY (user_id) REFERENCES usr (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX UNIQ_C74F2195C74F2195');
        $this->addSql('ALTER TABLE refresh_token ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE refresh_token DROP username');
        $this->addSql('ALTER TABLE refresh_token DROP valid');
        $this->addSql('ALTER TABLE refresh_token ALTER refresh_token TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT fk_c74f21957e3c61f9 FOREIGN KEY (owner_id) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_c74f21957e3c61f9 ON refresh_token (owner_id)');
    }
}
