<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112212214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lesson_user');
        $this->addSql('DROP TABLE registration_user');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) DEFAULT NULL, CHANGE hiring_date hiring_date VARCHAR(255) DEFAULT NULL, CHANGE salary salary NUMERIC(10, 2) DEFAULT NULL, CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE place place VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training CHANGE costs costs NUMERIC(10, 2) DEFAULT NULL, CHANGE brochure_filename brochure_filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE registration CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lesson_user (lesson_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B4E2102DA76ED395 (user_id), INDEX IDX_B4E2102DCDF80196 (lesson_id), PRIMARY KEY(lesson_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE registration_user (registration_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_42ADC195A76ED395 (user_id), INDEX IDX_42ADC195833D8F43 (registration_id), PRIMARY KEY(registration_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lesson_user ADD CONSTRAINT FK_B4E2102DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lesson_user ADD CONSTRAINT FK_B4E2102DCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration_user ADD CONSTRAINT FK_42ADC195833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration_user ADD CONSTRAINT FK_42ADC195A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lesson CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE training CHANGE costs costs NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE brochure_filename brochure_filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE hiring_date hiring_date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE salary salary NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE street street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE place place VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
