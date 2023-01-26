<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126111421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dispositions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terrain_dispositions (terrain_id INT NOT NULL, dispositions_id INT NOT NULL, INDEX IDX_4034DBE18A2D8B41 (terrain_id), INDEX IDX_4034DBE139E25885 (dispositions_id), PRIMARY KEY(terrain_id, dispositions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE terrain_dispositions ADD CONSTRAINT FK_4034DBE18A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE terrain_dispositions ADD CONSTRAINT FK_4034DBE139E25885 FOREIGN KEY (dispositions_id) REFERENCES dispositions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE terrain_dispositions DROP FOREIGN KEY FK_4034DBE18A2D8B41');
        $this->addSql('ALTER TABLE terrain_dispositions DROP FOREIGN KEY FK_4034DBE139E25885');
        $this->addSql('DROP TABLE dispositions');
        $this->addSql('DROP TABLE terrain_dispositions');
    }
}
