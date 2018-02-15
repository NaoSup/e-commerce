-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 15 fév. 2018 à 16:08
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

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
  `date` datetime DEFAULT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `category` varchar(30) CHARACTER SET latin1 NOT NULL,
  `brand` varchar(30) CHARACTER SET latin1 NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `status` varchar(15) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `receipt` varchar(3) DEFAULT NULL,
  `warranty` varchar(3) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `id_seller` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_buyer` int(11) DEFAULT NULL,
  `sell_date` date DEFAULT NULL,
  `id_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `FK_item_id_user` (`id_seller`),
  KEY `FK_item_id_user_1` (`id_buyer`),
  KEY `FK_item_id_rating` (`id_rating`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `date`, `name`, `category`, `brand`, `price`, `status`, `description`, `receipt`, `warranty`, `purchase_date`, `id_seller`, `photo`, `id_buyer`, `sell_date`, `id_rating`) VALUES
(1, '2018-02-15 16:05:38', 'Assassin\'s Creed Origins', 'ps4', 'Ubisoft', '55.00', 'TrÃ¨s Bon Etat', 'Voyagez Ã  travers lâ€™Ã‰gypte antique, le lieu le plus mystÃ©rieux de lâ€™histoire, durant une pÃ©riode cruciale qui a forgÃ© le monde. DÃ©couvrez les secrets derriÃ¨re les Grandes Pyramides, les mythes oubliÃ©s, les derniers pharaons et â€“ gravÃ© dans des hiÃ©roglyphes disparus â€“ lâ€™histoire originelle de la ConfrÃ©rie des Assassins. DÃ©couvrez une toute nouvelle faÃ§on de combattre, affrontez plusieurs ennemis en mÃªme temps et passez dâ€™une arme de mÃªlÃ©e Ã  une arme Ã  distance en un clin dâ€™Å“il. Choisissez vos compÃ©tences dâ€™Assassin tout en explorant le pays entier de lâ€™Ã‰gypte antique et prenez part Ã  de multiples quÃªtes et histoires captivantes Ã  travers un voyage qui bouleversera la civilisation Ã‰gyptienne.', 'Oui', 'Oui', '2017-11-02', 1, 'img/photo5a85a1c2260e3.png', NULL, NULL, NULL),
(2, '2018-02-15 16:10:48', 'Far Cry 5', 'pc', 'Ubisoft', '50.00', 'Bon Etat', 'Bienvenue Ã  Hope County, dans le Montana, terre de libertÃ© et de bravoure qui abrite un culte fanatique prÃªchant la fin du monde : Edenâ€™s Gate. DÃ©fiez son chef, Joseph Seed, et ses frÃ¨res et soeur, allumez les feux de la rÃ©sistance et libÃ©rez les citoyens.', 'Oui', 'Non', '2017-09-25', 2, 'img/photo5a85a2f844646.jpg', NULL, NULL, NULL),
(3, '2018-02-15 16:20:32', 'Tekken 7', 'xbox one', 'Bandai Namco', '40.00', 'Neuf', 'L\'amour, la vengeance, la fiertÃ©. Chacun a ses raisons pour se battre. Nos valeurs sont ce qui nous dÃ©finit, ce qui nous rend humains, quelles que soient nos forces et nos faiblesses. Il n\'y a pas de mauvaises motivations, seulement le chemin que nous choisissons.\r\n\r\nVivez la conclusion Ã©pique de la guerre du clan Mishima et dÃ©couvrez les raisons qui ont motivÃ© chacun dans leurs combats incessants. AlimentÃ© par Unreal Engine 4, Tekken 7 offre des batailles cinÃ©matiques basÃ©es sur des histoires captivantes, et des duels extraordinaires Ã  partager avec vos amis et vos rivaux grÃ¢ce aux mÃ©canismes de combats innovants.', 'Non', 'Non', NULL, 2, 'img/photo5a85a540c0b7c.png', NULL, NULL, NULL),
(4, '2018-02-15 16:21:27', 'Crash Bandicoot N Sane Trilogy', 'ps4', 'Ubisoft', '25.00', 'TrÃ¨s Bon Etat', 'Votre marsupial prÃ©fÃ©rÃ©, Crash BandicootÂ®, est de retour ! Il est re-boostÃ©, surexcitÃ©, et prÃªt Ã  se dÃ©chaÃ®ner dans la collection de jeux N. Sane Trilogy ! RedÃ©couvrez Crash Bandicoot comme jamais auparavant. Tournez, sautez, wumpez et recommencez pour surmonter des dÃ©fis Ã©piques et vivre des aventures extraordinaires dans les trois premiers jeux de la sÃ©rie : Crash BandicootÂ®, Crash BandicootÂ® 2: Cortex Strikes Back et Crash BandicootÂ®: Warped. Retrouvez Crash remasterisÃ© en HD et prÃ©parez-vous, Ã§a va WUMPER !', 'Oui', 'Non', NULL, 2, 'img/photo5a85a57744cfe.jpg', NULL, NULL, NULL),
(5, '2018-02-15 16:35:39', 'Mario + Lapins CrÃ©tins', 'switch', 'Ubisoft', '40.00', 'Neuf', 'Mario + Rabbids Kingdom Battle est un RPG en tour par tour sur Nintendo Switch qui utilise le moteur de jeu dâ€™Ubisoft, Snowdrop Engine. Il propose un systÃ¨me tour par tour, un mode co-op local, le tout sur un fond d\'humour pour lequel les deux franchises sont connues. Les joueurs peuvent choisir entre 8 personnages jouables : Mario, Luigi, Yoshi, Peach, ainsi que leurs versions Lapin CrÃ©tin.', 'Non', 'Non', '2017-05-26', 2, 'img/photo5a85a8cb326a3.JPG', NULL, NULL, NULL),
(11, '2018-02-15 17:07:45', 'Tomb Raider: Underworld', 'xbox 360', 'Eidos', '7.00', 'UsÃ©', 'Les aventures de l\'exploratrice Lara Croft continuent dans ce 8Ã¨me volet sur Xbox 360 intitulÃ© Underworld. Dans cet Ã©pisode, l\'intrÃ©pide Lara tente de percer les mystÃ¨res du calendrier maya qui prÃ©dit une fin du monde imminente. Notre globe-trotteuse doit alors se mettre Ã  la recherche du portail maudit menant vers les Enfers et qui s\'ouvrira lorsque le calendrier touchera Ã  sa fin.', 'Non', 'Non', '2009-02-15', 1, 'img/photo5a85b0514dabd.jpg', NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `last_name`, `first_name`, `mail`, `password`, `date_of_birth`, `address`, `details`, `postal_code`, `city`, `country`, `phone`, `photo`) VALUES
(1, 'Nao', 'Paulmin', 'Naomi', 'naomi.paulmin@ynov.com', '$2a$07$azds8dfbn2sdseferd54geIsNh/QtGyifcEtD8lDyHEL13xdot.AO', '1995-04-14', '43 avenue guichard', '', 78000, 'Versailles', 'France', 612559144, NULL),
(2, 'Theepa', 'Koneswaran', 'Pratheepa', 'pratheepa.koneswaran@ynov.com', '$2a$07$azds8dfbn2sdseferd54genfEme4um2/Ts059iUIApu1URQLuc2uu', '1996-11-14', '93 Bobigny street', '', 93000, 'Bobigny', 'France', 614785324, NULL);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
