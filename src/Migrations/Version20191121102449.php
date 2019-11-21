<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121102449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_comment_school ADD users_id INT NOT NULL, ADD schools_id INT NOT NULL, ADD categorys_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF0A000581D FOREIGN KEY (schools_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE user_comment_school ADD CONSTRAINT FK_58085DF0A96778EC FOREIGN KEY (categorys_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_58085DF067B3B43D ON user_comment_school (users_id)');
        $this->addSql('CREATE INDEX IDX_58085DF0A000581D ON user_comment_school (schools_id)');
        $this->addSql('CREATE INDEX IDX_58085DF0A96778EC ON user_comment_school (categorys_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF067B3B43D');
        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF0A000581D');
        $this->addSql('ALTER TABLE user_comment_school DROP FOREIGN KEY FK_58085DF0A96778EC');
        $this->addSql('DROP INDEX IDX_58085DF067B3B43D ON user_comment_school');
        $this->addSql('DROP INDEX IDX_58085DF0A000581D ON user_comment_school');
        $this->addSql('DROP INDEX IDX_58085DF0A96778EC ON user_comment_school');
        $this->addSql('ALTER TABLE user_comment_school DROP users_id, DROP schools_id, DROP categorys_id');
    }
}
