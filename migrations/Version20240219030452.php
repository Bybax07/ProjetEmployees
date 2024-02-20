<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219030452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16AEB8D4C6720C25 ON departments (dept_name)');
        $this->addSql('ALTER TABLE dept_manager ADD CONSTRAINT FK_C14AA78EA2F57F47 FOREIGN KEY (emp_no) REFERENCES employees (emp_no)');
        $this->addSql('ALTER TABLE dept_manager ADD CONSTRAINT FK_C14AA78EE6B0AD08 FOREIGN KEY (dept_no) REFERENCES departments (dept_no)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C14AA78EA2F57F47 ON dept_manager (emp_no)');
        $this->addSql('ALTER TABLE dept_title ADD CONSTRAINT FK_89C9586BA9F87BD FOREIGN KEY (title_id) REFERENCES titles (id)');
        $this->addSql('CREATE INDEX IDX_89C9586BA9F87BD ON dept_title (title_id)');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300A2F57F47 FOREIGN KEY (emp_no) REFERENCES dept_manager (emp_no)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_16AEB8D4C6720C25 ON departments');
        $this->addSql('ALTER TABLE dept_manager DROP FOREIGN KEY FK_C14AA78EA2F57F47');
        $this->addSql('ALTER TABLE dept_manager DROP FOREIGN KEY FK_C14AA78EE6B0AD08');
        $this->addSql('DROP INDEX UNIQ_C14AA78EA2F57F47 ON dept_manager');
        $this->addSql('ALTER TABLE dept_title DROP FOREIGN KEY FK_89C9586BA9F87BD');
        $this->addSql('DROP INDEX IDX_89C9586BA9F87BD ON dept_title');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300A2F57F47');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL COLLATE `utf8mb4_bin`');
    }
}
