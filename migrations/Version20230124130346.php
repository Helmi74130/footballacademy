<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124130346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, time_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, INDEX IDX_264E43A65EEADD3B (time_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A65EEADD3B FOREIGN KEY (time_id) REFERENCES time (id)');
        $this->addSql('ALTER TABLE terrain ADD locate VARCHAR(255) NOT NULL, DROP playernumber, DROP remplacant, DROP active');
        $this->addSql('ALTER TABLE time ADD user_id INT DEFAULT NULL, ADD terrain_id INT DEFAULT NULL, ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F9498458A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_6F949845A76ED395 ON time (user_id)');
        $this->addSql('CREATE INDEX IDX_6F9498458A2D8B41 ON time (terrain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A65EEADD3B');
        $this->addSql('DROP TABLE players');
        $this->addSql('ALTER TABLE terrain ADD playernumber INT DEFAULT NULL, ADD remplacant INT DEFAULT NULL, ADD active TINYINT(1) NOT NULL, DROP locate');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F949845A76ED395');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F9498458A2D8B41');
        $this->addSql('DROP INDEX IDX_6F949845A76ED395 ON time');
        $this->addSql('DROP INDEX IDX_6F9498458A2D8B41 ON time');
        $this->addSql('ALTER TABLE time DROP user_id, DROP terrain_id, DROP price');
    }
}
