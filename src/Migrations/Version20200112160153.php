<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112160153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, instructor_id_id INT DEFAULT NULL, training_id_id INT DEFAULT NULL, time TIME NOT NULL, date DATE NOT NULL, location VARCHAR(255) NOT NULL, max_persons INT NOT NULL, INDEX IDX_F87474F3AD96791B (instructor_id_id), INDEX IDX_F87474F3909E143A (training_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, loginname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, preprovision VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, dateofbirth VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, emailaddress VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, hiring_date VARCHAR(255) DEFAULT NULL, salary NUMERIC(10, 2) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, lesson_id_id INT DEFAULT NULL, person_id_id INT DEFAULT NULL, payment SMALLINT DEFAULT NULL, INDEX IDX_62A8A7A735A24AD0 (lesson_id_id), INDEX IDX_62A8A7A7D3728193 (person_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, duration TIME NOT NULL, costs NUMERIC(10, 2) DEFAULT NULL, brochure_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, loginname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, preprovision VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, dateofbirth DATE NOT NULL, gender VARCHAR(255) NOT NULL, hiring_date VARCHAR(255) DEFAULT NULL, salary NUMERIC(10, 2) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496D1A90C6 (loginname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3AD96791B FOREIGN KEY (instructor_id_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3909E143A FOREIGN KEY (training_id_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A735A24AD0 FOREIGN KEY (lesson_id_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7D3728193 FOREIGN KEY (person_id_id) REFERENCES person (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A735A24AD0');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3AD96791B');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7D3728193');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3909E143A');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
    }
}
