<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208093143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) DEFAULT NULL, ADD lastname VARCHAR(255) DEFAULT NULL, ADD job VARCHAR(255) DEFAULT NULL, ADD link_github VARCHAR(255) DEFAULT NULL, ADD link_linkedin VARCHAR(255) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD skill LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD technology LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP job, DROP link_github, DROP link_linkedin, DROP description, DROP skill, DROP technology');
    }
}
