-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5272
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table boniflux. abonnement
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_streamer` int(11) DEFAULT NULL,
  `id_abonne` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table boniflux. message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_stream` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_message_id_stream` (`id_stream`),
  KEY `FK_message_id_user` (`id_user`),
  CONSTRAINT `FK_message_id_stream` FOREIGN KEY (`id_stream`) REFERENCES `stream` (`id`),
  CONSTRAINT `FK_message_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table boniflux. stream
CREATE TABLE IF NOT EXISTS `stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` longtext,
  `etat` int(11) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `anonyme` int(11) NOT NULL,
  `publique` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_urgence` int(11) DEFAULT NULL,
  `stream_room_uuid` text,
  `trash` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stream_id_user` (`id_user`),
  KEY `FK_stream_id_urgence` (`id_urgence`),
  CONSTRAINT `FK_stream_id_urgence` FOREIGN KEY (`id_urgence`) REFERENCES `urgence` (`id`),
  CONSTRAINT `FK_stream_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table boniflux. urgence
CREATE TABLE IF NOT EXISTS `urgence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_stream` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_urgence_id_stream` (`id_stream`),
  CONSTRAINT `FK_urgence_id_stream` FOREIGN KEY (`id_stream`) REFERENCES `stream` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table boniflux. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table boniflux. video
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` longtext,
  `filename` text NOT NULL,
  `pseudo` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_video_id_user` (`id_user`),
  CONSTRAINT `FK_video_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
