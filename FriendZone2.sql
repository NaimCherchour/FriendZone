-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 12 mai 2023 à 02:33
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `FriendZone2`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `pid`, `uid`, `content`, `date`) VALUES
(89, 99, 15, 'T&#039;as oublié le ; 😆', '2023-05-07 19:03:42'),
(90, 97, 15, 'psg &gt;&gt;&gt;&gt;', '2023-05-07 19:03:55'),
(91, 99, 14, 'Haha Bien vu Anne', '2023-05-07 19:04:39'),
(92, 101, 14, 'Bon courage  ', '2023-05-07 19:05:07'),
(94, 104, 14, 'Bonne appétit', '2023-05-07 19:06:57'),
(95, 104, 15, 'Merci Jean 😁', '2023-05-07 19:07:49'),
(96, 100, 16, 'j&#039;adore cet ligne de metro 😍', '2023-05-07 19:10:09'),
(97, 102, 16, 'Tu devrais regarder The Tourist', '2023-05-07 19:11:16'),
(98, 106, 14, 'Claude Monet . C&#039;était facileee', '2023-05-07 19:15:57'),
(99, 105, 14, 'Profite bien !!🤩', '2023-05-07 19:16:27'),
(100, 105, 15, 'On devrait ce voir !!', '2023-05-07 19:17:22'),
(101, 105, 16, 'A demain Anne je passerai chez toi !', '2023-05-07 19:18:54'),
(102, 108, 7, 'N&#039;oublie pas d&#039;ajouter supprimer commentaire !!', '2023-05-07 19:29:02');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `caption` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `nb_coms` int(11) NOT NULL DEFAULT 0,
  `signal` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`pid`, `uid`, `caption`, `photo`, `date`, `nb_coms`, `signal`) VALUES
(97, 14, 'Qui va gagner , psg ou man city ??', '../src/psgmatch.jpg', '2023-05-07 18:56:00', 1, 0),
(98, 14, 'Petite balade ', '../src/dog.jpg', '2023-05-07 18:57:01', 0, 0),
(99, 14, 'echo\"Je suis fatigué\"', '../src/codingcoffee.jpg', '2023-05-07 18:57:39', 2, 0),
(100, 14, 'Enfinnnn fini le boulot , bon weekend !', '../src/finjournee.jpg', '2023-05-07 18:58:18', 1, 0),
(101, 15, 'On prépare les exams !!', '../src/library.jpg', '2023-05-07 19:01:06', 1, 0),
(102, 15, 'Bonne Soirée 🌆', '../src/Netflix.jpg', '2023-05-07 19:01:40', 1, 0),
(104, 15, '😋', '../src/repas-entre-amis.jpg', '2023-05-07 19:03:03', 2, 0),
(105, 16, 'Emma in Paris ', '../src/paris.jpg', '2023-05-07 19:14:02', 3, 0),
(106, 16, 'Devinez le peintre ? 👀👀', '../src/paint.jpg', '2023-05-07 19:14:43', 1, 0),
(108, 6, 'on travaille le projet de IO2', '../src/projet.jpg', '2023-05-07 19:24:22', 2, 1),
(109, 7, 'Randonnée en forêt', '../src/foresthike.jpg', '2023-05-07 19:29:50', 0, 1),
(139, 6, 'I love Paris', '../src/paris2.jpg', '2023-05-12 02:01:09', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `souscription`
--

CREATE TABLE `souscription` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_suivi` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `souscription`
--

INSERT INTO `souscription` (`id`, `id_user`, `id_suivi`, `statut`) VALUES
(1, 6, 7, 1),
(7, 15, 14, 1),
(8, 14, 15, 1),
(9, 16, 14, 1),
(10, 16, 15, 1),
(11, 14, 16, 1),
(12, 15, 16, 1),
(13, 7, 6, 1),
(20, 6, 15, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `nom`, `prénom`, `mail`, `password`) VALUES
(6, 'naimcher', 'Cherchour', 'Naim', 'naimcher@gmail.com', '$2y$10$m1K6Nlr4T7FDG5lKnzMIr.cxteEm1kkZzjTM2M78Vv.7joMKw/Ss6'),
(7, 'paulnab', 'Nabti', 'Paul', 'paulnab@gmail.com', '$2y$10$3Nv6pv24wO/XZl5IVx212Or03dKt5IpMSN30vLYE4YnQIO907TMDG'),
(14, 'Jmartin', 'Martin', 'Jean', 'jmartin98@gmail.com', '$2y$10$FC78U/5AA4jW1gueeZVYCum0wMSYzw26OefB76wqld3E9.o5F5K0e'),
(15, 'anneClay', 'Clay', 'Anne', 'anneclay@gmail.com', '$2y$10$g35V2rghi0OPM9vDP4yBcee2nfZhIv4o313DZ67KLqnlav5Ol.MLG'),
(16, 'iamEmma', 'Sid', 'Emma', 'emmaa@outlook.com', '$2y$10$AE8xlpMg56BMxxtWoZWqg.6PzPZUJIoBM4ZDHP5s.VQjC4UMBqHGe');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `pid` (`pid`) USING BTREE,
  ADD KEY `uid` (`uid`) USING BTREE;

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`) USING BTREE;

--
-- Index pour la table `souscription`
--
ALTER TABLE `souscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_suivi` (`id_suivi`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `souscription`
--
ALTER TABLE `souscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `postid` FOREIGN KEY (`pid`) REFERENCES `posts` (`pid`) ON DELETE CASCADE,
  ADD CONSTRAINT `uuserid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `userid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `souscription`
--
ALTER TABLE `souscription`
  ADD CONSTRAINT `follower` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `following` FOREIGN KEY (`id_suivi`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
