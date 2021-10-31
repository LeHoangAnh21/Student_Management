<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211031044554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroomn (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroomn_student (classroomn_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_CF1EC3E49D6D6168 (classroomn_id), INDEX IDX_CF1EC3E4CB944F1A (student_id), PRIMARY KEY(classroomn_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroomn_course (classroomn_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_2C3B1AF19D6D6168 (classroomn_id), INDEX IDX_2C3B1AF1591CC992 (course_id), PRIMARY KEY(classroomn_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroomn_student ADD CONSTRAINT FK_CF1EC3E49D6D6168 FOREIGN KEY (classroomn_id) REFERENCES classroomn (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroomn_student ADD CONSTRAINT FK_CF1EC3E4CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroomn_course ADD CONSTRAINT FK_2C3B1AF19D6D6168 FOREIGN KEY (classroomn_id) REFERENCES classroomn (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroomn_course ADD CONSTRAINT FK_2C3B1AF1591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroomn_student DROP FOREIGN KEY FK_CF1EC3E49D6D6168');
        $this->addSql('ALTER TABLE classroomn_course DROP FOREIGN KEY FK_2C3B1AF19D6D6168');
        $this->addSql('DROP TABLE classroomn');
        $this->addSql('DROP TABLE classroomn_student');
        $this->addSql('DROP TABLE classroomn_course');
    }
}
