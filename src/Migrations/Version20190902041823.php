<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902041823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO
           `Activity` (`id`, `name`, `description`, `price`, `popular`) 
        VALUES
           (
              1, 'Coldplay Live', 'This is an amazing concert this is happening in a big stadium	', 100, 1
           )
        , 
           (
              2, 'Real Madrid VS. Barcelona', 'El Clasico is the term used to refer to football matches between Spain?s most famous and bitterest rivals: FC Barcelona and Real Madrid C.F. The two teams meet twice during a season, with an additional two times in the Copa del Rey, Champions League, and the Supercopa de Espana, and possibly in the UEFA Super Cup as well. ', 500, 0
           )
        , 
           (
              3, 'Tour In Jerusalem', 'Our Jerusalem Tours offer a variety of different experiences in the holiest city of them all. From one day introductory tours of Jerusalem to religious-themed tours, packages tours, culinary tours, and more. The tours of Jerusalem offered by Tourist Israel include something for everyone, from the most popular Jerusalem one day tours featuring the highlights of the Old and New parts of this city to Christian and Jewish focused tours following in the footsteps of the Biblical stories. For those on a more limited timeframe, our combined Jerusalem and Dead Sea or Jerusalem and Bethlehem one day tours are a perfect option for taking in even more in a short timeframe, and for those with more specific dreams, check out our private tours or off-the-beaten-track ways to explore Jerusalem. You might have a limited time to tour Jerusalem, and we invite you to make that time special and spend it with Tourist Israel and our team of professional guides. Our team is standing by to help you make your Jerusalem tours simply unforgettable.', 75, 0
           )
        , 
           (
              4, 'Tour In Amsterdam', 'During this tour you will visit the picturesque fishing villages of Volendam and Marken. You will drive through typical Dutch polders and along narrow dykes. Our luxury coach will take you to the Zaanse Schans and its many unique windmills. The old crafts of the Netherlands are not lacking in this tour. You will visit a wooden clog maker and you can see how Dutch cheese is made the traditional way.', 55, 0
           )
        ;
        INSERT INTO
           `Activity_category` (`id`, `name`) 
        VALUES
           (
              1, 'Tour'
           )
        , 
           (
              2, 'Family'
           )
        , 
           (
              3, 'Sport'
           )
        , 
           (
              4, 'Football'
           )
        , 
           (
              5, 'Music'
           )
        , 
           (
              6, 'Concert'
           )
        ;
        INSERT INTO
           `Activity_Category_link` (`id`, `Activity_id`, `Category_id`) 
        VALUES
           (
              1, 1, 2
           )
        , 
           (
              2, 1, 5
           )
        , 
           (
              3, 1, 6
           )
        , 
           (
              4, 2, 3
           )
        , 
           (
              5, 2, 4
           )
        , 
           (
              6, 3, 2
           )
        , 
           (
              7, 3, 1
           )
        , 
           (
              8, 4, 2
           )
        , 
           (
              9, 4, 1
           )
        ;
        INSERT INTO
           `Activity_images_link` (`id`, `Activity_id`, `image_url`) 
        VALUES
           (
              1, 1, 'https://media.vanityfair.com/photos/5759b44ce5ce54f83ee20db5/master/w_768,c_limit/beyonce-formation-tour-citifield-new-york.jpg'
           )
        , 
           (
              2, 1, 'https://s.hdnux.com/photos/25/21/22/5575832/3/920x920.jpg'
           )
        , 
           (
              3, 1, 'https://pmcvariety.files.wordpress.com/2018/09/on-the-run-ii-review.jpg?w=1000'
           )
        , 
           (
              4, 2, 'https://images.beinsports.com/qVZGJbNP9BkoPlsoGtkugejuzEI=/820x520/smart/1011348-GettyImages-480214229.jpg'
           )
        , 
           (
              5, 2, 'https://images.beinsports.com/QU2kCoef4ZRP7NUe0jcRTgBBJvc=/820x520/smart/729684-8-ronaldinho-getty.jpg'
           )
        , 
           (
              6, 2, 'https://images.beinsports.com/1m1Ta0HzXe2umxIBAfGl3UGh-gI=/820x520/smart/417905-intro.png'
           )
        , 
           (
              7, 3, 'https://www.touristisrael.com/wp-content/uploads/Old-City.jpg'
           )
        , 
           (
              8, 3, 'https://www.touristisrael.com/wp-content/uploads/IMG_8880-001-1.jpg'
           )
        , 
           (
              9, 3, 'https://www.touristisrael.com/wp-content/uploads/21-Israel500-1.jpg'
           )
        , 
           (
              10, 4, 'https://tours-cdn2.azureedge.net/cid66/3865/207923.jpg'
           )
        , 
           (
              11, 4, 'https://tours-cdn.azureedge.net/cid66/3865/70015.jpg'
           )
        , 
           (
              12, 4, 'https://tours-cdn.azureedge.net/cid66/3865/144057.jpg'
           )
        ;
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("
        SET FOREIGN_KEY_CHECKS = 0; -- Disable foreign key checking.
        TRUNCATE TABLE Activity_images_link;
        TRUNCATE TABLE Activity_Category_link;
        TRUNCATE TABLE Activity_category;
        TRUNCATE TABLE Activity;
        SET FOREIGN_KEY_CHECKS = 1; -- Enable foreign key checking.
        ");
    }
}
