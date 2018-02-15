<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215190149 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE assinatura_categoria (id INT AUTO_INCREMENT NOT NULL, assinatura_id INT NOT NULL, categoria_id INT NOT NULL, INDEX IDX_A0A0768B9757A0A7 (assinatura_id), INDEX IDX_A0A0768B3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assinatura_categoria ADD CONSTRAINT FK_A0A0768B9757A0A7 FOREIGN KEY (assinatura_id) REFERENCES assinatura (id)');
        $this->addSql('ALTER TABLE assinatura_categoria ADD CONSTRAINT FK_A0A0768B3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE assinatura CHANGE genus_id genus_id INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE assinatura_categoria');
        $this->addSql('ALTER TABLE assinatura CHANGE genus_id genus_id INT DEFAULT NULL');
    }
}
