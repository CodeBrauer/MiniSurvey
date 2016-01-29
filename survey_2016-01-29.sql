# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Datenbank: survey
# Erstellt am: 2016-01-29 11:14:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle answers
# ------------------------------------------------------------

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
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;

INSERT INTO `answers` (`id`, `survey`, `value`, `created`)
VALUES
	(16,1,'2','2016-01-29 10:58:21'),
	(17,1,'7','2016-01-29 11:03:53'),
	(18,1,'7','2016-01-29 11:03:54'),
	(19,1,'7','2016-01-29 11:03:55'),
	(20,1,'7','2016-01-29 11:03:55'),
	(21,1,'7','2016-01-29 11:03:56'),
	(22,1,'7','2016-01-29 11:03:56'),
	(23,1,'7','2016-01-29 11:03:57'),
	(24,1,'7','2016-01-29 11:03:57'),
	(25,1,'7','2016-01-29 11:03:58'),
	(26,1,'7','2016-01-29 11:03:58'),
	(27,1,'7','2016-01-29 11:03:59'),
	(28,1,'7','2016-01-29 11:03:59'),
	(29,1,'7','2016-01-29 11:03:59'),
	(30,1,'7','2016-01-29 11:04:00'),
	(31,1,'7','2016-01-29 11:04:00'),
	(32,1,'3','2016-01-29 11:04:02'),
	(33,1,'3','2016-01-29 11:04:03'),
	(34,1,'3','2016-01-29 11:04:04'),
	(35,1,'3','2016-01-29 11:04:05'),
	(36,1,'3','2016-01-29 11:04:06'),
	(37,1,'3','2016-01-29 11:04:17'),
	(38,1,'3','2016-01-29 11:04:24'),
	(39,1,'8','2016-01-29 11:04:33'),
	(40,1,'3','2016-01-29 12:00:14'),
	(41,2,'11','2016-01-29 12:05:01'),
	(42,2,'10','2016-01-29 12:05:20'),
	(43,1,'8','2016-01-29 12:10:04');

/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle survey_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `survey_questions`;

CREATE TABLE `survey_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `survey` int(11) NOT NULL,
  `question` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `survey_questions` WRITE;
/*!40000 ALTER TABLE `survey_questions` DISABLE KEYS */;

INSERT INTO `survey_questions` (`id`, `survey`, `question`, `created`)
VALUES
	(1,1,'C++','2016-01-29 10:12:31'),
	(2,1,'Javascript','2016-01-29 10:12:34'),
	(3,1,'Perl','2016-01-29 10:12:34'),
	(4,1,'Python','2016-01-29 10:12:34'),
	(5,1,'C','2016-01-29 10:12:34'),
	(7,1,'PHP','2016-01-29 10:12:34'),
	(8,1,'keine, Programming sucks!','2016-01-29 10:59:20'),
	(9,2,'Breaking Bad','2016-01-29 12:01:17'),
	(10,2,'The Walking Dead','2016-01-29 12:01:23'),
	(11,2,'The Big Bang Theory','2016-01-29 12:01:57');

/*!40000 ALTER TABLE `survey_questions` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle surveys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `surveys`;

CREATE TABLE `surveys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;

INSERT INTO `surveys` (`id`, `title`, `created`)
VALUES
	(1,'Welche ist Ihre liebste Programmiersprache?','2016-01-25 12:27:35'),
	(2,'Was ist Ihre liebste Serie?','2016-01-29 12:01:10');

/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
