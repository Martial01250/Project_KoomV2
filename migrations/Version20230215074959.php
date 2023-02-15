<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215074959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD project_skill LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD project_technology LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE user CHANGE skill skill JSON NOT NULL, CHANGE technology technology JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP project_skill, DROP project_technology');
        $this->addSql('ALTER TABLE user CHANGE skill skill LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE technology technology LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
