-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 14 nov. 2021 à 20:19
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `modalweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `place` text NOT NULL,
  `photo` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `title`, `description`, `price`, `place`, `photo`, `category_id`, `user_email`, `quantity`) VALUES
(4, 'bracelet à fleur multicolore', 'idéal pour mettre un peu de couleur lors d\'une soirée', '0.50', '09.20.45', 'IMGBB2D', 9, 'cyp@gmail.com', 25),
(5, 'Montre décathlon noire', 'C\'est celle conseillée pour l\'inkorpo mais qui l\'utilise en dehors ?', '3.00', '11.20.22', 'IMG9966', 7, 'alice', 1),
(6, 'Calculatrice graphique', 'Calculatrice graphique old school. \r\nLes piles AAA sont utilisées rapidement.\r\n\r\nA part ça elle marche très bien', '20.00', '11.20.22', 'IMGB35A', 1, 'alice', 1),
(7, 'Balance', 'Une balance simple et efficace pour peser votre nourriture lorsque toutes celles du BE sont en panne \r\n\r\nce qui n\'arrive bien évidemment jamais... ahah', '8.50', '11.20.22', 'IMG56D6', 3, 'alice', 1),
(8, 'petite casserole', 'petite casserole plus toute neuve', '11.00', '71.30.03', 'IMG1F13', 3, 'bob', 1),
(9, 'moyenne casserole', 'Comme on dit chez moi : c\'est dans les vieilles casseroles qu\'on fait les meilleures pates !', '15.00', '71.30.03', 'IMGE728', 3, 'bob', 1),
(10, 'poele', 'RAS', '15.00', '71.30.03', 'IMG87A3', 3, 'bob', 1),
(11, 'Sacs poubelles', 'Ils sont tous neufs : c\'était des provisions pour un  évènement familial annulé avec le covid', '1.00', '71.30.03', 'IMGAC55', 6, 'bob', 5),
(12, 'multiprise', '1 mètre de cable, 4 prises', '3.00', '09.20.45', 'IMG2948', 7, 'cyp@gmail.com', 1),
(13, 'Porto', 'Porto Taylor 10 ans d\'âge, prix d\'achat au Portugal', '22.00', '09.20.45', 'IMGE08F', 4, 'cyp@gmail.com', 1),
(14, 'Porto', 'Très bon porto acheté au Portugal au même prix', '17.00', '09.20.45', 'IMG85F9', 4, 'cyp@gmail.com', 1),
(15, 'Paillasson', 'Paillasson simple et efficace à mettre devant son casert', '10.00', '09.20.45', 'IMG34C9', 6, 'cyp@gmail.com', 1),
(16, 'Brosse de toilettes', 'N\'a servi qu\'une semaine avant de pouvoir récupérer la mienne chez mes parents', '2.00', '11.30.12', 'IMG7D35', 6, 'Charlesv@hotmail.com', 1),
(17, 'Bol', 'Bol', '2.50', '11.30.12', 'IMGF62F', 3, 'Charlesv@hotmail.com', 1),
(18, 'Tapis de sol', 'Peu confortable mais très pratique à transporter !', '6.00', '11.30.12', 'IMG42F5', 9, 'Charlesv@hotmail.com', 1),
(19, 'Capote Durex livrées en 5 minutes max !', 'Vous pouvez m\'appeler à tout moment du jour ou de la nuit, je vous livre en toute discrétion en moins de 5 minutes !\r\n\r\ncapote à l\'unité  : 2.5€ de jour (6h-23h), 5€ de nuit (23h-6h)\r\nLe paquet de 6 :  12€ de jour (6h-23h), 15€ de nuit (23h-6h)', '2.50', 'Je vous le livre', 'IMG1A2C', 6, 'a@a.a', 100),
(20, 'Rouleau de PQ livré en 5 minutes max !', 'Une envie pressante et pas de PQ chez vous ? En plus les toilettes publiques sont dégueulasses ?\r\n\r\nAppelez-moi, je vous livre rapidement et en toute discrétion !\r\n\r\n2€le jour, 5€ la nuit', '2.00', 'Je vous le livre', 'IMGE6F7', 6, 'a@a.a', 100),
(21, 'Lunettes love', 'De superbes lunettes qui changent de couleur en fonction de la lumière pour envoyer plein d\'amour à tous ceux que vous aimez !!', '5.00', '74.10.05', 'IMG3633', 2, 'margaux.bouvier@yahoo.fr', 6),
(22, 'feuilles A4', 'paquets de 100 feuilles A4 blanches, vertes ou jaunes que j\'ai acheté lorsque j\'avais encore l\'illusion que je prendrais des notes en cours. \r\nJe souhaite désormais m\'en débarrasser !', '0.50', '74.10.05', 'IMG2207', 1, 'margaux.bouvier@yahoo.fr', 8),
(23, 'Dessous de plat métalique', 'La photo suffit', '3.00', '74.10.05', 'IMG51B0', 3, 'margaux.bouvier@yahoo.fr', 2),
(24, 'Enceinte bluetooth', 'JBL GO3 petite avec un très bon son !', '20.00', '74.10.05', 'IMG48EE', 9, 'margaux.bouvier@yahoo.fr', 1),
(25, 'spatule en bois', 'spatule en bois', '2.00', '74.10.05', 'IMGD2D1', 3, 'margaux.bouvier@yahoo.fr', 1),
(26, 'spatule', 'spatule', '2.00', '74.10.05', 'IMG2577', 3, 'margaux.bouvier@yahoo.fr', 1),
(27, 'cours particulier', 'Je m\'ennuie un peu pendant mon stage 3A que j\'effectue juste à côté du platal.\r\n\r\nJe suis disponible pour donner des cours particulier en MAT, BIO et CHIM de 1A ou 2A\r\nle mardi, mercredi et vendredi entre 13h et 20h, envoyez moi un message pour plus d\'info', '0.00', '10.40.62', 'IMGEDC2', 8, 'JeoffroiBrg@gmail.com', 1),
(28, 'Plaque du BE', 'La plaque qu\'on a acheté pour le BE n\'est pas aux bonne dimension...', '150.00', '10.40.20', 'IMG622B', 3, 'Lsgrr@gmail.com', 1),
(29, 'stabilo', 'noir bleu ou rouge', '1.00', '10.40.20', 'IMGF7AE', 1, 'Lsgrr@gmail.com', 17),
(30, 'Chaise', 'plus agréable et plus résistante que celles en plastiques des caserts', '39.90', '10.40.20', 'IMG2FF1', 6, 'Lsgrr@gmail.com', 1),
(31, 'Switch ethernet', 'idéal pour organiser une LAN dans son casert sans passer par la connexion wifi qui ne fonctionne jamais', '10.00', '09.20.45', 'IMG7242', 7, 'cyp@gmail.com', 1),
(32, 'cable ethernet', '2m de long\r\n\r\nbien plus fiable que le wifi en mousse', '5.00', '09.20.45', 'IMG6C83', 7, 'cyp@gmail.com', 3);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'matériel scolaire'),
(2, 'vêtements'),
(3, 'ustensiles de cuisine'),
(4, 'boisson'),
(6, 'à avoir dans son casert'),
(7, 'électronique'),
(8, 'service'),
(9, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`email`, `password`, `nom`, `prenom`, `phone`, `address`, `is_admin`) VALUES
('a@a.a', '$2y$10$mN8gI011MxcKbYkoe5LMBuKfNOlx95UpdO0sb.rnreZbSoSkCQhny', 'Livreur', 'Anonyme', '0663921837', '00.00.00', 0),
('alice', '$2y$10$/kfPasg1RqDROXaSn7jbmehRzVRP1uErGwVepi3O7YaXI.5nEZL92', 'Beaudoin', 'Alice', '0739857131', '11.20.22', 1),
('bob', '$2y$10$IiAknB4cJuWMd1eO6/9ooOoGRLPNSdlNylHjGq96.qhq8rSaokQ1y', 'Lessard', 'Bob', '0623998128', '71.30.03', 0),
('Charlesv@hotmail.com', '$2y$10$bOqVDb.elE8Hc5EJN7tO1uto0tdANjesk1exuHLIwxhwlLb1g69mK', 'Charles', 'Van Damme', '0729318233', '11.30.12', 0),
('cyp@gmail.com', '$2y$10$31os7JcLKXgojtJIXH4YX.z5lAm.GK4.DoT4wGytNCxselBY7C0r2', 'Raffi', 'Cyprien', '0695341520', '09.20.45', 1),
('JeoffroiBrg@gmail.com', '$2y$10$wFKf/FNRf4iRfRg.u2U03u.iniYrWShK1gUz.iT3BOkJLa6ms7a.q', 'Bourgeau', 'Jeoffroi', '0722981751', '10.40.62', 0),
('Lsgrr@gmail.com', '$2y$10$7KwlihRzdT7aiSYLSp.n.eFp02XPP5k0tv71TnIIOsAWVGgWZLBgG', 'Garreau', 'Louis', '0774951803', '10.40.20', 0),
('margaux.bouvier@yahoo.fr', '$2y$10$uhYIqAGQfmV9xLPtVl3rFONHEP4y2V1zK.rUni8P3FqMu14N2Y7oy', 'Bouvier', 'Margaux', '0723948211', '74.10.05', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `username` (`user_email`);
ALTER TABLE `annonce` ADD FULLTEXT KEY `title` (`title`,`description`,`place`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_3` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
