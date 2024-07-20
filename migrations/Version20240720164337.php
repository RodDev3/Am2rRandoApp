<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240720164337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE areas ADD ref_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE areas ADD CONSTRAINT FK_58B0B25C120CB35 FOREIGN KEY (ref_parent_id) REFERENCES areas (id)');
        $this->addSql('CREATE INDEX IDX_58B0B25C120CB35 ON areas (ref_parent_id)');
        $this->addSql('ALTER TABLE rooms ADD short_name VARCHAR(255) DEFAULT NULL, CHANGE name basename VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE areas DROP FOREIGN KEY FK_58B0B25C120CB35');
        $this->addSql('DROP INDEX IDX_58B0B25C120CB35 ON areas');
        $this->addSql('ALTER TABLE areas DROP ref_parent_id');
        $this->addSql('ALTER TABLE rooms DROP short_name, CHANGE basename name VARCHAR(255) NOT NULL');
    }
}
