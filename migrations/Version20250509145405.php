<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509145405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE users (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                phone_code VARCHAR(8) NOT NULL,
                phone_number VARCHAR(32) NOT NULL,
                created_at DATETIME NOT NULL,
                UNIQUE(phone_code, phone_number)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            CREATE TABLE sms_verification_attempts (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(100) NULL,
                phone_code VARCHAR(8) NOT NULL,
                phone_number VARCHAR(32) NOT NULL,
                code VARCHAR(6) NOT NULL,
                expires_at DATETIME NOT NULL,
                attempts INT NOT NULL DEFAULT 0,
                created_at DATETIME NOT NULL,
                UNIQUE(phone_code, phone_number)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users;');
        $this->addSql('DROP TABLE registration_attempts;');
    }
}
