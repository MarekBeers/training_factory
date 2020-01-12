<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112210655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3AD96791B');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7D3728193');
        $this->addSql('DROP TABLE person');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) DEFAULT NULL, CHANGE hiring_date hiring_date VARCHAR(255) DEFAULT NULL, CHANGE salary salary NUMERIC(10, 2) DEFAULT NULL, CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE postal_code postal_code VARCHAR(255) DEFAULT NULL, CHANGE place place VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_F87474F3AD96791B ON lesson');
        $this->addSql('ALTER TABLE lesson DROP instructor_id_id, CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training CHANGE costs costs NUMERIC(10, 2) DEFAULT NULL, CHANGE brochure_filename brochure_filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_62A8A7A7D3728193 ON registration');
        $this->addSql('ALTER TABLE registration DROP person_id_id, CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, loginname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, preprovision VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dateofbirth VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, emailaddress VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hiring_date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, salary NUMERIC(10, 2) DEFAULT \'NULL\', street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, place VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lesson ADD instructor_id_id INT DEFAULT NULL, CHANGE training_id_id training_id_id INT DEFAULT NULL, CHANGE max_persons max_persons INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3AD96791B FOREIGN KEY (instructor_id_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3AD96791B ON lesson (instructor_id_id)');
        $this->addSql('ALTER TABLE registration ADD person_id_id INT DEFAULT NULL, CHANGE lesson_id_id lesson_id_id INT DEFAULT NULL, CHANGE payment payment SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7D3728193 FOREIGN KEY (person_id_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A7D3728193 ON registration (person_id_id)');
        $this->addSql('ALTER TABLE training CHANGE costs costs NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE brochure_filename brochure_filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE preprovision preprovision VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE hiring_date hiring_date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE salary salary NUMERIC(10, 2) DEFAULT \'NULL\', CHANGE street street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE place place VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
