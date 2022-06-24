<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624120932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programm_language (id INT AUTO_INCREMENT NOT NULL, language VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programm_language_employee (programm_language_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_A1BE1539F8CCA349 (programm_language_id), INDEX IDX_A1BE15398C03F15C (employee_id), PRIMARY KEY(programm_language_id, employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programm_language_employee ADD CONSTRAINT FK_A1BE1539F8CCA349 FOREIGN KEY (programm_language_id) REFERENCES programm_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programm_language_employee ADD CONSTRAINT FK_A1BE15398C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programm_language_employee DROP FOREIGN KEY FK_A1BE1539F8CCA349');
        $this->addSql('DROP TABLE programm_language');
        $this->addSql('DROP TABLE programm_language_employee');
    }
}
