<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118083723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_avis (user_id INT NOT NULL, avis_id INT NOT NULL, INDEX IDX_F510E739A76ED395 (user_id), INDEX IDX_F510E739197E709F (avis_id), PRIMARY KEY(user_id, avis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_covoiturage (user_id INT NOT NULL, covoiturage_id INT NOT NULL, INDEX IDX_81DC571CA76ED395 (user_id), INDEX IDX_81DC571C62671590 (covoiturage_id), PRIMARY KEY(user_id, covoiturage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_avis ADD CONSTRAINT FK_F510E739A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_avis ADD CONSTRAINT FK_F510E739197E709F FOREIGN KEY (avis_id) REFERENCES avis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_covoiturage ADD CONSTRAINT FK_81DC571CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_covoiturage ADD CONSTRAINT FK_81DC571C62671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649181A8BA ON user (voiture_id)');
        $this->addSql('ALTER TABLE voiture ADD covoiturage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F62671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F62671590 ON voiture (covoiturage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_avis DROP FOREIGN KEY FK_F510E739A76ED395');
        $this->addSql('ALTER TABLE user_avis DROP FOREIGN KEY FK_F510E739197E709F');
        $this->addSql('ALTER TABLE user_covoiturage DROP FOREIGN KEY FK_81DC571CA76ED395');
        $this->addSql('ALTER TABLE user_covoiturage DROP FOREIGN KEY FK_81DC571C62671590');
        $this->addSql('DROP TABLE user_avis');
        $this->addSql('DROP TABLE user_covoiturage');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649181A8BA');
        $this->addSql('DROP INDEX IDX_8D93D649181A8BA ON user');
        $this->addSql('ALTER TABLE user DROP voiture_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F62671590');
        $this->addSql('DROP INDEX IDX_E9E2810F62671590 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP covoiturage_id');
    }
}
