<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720104023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_content (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_content_pimento (order_content_id INT NOT NULL, pimento_id INT NOT NULL, INDEX IDX_F3B3D9F4377A5EB8 (order_content_id), INDEX IDX_F3B3D9F4B38ADF6B (pimento_id), PRIMARY KEY(order_content_id, pimento_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_content_pimento ADD CONSTRAINT FK_F3B3D9F4377A5EB8 FOREIGN KEY (order_content_id) REFERENCES order_content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_content_pimento ADD CONSTRAINT FK_F3B3D9F4B38ADF6B FOREIGN KEY (pimento_id) REFERENCES pimento (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_content_pimento DROP FOREIGN KEY FK_F3B3D9F4377A5EB8');
        $this->addSql('ALTER TABLE order_content_pimento DROP FOREIGN KEY FK_F3B3D9F4B38ADF6B');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('DROP TABLE order_content_pimento');
    }
}
