<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112212712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FA76ED395');
        $this->addSql('DROP INDEX IDX_D5128A8FA76ED395 ON training');
        $this->addSql('ALTER TABLE training DROP user_id, CHANGE costs costs NUMERIC(10, 2) DEFAULT NULL, CHANGE brochure_filename brochure_filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) DEFAULT NULL, CHANGE hiring_date hiring_date VARCHAR(255) DEFAULT NULL, CHANGE salary salary NUMERIC(10, 2) DEFAULT NULL, CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE place place VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE training ADD user_id INT DEFAULT NULL, CHANGE costs costs NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE brochure_filename brochure_filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D5128A8FA76ED395 ON training (user_id)');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE hiring_date hiring_date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE salary salary NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE street street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE place place VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
