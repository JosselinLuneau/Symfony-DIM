<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210094100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, post, created_at, is_published, is_deleted, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, is_published BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL, author_id INTEGER DEFAULT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO post (id, content, created_at, is_published, is_deleted, author_id) SELECT id, post, created_at, is_published, is_deleted, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, created_at, is_published, is_deleted, content, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, is_published BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL, author_id INTEGER DEFAULT NULL, post CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO post (id, created_at, is_published, is_deleted, post, author_id) SELECT id, created_at, is_published, is_deleted, content, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }
}
