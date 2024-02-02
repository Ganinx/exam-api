<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202102630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F804D3B9A625945B ON employe');
        $this->addSql('DROP INDEX UNIQ_F804D3B96C6E55B5 ON employe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F804D3B9A625945B ON employe (prenom)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F804D3B96C6E55B5 ON employe (nom)');
    }
}
