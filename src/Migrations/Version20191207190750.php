<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191207190750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, info LONGTEXT NOT NULL, coefficient INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_comment_school (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, schools_id INT DEFAULT NULL, categorys_id INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, note INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_58085DF067B3B43D (users_id), INDEX IDX_58085DF0A000581D (schools_id), INDEX IDX_58085DF0A96778EC (categorys_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, uai INT DEFAULT NULL, siret INT DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, sigle VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city_code INT DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, department VARCHAR(255) NOT NULL, academy VARCHAR(255) DEFAULT NULL, region_num INT DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, onisep_link VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, global_note INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF0A000581D FOREIGN KEY (schools_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF0A96778EC FOREIGN KEY (categorys_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF0A96778EC');
        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF0A000581D');
        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF067B3B43D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE user_comment_school');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE user');
    }
}
