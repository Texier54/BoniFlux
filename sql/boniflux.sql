-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 06 mars 2018 à 21:24
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boniflux`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id` int(11) NOT NULL,
  `id_streamer` int(11) DEFAULT NULL,
  `id_abonne` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `id_streamer`, `id_abonne`) VALUES
(1, 2, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `texte` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_stream` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `texte`, `created_at`, `updated_at`, `id_stream`, `id_user`) VALUES
(1, 'Salut toi !', NULL, NULL, 1, 1),
(2, 'dfb zef  zefzef ze fze f', NULL, NULL, 1, 1),
(3, 'qzf qzd q zdqzd qz d', NULL, NULL, 2, 1),
(4, 'qzf', '2018-03-04 15:52:34', '2018-03-04 15:52:34', 1, 1),
(5, 'hey', '2018-03-04 15:52:37', '2018-03-04 15:52:37', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stream`
--

CREATE TABLE `stream` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` longtext,
  `etat` int(11) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `anonyme` int(1) NOT NULL,
  `publique` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_urgence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stream`
--

INSERT INTO `stream` (`id`, `nom`, `description`, `etat`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`, `id_user`, `id_urgence`) VALUES
(1, 'Le jeu', 'qzqfzx zd ef ef e dee ', 1, 48.5, 6, NULL, NULL, NULL, 1, NULL),
(2, 'Le Stream', 'qz q lorem ipsd ud biuzbh qizbd iuz qlzh ouzhd ', 1, 48, 6, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `urgence`
--

CREATE TABLE `urgence` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_stream` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `email`, `password`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'test', 'test', 'test', 'test', '$2y$10$RauIFfY5p.E997L2m1vv6eFr4YC9xF6p6vtdDb8Vc09IKCuc2oFXW', NULL, NULL, NULL),
(2, 'Google', 'Google', 'Google', 'test@google.com', '$2y$10$RauIFfY5p.E997L2m1vv6eFr4YC9xF6p6vtdDb8Vc09IKCuc2oFXW', NULL, NULL, NULL),
(3, 'ty', 'ty', 'yt', 'yt@google.fr', '$2y$10$RauIFfY5p.E997L2m1vv6eFr4YC9xF6p6vtdDb8Vc09IKCuc2oFXW', NULL, NULL, NULL),
(4, 'fresh', 'fresh', 'fresh', 'fresh@test.fr', '$2y$10$RauIFfY5p.E997L2m1vv6eFr4YC9xF6p6vtdDb8Vc09IKCuc2oFXW', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` longtext,
  `token` varchar(255) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_message_id_stream` (`id_stream`),
  ADD KEY `FK_message_id_user` (`id_user`);

--
-- Index pour la table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_stream_id_user` (`id_user`),
  ADD KEY `FK_stream_id_urgence` (`id_urgence`);

--
-- Index pour la table `urgence`
--
ALTER TABLE `urgence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_urgence_id_stream` (`id_stream`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_video_id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `stream`
--
ALTER TABLE `stream`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `urgence`
--
ALTER TABLE `urgence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id_stream` FOREIGN KEY (`id_stream`) REFERENCES `stream` (`id`),
  ADD CONSTRAINT `FK_message_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stream`
--
ALTER TABLE `stream`
  ADD CONSTRAINT `FK_stream_id_urgence` FOREIGN KEY (`id_urgence`) REFERENCES `urgence` (`id`),
  ADD CONSTRAINT `FK_stream_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `urgence`
--
ALTER TABLE `urgence`
  ADD CONSTRAINT `FK_urgence_id_stream` FOREIGN KEY (`id_stream`) REFERENCES `stream` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_video_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
