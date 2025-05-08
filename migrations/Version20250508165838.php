<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508165838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE employees (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                category_id CHAR(36) NOT NULL,
                created_at DATETIME NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            CREATE TABLE employee_service_assignments (
                employee_id CHAR(36) NOT NULL,
                service_id CHAR(36) NOT NULL,
                PRIMARY KEY (employee_id, service_id),
                CONSTRAINT fk_employee FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE,
                CONSTRAINT fk_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE employee_service_assignments;');
        $this->addSql('DROP TABLE employees;');
    }
}
