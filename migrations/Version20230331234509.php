<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331234509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, club_id INT DEFAULT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal INT NOT NULL, number VARCHAR(255) NOT NULL, INDEX IDX_D4E6F81EFB9C8A5 (association_id), INDEX IDX_D4E6F8161190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, h4a_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, h4a_id INT NOT NULL, INDEX IDX_B8EE3872EFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE electronic_adress (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, meeting_id INT DEFAULT NULL, home_id INT DEFAULT NULL, guest_id INT DEFAULT NULL, gymnasium_id INT DEFAULT NULL, goals_id INT DEFAULT NULL, h4a_id INT NOT NULL, start_time VARCHAR(255) NOT NULL, endtime TIME NOT NULL, token VARCHAR(255) NOT NULL, app_id INT NOT NULL, report VARCHAR(255) NOT NULL, live TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_232B318C67433D9C (meeting_id), INDEX IDX_232B318C28CDC89C (home_id), INDEX IDX_232B318C9A4AA658 (guest_id), INDEX IDX_232B318C9D8C922A (gymnasium_id), UNIQUE INDEX UNIQ_232B318CBD121F24 (goals_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_referee (game_id INT NOT NULL, referee_id INT NOT NULL, INDEX IDX_43CDCC6DE48FD905 (game_id), INDEX IDX_43CDCC6D4A087CA2 (referee_id), PRIMARY KEY(game_id, referee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_event (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, game_id INT DEFAULT NULL, time INT NOT NULL, event VARCHAR(255) NOT NULL, goal VARCHAR(255) NOT NULL, INDEX IDX_99D732899E6F5DF (player_id), INDEX IDX_99D7328E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games_goals (id INT AUTO_INCREMENT NOT NULL, half_time_id INT DEFAULT NULL, end_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_38340C936FF36A9E (half_time_id), UNIQUE INDEX UNIQ_38340C93E2BD8A10 (end_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goals (id INT AUTO_INCREMENT NOT NULL, home INT NOT NULL, guest INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gymnasium (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, INDEX IDX_4E1E0001F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, h4a_id INT NOT NULL, INDEX IDX_3EB4C318EFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, registration_deadline DATETIME NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, trainer_id INT DEFAULT NULL, player_id INT DEFAULT NULL, referee_id INT DEFAULT NULL, address_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, UNIQUE INDEX UNIQ_34DCD176FB08EDF6 (trainer_id), UNIQUE INDEX UNIQ_34DCD17699E6F5DF (player_id), UNIQUE INDEX UNIQ_34DCD1764A087CA2 (referee_id), INDEX IDX_34DCD176F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, h4a_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referee (id INT AUTO_INCREMENT NOT NULL, h4a_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, league_id INT DEFAULT NULL, club_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, h4a_id INT NOT NULL, INDEX IDX_C4E0A61F58AFC4DE (league_id), INDEX IDX_C4E0A61F61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_lineup (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, home TINYINT(1) NOT NULL, INDEX IDX_BB654913E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_lineup_player (team_lineup_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_84EA71B76442B939 (team_lineup_id), INDEX IDX_84EA71B799E6F5DF (player_id), PRIMARY KEY(team_lineup_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainer (id INT AUTO_INCREMENT NOT NULL, h4a_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, meeting_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D5128A8F67433D9C (meeting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F8161190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C67433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C28CDC89C FOREIGN KEY (home_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9A4AA658 FOREIGN KEY (guest_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9D8C922A FOREIGN KEY (gymnasium_id) REFERENCES gymnasium (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CBD121F24 FOREIGN KEY (goals_id) REFERENCES games_goals (id)');
        $this->addSql('ALTER TABLE game_referee ADD CONSTRAINT FK_43CDCC6DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_referee ADD CONSTRAINT FK_43CDCC6D4A087CA2 FOREIGN KEY (referee_id) REFERENCES referee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_event ADD CONSTRAINT FK_99D732899E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE game_event ADD CONSTRAINT FK_99D7328E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE games_goals ADD CONSTRAINT FK_38340C936FF36A9E FOREIGN KEY (half_time_id) REFERENCES goals (id)');
        $this->addSql('ALTER TABLE games_goals ADD CONSTRAINT FK_38340C93E2BD8A10 FOREIGN KEY (end_id) REFERENCES goals (id)');
        $this->addSql('ALTER TABLE gymnasium ADD CONSTRAINT FK_4E1E0001F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C318EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17699E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1764A087CA2 FOREIGN KEY (referee_id) REFERENCES referee (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE team_lineup ADD CONSTRAINT FK_BB654913E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE team_lineup_player ADD CONSTRAINT FK_84EA71B76442B939 FOREIGN KEY (team_lineup_id) REFERENCES team_lineup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_lineup_player ADD CONSTRAINT FK_84EA71B799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F67433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81EFB9C8A5');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F8161190A32');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872EFB9C8A5');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C67433D9C');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C28CDC89C');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9A4AA658');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9D8C922A');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CBD121F24');
        $this->addSql('ALTER TABLE game_referee DROP FOREIGN KEY FK_43CDCC6DE48FD905');
        $this->addSql('ALTER TABLE game_referee DROP FOREIGN KEY FK_43CDCC6D4A087CA2');
        $this->addSql('ALTER TABLE game_event DROP FOREIGN KEY FK_99D732899E6F5DF');
        $this->addSql('ALTER TABLE game_event DROP FOREIGN KEY FK_99D7328E48FD905');
        $this->addSql('ALTER TABLE games_goals DROP FOREIGN KEY FK_38340C936FF36A9E');
        $this->addSql('ALTER TABLE games_goals DROP FOREIGN KEY FK_38340C93E2BD8A10');
        $this->addSql('ALTER TABLE gymnasium DROP FOREIGN KEY FK_4E1E0001F5B7AF75');
        $this->addSql('ALTER TABLE league DROP FOREIGN KEY FK_3EB4C318EFB9C8A5');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176FB08EDF6');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17699E6F5DF');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1764A087CA2');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176F5B7AF75');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F58AFC4DE');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F61190A32');
        $this->addSql('ALTER TABLE team_lineup DROP FOREIGN KEY FK_BB654913E48FD905');
        $this->addSql('ALTER TABLE team_lineup_player DROP FOREIGN KEY FK_84EA71B76442B939');
        $this->addSql('ALTER TABLE team_lineup_player DROP FOREIGN KEY FK_84EA71B799E6F5DF');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F67433D9C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649217BBB47');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE electronic_adress');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_referee');
        $this->addSql('DROP TABLE game_event');
        $this->addSql('DROP TABLE games_goals');
        $this->addSql('DROP TABLE goals');
        $this->addSql('DROP TABLE gymnasium');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE referee');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_lineup');
        $this->addSql('DROP TABLE team_lineup_player');
        $this->addSql('DROP TABLE trainer');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
    }
}
