<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720104655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD content_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939884A0A3ED FOREIGN KEY (content_id) REFERENCES order_content (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939884A0A3ED ON `order` (content_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939884A0A3ED');
        $this->addSql('DROP INDEX UNIQ_F529939884A0A3ED ON `order`');
        $this->addSql('ALTER TABLE `order` DROP content_id');
    }
}
