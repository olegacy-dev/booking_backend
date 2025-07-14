<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250714150722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE users
                ADD roles JSON NOT NULL DEFAULT (\'["ROLE_USER"]\');
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            ALTER TABLE users DROP COLUMN roles;
        ");
    }
}
