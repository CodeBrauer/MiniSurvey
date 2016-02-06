CREATE DATABASE `survey`;
USE `survey`;

DROP TABLE IF EXISTS `answers`;

CREATE TABLE `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `survey` int(11) DEFAULT NULL,
  `value` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fc_survey` (`survey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `answers` WRITE;

INSERT INTO `answers` (`id`, `survey`, `value`, `created`)
VALUES
    (1,1,'1','2016-02-06 21:12:38'),
    (2,1,'1','2016-02-06 21:18:19'),
    (3,1,'1','2016-02-06 21:18:25');

UNLOCK TABLES;

DROP TABLE IF EXISTS `survey_questions`;

CREATE TABLE `survey_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `survey` int(11) NOT NULL,
  `question` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `survey_questions` WRITE;

INSERT INTO `survey_questions` (`id`, `survey`, `question`, `created`)
VALUES
    (1,1,'potato chips','2016-02-06 21:08:26'),
    (2,1,'nuts','2016-02-06 21:08:53'),
    (3,1,'saltsticks','2016-02-06 21:09:07'),
    (4,1,'fruits','2016-02-06 21:09:10'),
    (5,1,'breadsticks','2016-02-06 21:09:28'),
    (6,2,'Quick and Dirty','2016-02-06 21:10:36'),
    (7,2,'Depends on the problem','2016-02-06 21:11:01'),
    (8,2,'Slow and accurate','2016-02-06 21:11:57');

UNLOCK TABLES;

DROP TABLE IF EXISTS `surveys`;

CREATE TABLE `surveys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `surveys` WRITE;

INSERT INTO `surveys` (`id`, `title`, `created`)
VALUES
    (1,'What is your favorite snack?','2016-02-06 21:07:10'),
    (2,'How do you fix a problem?','2016-02-06 21:10:12');

UNLOCK TABLES;