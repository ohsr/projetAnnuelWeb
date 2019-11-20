<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120141833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school ADD users_note_id INT DEFAULT NULL, CHANGE uai uai INT DEFAULT NULL, CHANGE siret siret INT DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) DEFAULT NULL, CHANGE city_code city_code INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE academy academy VARCHAR(255) DEFAULT NULL, CHANGE region_num region_num INT DEFAULT NULL, CHANGE latitude latitude VARCHAR(255) DEFAULT NULL, CHANGE longitude longitude VARCHAR(255) DEFAULT NULL, CHANGE onisep_link onisep_link VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBD6ED7C9F FOREIGN KEY (users_note_id) REFERENCES user_note_school (id)');
        $this->addSql('CREATE INDEX IDX_F99EDABBD6ED7C9F ON school (users_note_id)');
        $this->addSql('ALTER TABLE user_note_school ADD categorys_id INT NOT NULL, ADD note INT NOT NULL, ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_note_school ADD CONSTRAINT FK_485744FAA96778EC FOREIGN KEY (categorys_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_485744FAA96778EC ON user_note_school (categorys_id)');
        $this->addSql('ALTER TABLE user ADD note_school_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D48DA271 FOREIGN KEY (note_school_id) REFERENCES user_note_school (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D48DA271 ON user (note_school_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABBD6ED7C9F');
        $this->addSql('DROP INDEX IDX_F99EDABBD6ED7C9F ON school');
        $this->addSql('ALTER TABLE school DROP users_note_id, CHANGE uai uai INT DEFAULT NULL, CHANGE siret siret INT DEFAULT NULL, CHANGE sigle sigle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city_code city_code INT NOT NULL, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE academy academy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE region_num region_num INT DEFAULT NULL, CHANGE latitude latitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE longitude longitude VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE onisep_link onisep_link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D48DA271');
        $this->addSql('DROP INDEX IDX_8D93D649D48DA271 ON user');
        $this->addSql('ALTER TABLE user DROP note_school_id, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE user_note_school DROP FOREIGN KEY FK_485744FAA96778EC');
        $this->addSql('DROP INDEX IDX_485744FAA96778EC ON user_note_school');
        $this->addSql('ALTER TABLE user_note_school DROP categorys_id, DROP note, DROP created_at');
    }
}
