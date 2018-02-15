<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215134902 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genus_categoria (id INT AUTO_INCREMENT NOT NULL, genus_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_C9A867E485C4074C (genus_id), INDEX IDX_C9A867E43397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genus_categoria ADD CONSTRAINT FK_C9A867E485C4074C FOREIGN KEY (genus_id) REFERENCES genus (id)');
        $this->addSql('ALTER TABLE genus_categoria ADD CONSTRAINT FK_C9A867E43397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_categoria DROP FOREIGN KEY FK_C9A867E43397707A');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE genus_categoria');
    }
}
