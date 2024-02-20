<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219025950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dept_title ADD CONSTRAINT FK_89C9586BA9F87BD FOREIGN KEY (title_id) REFERENCES titles (id)');
        $this->addSql('CREATE INDEX IDX_89C9586BA9F87BD ON dept_title (title_id)');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300A2F57F47 FOREIGN KEY (emp_no) REFERENCES dept_manager (emp_no)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dept_title DROP FOREIGN KEY FK_89C9586BA9F87BD');
        $this->addSql('DROP INDEX IDX_89C9586BA9F87BD ON dept_title');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300A2F57F47');
        $this->addSql('ALTER TABLE employees CHANGE roles roles JSON NOT NULL COLLATE `utf8mb4_bin`');
    }
}
