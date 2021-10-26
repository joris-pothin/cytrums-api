<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027085821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accomodation (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, cost_id INT DEFAULT NULL, event_id INT NOT NULL, begin_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_520D81B3F5B7AF75 (address_id), UNIQUE INDEX UNIQ_520D81B31DBF857F (cost_id), INDEX IDX_520D81B371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accomodation_user (accomodation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5261A94DFD70509C (accomodation_id), INDEX IDX_5261A94DA76ED395 (user_id), PRIMARY KEY(accomodation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, cost_id INT DEFAULT NULL, event_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, begin_date DATETIME NOT NULL, end_date DATETIME NOT NULL, min_participants INT DEFAULT NULL, max_participants INT DEFAULT NULL, equipments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_AC74095AF5B7AF75 (address_id), UNIQUE INDEX UNIQ_AC74095A1DBF857F (cost_id), INDEX IDX_AC74095A71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_user (activity_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8E570DDB81C06096 (activity_id), INDEX IDX_8E570DDBA76ED395 (user_id), PRIMARY KEY(activity_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address_user_id INT NOT NULL, title VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) NOT NULL, postcode VARCHAR(10) NOT NULL, INDEX IDX_D4E6F81FC8B240D (address_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, code INT NOT NULL, INDEX IDX_2D5B0234F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cost (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, paid_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, paid TINYINT(1) DEFAULT NULL, INDEX IDX_182694FC71F7E88B (event_id), INDEX IDX_182694FC7F9BC654 (paid_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, libelle VARCHAR(255) NOT NULL, cee INT NOT NULL, id_type INT NOT NULL, tva TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_3BAE0AA7F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, address_from_id INT NOT NULL, address_to_id INT NOT NULL, cost_id INT DEFAULT NULL, event_id INT NOT NULL, type VARCHAR(255) NOT NULL, date_departure DATETIME NOT NULL, duration DOUBLE PRECISION NOT NULL, INDEX IDX_66AB212E232B2E93 (address_from_id), INDEX IDX_66AB212E7903D45 (address_to_id), UNIQUE INDEX UNIQ_66AB212E1DBF857F (cost_id), INDEX IDX_66AB212E71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(32) DEFAULT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accomodation ADD CONSTRAINT FK_520D81B3F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE accomodation ADD CONSTRAINT FK_520D81B31DBF857F FOREIGN KEY (cost_id) REFERENCES cost (id)');
        $this->addSql('ALTER TABLE accomodation ADD CONSTRAINT FK_520D81B371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE accomodation_user ADD CONSTRAINT FK_5261A94DFD70509C FOREIGN KEY (accomodation_id) REFERENCES accomodation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE accomodation_user ADD CONSTRAINT FK_5261A94DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A1DBF857F FOREIGN KEY (cost_id) REFERENCES cost (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE activity_user ADD CONSTRAINT FK_8E570DDB81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_user ADD CONSTRAINT FK_8E570DDBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81FC8B240D FOREIGN KEY (address_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FC71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FC7F9BC654 FOREIGN KEY (paid_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E232B2E93 FOREIGN KEY (address_from_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E7903D45 FOREIGN KEY (address_to_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1DBF857F FOREIGN KEY (cost_id) REFERENCES cost (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accomodation_user DROP FOREIGN KEY FK_5261A94DFD70509C');
        $this->addSql('ALTER TABLE activity_user DROP FOREIGN KEY FK_8E570DDB81C06096');
        $this->addSql('ALTER TABLE accomodation DROP FOREIGN KEY FK_520D81B3F5B7AF75');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AF5B7AF75');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F5B7AF75');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E232B2E93');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E7903D45');
        $this->addSql('ALTER TABLE accomodation DROP FOREIGN KEY FK_520D81B31DBF857F');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A1DBF857F');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1DBF857F');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE accomodation DROP FOREIGN KEY FK_520D81B371F7E88B');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A71F7E88B');
        $this->addSql('ALTER TABLE cost DROP FOREIGN KEY FK_182694FC71F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E71F7E88B');
        $this->addSql('ALTER TABLE accomodation_user DROP FOREIGN KEY FK_5261A94DA76ED395');
        $this->addSql('ALTER TABLE activity_user DROP FOREIGN KEY FK_8E570DDBA76ED395');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81FC8B240D');
        $this->addSql('ALTER TABLE cost DROP FOREIGN KEY FK_182694FC7F9BC654');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('DROP TABLE accomodation');
        $this->addSql('DROP TABLE accomodation_user');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_user');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE cost');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE `user`');
    }
}
