-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 jan. 2018 à 14:24
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `category` varchar(30) CHARACTER SET latin1 NOT NULL,
  `brand` varchar(30) CHARACTER SET latin1 NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `status` varchar(15) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `receipt` varchar(3) DEFAULT NULL,
  `warrantly` varchar(3) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `delivery` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_seller` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_buyer` int(11) DEFAULT NULL,
  `id_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `FK_item_id_user` (`id_seller`),
  KEY `FK_item_id_user_1` (`id_buyer`),
  KEY `FK_item_id_rating` (`id_rating`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `date`, `name`, `category`, `brand`, `price`, `status`, `description`, `receipt`, `warrantly`, `purchase_date`, `delivery`, `id_seller`, `photo`, `id_buyer`, `id_rating`) VALUES
(3, '2018-01-15', 'Bobo Dupont', 'xbox one', 'sony', '24.99', 'BonEtat', 'dsetr ytrgt erg', 'Non', 'Non', NULL, NULL, 7, 'img/photo5a5cb59bb050a.jpg', NULL, NULL),
(4, '2018-01-15', 'jean', 'ps4', 'sony', '24.99', 'Neuf', 'zezfre gtregrdvf ', 'Non', 'Non', NULL, NULL, 7, 'img/photo5a5cb85a64aaa.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `photos_item`
--

DROP TABLE IF EXISTS `photos_item`;
CREATE TABLE IF NOT EXISTS `photos_item` (
  `id_photo` int(11) DEFAULT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id_rating` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rating`),
  KEY `FK_rating_id_item` (`id_item`),
  KEY `FK_rating_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `details` varchar(50) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `last_name`, `first_name`, `mail`, `password`, `date_of_birth`, `address`, `details`, `postal_code`, `city`, `country`, `phone`, `photo`) VALUES
(1, 'm4ria_dos', 'Dupont', 'Bobo', 'bobo@bobo.fr', '$2a$07$azds8dfbn2sdseferd54ge6T7BN56NFHCKWcV1Di1TduGbm4lDx4W', '1965-02-23', '2 rue des chaussÃ©es', 'appt 5', 75001, 'Paris', 'France', 123456789, ''),
(3, 'hello', 'Dupont', 'Bobo', 'bobo2@bobo.fr', '$2a$07$azds8dfbn2sdseferd54ge6T7BN56NFHCKWcV1Di1TduGbm4lDx4W', '1965-02-23', '2 rue des chaussÃ©es', 'appt 5', 75001, 'Paris', 'France', 123456789, ''),
(4, 'liveforfries', 'Live', 'Fries', 'fries@fries.fr', '$2a$07$azds8dfbn2sdseferd54geWxh16sCmAFDyPpfxYtiis5aAOEjt/wG', '1965-02-23', '2 rue des chaussÃ©es', 'appt 5', 75001, 'Paris', 'France', 123456789, ''),
(5, 'likeanao', 'Paulmin', 'Naomi', 'naomi@n.fr', '$2a$07$azds8dfbn2sdseferd54geIsNh/QtGyifcEtD8lDyHEL13xdot.AO', '1987-06-15', '2 rue des chaussÃ©es', 'appt 5', 75001, 'Paris', 'France', 123456789, ''),
(6, 'bobo_007', 'Dupont', 'done', 'do@do.fr', '$2a$07$azds8dfbn2sdseferd54ge3DWC2m7n7srSrv.itP8N74/N35Gga3C', '2017-12-23', '5 PLACE JOSEPH FRANTZ', 'appt 5', 92100, 'Boulogne-Billancourt', 'France', 354892145, ''),
(7, 'thanu', 'thanu', 'thanu', 'thanu@star.fr', '$2a$07$azds8dfbn2sdseferd54geQEOpxrjh2bFI3iq18MGN5i3vFQFqtCm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'theepa', 'theepa', 'theepa', 'theepa@theepa.fr', '$2a$07$azds8dfbn2sdseferd54genfEme4um2/Ts059iUIApu1URQLuc2uu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_item_id_rating` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id_rating`),
  ADD CONSTRAINT `FK_item_id_user` FOREIGN KEY (`id_seller`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_item_id_user_1` FOREIGN KEY (`id_buyer`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_rating_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`),
  ADD CONSTRAINT `FK_rating_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
