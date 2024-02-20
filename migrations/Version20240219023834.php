<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219023834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dept_manager DROP INDEX IDX_C14AA78EA2F57F47, ADD UNIQUE INDEX UNIQ_C14AA78EA2F57F47 (emp_no)');
        $this->addSql('ALTER TABLE dept_title RENAME INDEX title_id TO IDX_89C9586BA9F87BD');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300A2F57F47 FOREIGN KEY (emp_no) REFERENCES dept_manager (emp_no)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dept_manager DROP INDEX UNIQ_C14AA78EA2F57F47, ADD INDEX IDX_C14AA78EA2F57F47 (emp_no)');
        $this->addSql('ALTER TABLE dept_title RENAME INDEX idx_89c9586ba9f87bd TO title_id');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300A2F57F47');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL COLLATE `utf8mb4_bin`');
    }
}
