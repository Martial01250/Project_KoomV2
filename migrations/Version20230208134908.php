<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208134908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_project_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_date DATE NOT NULL, INDEX IDX_5F9E962A79F37AE5 (id_user_id), INDEX IDX_5F9E962AB3E79F4B (id_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participate (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AB3E79F4B FOREIGN KEY (id_project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user CHANGE skill skill JSON NOT NULL, CHANGE technology technology JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AB3E79F4B');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE participate');
        $this->addSql('ALTER TABLE user CHANGE skill skill LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE technology technology LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
