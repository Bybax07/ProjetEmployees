<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240102150015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees CHANGE emp_no emp_no INT AUTO_INCREMENT NOT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employees CHANGE emp_no emp_no INT NOT NULL');
        $this->addSql('ALTER TABLE salaries MODIFY emp_no INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON salaries');
        $this->addSql('ALTER TABLE salaries CHANGE emp_no emp_no INT NOT NULL');
    }
}