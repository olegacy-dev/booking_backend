<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509102916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE bookings (
                id CHAR(36) NOT NULL PRIMARY KEY,
                employee_id CHAR(36) NOT NULL,
                start_at DATETIME NOT NULL,
                end_at DATETIME NOT NULL,
                service_ids JSON NOT NULL,
                created_at DATETIME NOT NULL,
                CONSTRAINT fk_booking_employee FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE bookings;');
    }
}
