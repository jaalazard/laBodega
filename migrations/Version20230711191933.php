<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230711191933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pimento ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE pimento ADD CONSTRAINT FK_E7B2C31BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_E7B2C31BF92F3E70 ON pimento (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pimento DROP FOREIGN KEY FK_E7B2C31BF92F3E70');
        $this->addSql('DROP INDEX IDX_E7B2C31BF92F3E70 ON pimento');
        $this->addSql('ALTER TABLE pimento DROP country_id');
    }
}
