<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624094623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee_position (id INT AUTO_INCREMENT NOT NULL, fio_id INT NOT NULL, employee_post_id INT NOT NULL, UNIQUE INDEX UNIQ_D613B532108A3AF (fio_id), INDEX IDX_D613B532CBC55523 (employee_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_position ADD CONSTRAINT FK_D613B532108A3AF FOREIGN KEY (fio_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE employee_position ADD CONSTRAINT FK_D613B532CBC55523 FOREIGN KEY (employee_post_id) REFERENCES position (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee_position');
    }
}
