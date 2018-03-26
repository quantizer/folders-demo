<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Added parent column to Folder.
 */
class Version20180326214158 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE folder ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CD727ACA70 FOREIGN KEY (parent_id) REFERENCES folder (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA209CD727ACA70 ON folder (parent_id)');
    }

    public function down(Schema $schema)
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CD727ACA70');
        $this->addSql('DROP INDEX UNIQ_ECA209CD727ACA70 ON folder');
        $this->addSql('ALTER TABLE folder DROP parent_id');
    }
}
