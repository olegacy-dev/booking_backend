<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505164836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE service_categories (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $this->addSql("
            CREATE TABLE services (
                id CHAR(36) PRIMARY KEY,
                category_id CHAR(36) NOT NULL,
                name VARCHAR(100) NOT NULL,
                description TEXT NOT NULL,
                duration_in_minutes INT NOT NULL,
                is_active TINYINT(1) NULL DEFAULT 1,
                created_at DATETIME NOT NULL,
                FOREIGN KEY (category_id) REFERENCES service_categories(id) ON DELETE RESTRICT ON UPDATE CASCADE 
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE services;");
        $this->addSql("DROP TABLE service_categories;");
    }
}
