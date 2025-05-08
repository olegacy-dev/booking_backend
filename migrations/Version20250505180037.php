<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505180037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE working_hours (
                id CHAR(36) NOT NULL PRIMARY KEY,
                employee_id CHAR(36) NOT NULL,
                weekday INT NOT NULL,
                start_time VARCHAR(5) NOT NULL,
                end_time VARCHAR(5) NOT NULL,
                created_at DATETIME NOT NULL,
                FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE working_hours;");
    }
}
