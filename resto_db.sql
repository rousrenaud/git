-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 18 Novembre 2016 à 03:17
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `resto_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mail_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `main_photo` varchar(255) NOT NULL,
  `main_bg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`id`, `name`, `phone`, `adress`, `mail`, `main_photo`, `main_bg`) VALUES
(1, 'DAT mussolini', '0651907680', '23 rue Jean Raymond Guyon', 'p.rous.renaud@gmail.com', 'pics/photo_582cd3fea107a.jpg', 'pics/background_582cd3fea1614.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `recipe_author` varchar(255) NOT NULL,
  `recipe_title` varchar(255) NOT NULL,
  `recipe_time` int(11) NOT NULL,
  `cook_time` int(11) NOT NULL,
  `people` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `preparation` text NOT NULL,
  `advice` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_publish` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `recipes`
--

INSERT INTO `recipes` (`id`, `id_user`, `recipe_author`, `recipe_title`, `recipe_time`, `cook_time`, `people`, `ingredients`, `preparation`, `advice`, `photo`, `date_publish`) VALUES
(3, 0, '', 'Magret de canard', 30, 60, '2', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'ooooooooooooooooooooooooooooooooooooooooooooo', 'uploads/photo_582ced84d7f10.tmp', '0000-00-00 00:00:00'),
(6, 0, '', '123POIUYTREZA', 10, 10, '8', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', 'uploads/photo_582db3f08e00d.tmp', '0000-00-00 00:00:00'),
(7, 0, 'Bob', 'Crème glacée', 30, 15, '3', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'uploads/photo_582dcc1b54d39.jpg', '2016-11-17 16:26:19'),
(8, 0, 'Jay', 'Clavier au soja', 10, 10, '7', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'uploads/photo_582dd1c3706f7.tmp', '2016-11-17 16:31:47'),
(9, 0, '123azertyuiop', '123azertyuiop', 10, 10, '2', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', 'uploads/photo_582dd6fa01472.tmp', '2016-11-17 17:12:41'),
(10, 1, 'aaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbb', 30, 10, '8', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'uploads/photo_582e5f705938a.jpg', '2016-11-18 02:54:56');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `perm` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pwd_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `perm`, `firstname`, `lastname`, `mail`, `password`, `pwd_token`) VALUES
(1, 2, 'Renaud', 'Rousselle', 'rous.renaud@gmail.com', '$2y$10$fMZV6RDxOI4zxskELAr3FeOGJeOfBSSz6SYs/nh/K1rIfL4.N6kYi', 'd599d85b93d10c21bc26eb52e95a948b'),
(3, 0, 'bob', 'labeille', 'bob@mail.com', '$2y$10$Gvv7aLYb4.8sE5KO/X/05OdAtH6d3.J6kBA8PQWUKNUgeEnfzLMq2', ''),
(4, 2, 'Loup', 'Desbois', 'loup@desbois.com', '$2y$10$Gvv7aLYb4.8sE5KO/X/05OdAtH6d3.J6kBA8PQWUKNUgeEnfzLMq2', ''),
(5, 2, 'Jay', 'SuperXu', 'jayxu@mail.com', '$2y$10$Gvv7aLYb4.8sE5KO/X/05OdAtH6d3.J6kBA8PQWUKNUgeEnfzLMq2', ''),
(7, 1, 'John', 'Ducenne', 'john.ducenne@gmail.com', '$2y$10$d/rHAZfJimZOQAIZdtYfUOFzc52khEF4twJZwkUkL/cgvAzth2Wue', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
