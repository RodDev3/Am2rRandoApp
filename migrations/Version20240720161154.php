<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240720161154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE areas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, basename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metroids (id INT AUTO_INCREMENT NOT NULL, ref_metroids_types_id INT NOT NULL, ref_rooms_id INT NOT NULL, INDEX IDX_83D6CE69F900BEE (ref_metroids_types_id), INDEX IDX_83D6CE6834AE2C (ref_rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metroids_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, ref_areas_id INT NOT NULL, name VARCHAR(255) NOT NULL, has_item TINYINT(1) NOT NULL, INDEX IDX_7CA11A969862AB8D (ref_areas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE metroids ADD CONSTRAINT FK_83D6CE69F900BEE FOREIGN KEY (ref_metroids_types_id) REFERENCES metroids_types (id)');
        $this->addSql('ALTER TABLE metroids ADD CONSTRAINT FK_83D6CE6834AE2C FOREIGN KEY (ref_rooms_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A969862AB8D FOREIGN KEY (ref_areas_id) REFERENCES areas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metroids DROP FOREIGN KEY FK_83D6CE69F900BEE');
        $this->addSql('ALTER TABLE metroids DROP FOREIGN KEY FK_83D6CE6834AE2C');
        $this->addSql('ALTER TABLE rooms DROP FOREIGN KEY FK_7CA11A969862AB8D');
        $this->addSql('DROP TABLE areas');
        $this->addSql('DROP TABLE metroids');
        $this->addSql('DROP TABLE metroids_types');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
