-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 21 Novembre 2016 à 08:51
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
  `mail_content` text NOT NULL,
  `checked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `lastname`, `firstname`, `mail`, `mail_content`, `checked`) VALUES
(1, 'azerty', 'azertyuiop', 'azerty@mail.com', '123456789azertyuiopqsdfghjklmwxcvbn', 1),
(2, 'Rousselle', 'Renaud', 'p.rous.renaud@gmail.com', 'azerty333333333', 1);

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
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `carroussel_title1` varchar(255) NOT NULL,
  `carroussel_text1` text NOT NULL,
  `carroussel_title2` varchar(255) NOT NULL,
  `carroussel_text2` text NOT NULL,
  `carroussel_title3` varchar(255) NOT NULL,
  `carroussel_text3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`id`, `name`, `phone`, `adress`, `mail`, `photo1`, `photo2`, `photo3`, `carroussel_title1`, `carroussel_text1`, `carroussel_title2`, `carroussel_text2`, `carroussel_title3`, `carroussel_text3`) VALUES
(1, 'DAT mussolini', '0651907680', '23 rue Jean Raymond Guyon', 'p.rous.renaud@gmail.com', 'pics/photo1_582f1043bde06.jpg', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
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

INSERT INTO `recipes` (`id`, `id_user`, `recipe_title`, `recipe_time`, `cook_time`, `people`, `ingredients`, `preparation`, `advice`, `photo`, `date_publish`) VALUES
(6, 0, '123POIUYTREZA', 10, 10, '8', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', '456123BLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAHBLAH', 'uploads/photo_582db3f08e00d.tmp', '0000-00-00 00:00:00'),
(7, 0, 'Crème glacée', 30, 15, '3', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE GLACE', 'uploads/photo_582dcc1b54d39.jpg', '2016-11-17 16:26:19'),
(8, 0, 'Clavier au soja', 10, 10, '7', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja clavier au soja', 'uploads/photo_582dd1c3706f7.tmp', '2016-11-17 16:31:47'),
(9, 123, '123azertyuiop', 10, 10, '2', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', '123azertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiopazertyuiop', 'uploads/photo_582dd6fa01472.tmp', '2016-11-17 17:12:41'),
(10, 1, 'Magret de canard', 10, 10, '8', 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'pppppppppppppppppppppppppppppp', 'uploads/photo_58320b68cdcc5.jpg', '2016-11-20 21:45:28');

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
(1, 2, 'Renaud', 'Rousselle', 'rous.renaud@gmail.com', '$2y$10$nVlCUfLJ1E7OOD4HT2i7LO2AJ9Nxt0t.XI03U6Mpg0yHfo/BZKeiO', ''),
(3, 0, 'bob', 'labeille', 'bob@mail.com', '$2y$10$y0lP/U271mgiVCSTGrOf1.J9bVN5AS4MEoPf4qXnWXJieKC4upJNS', ''),
(4, 2, 'Loup', 'Desbois', 'loup@desbois.com', '$2y$10$GUpQdtzTqqJ8w8fKn05j9OI5xDp1y2N.BDhP91P5UryMhGgLwIisy', ''),
(5, 2, 'Jay', 'SuperXu', 'jayxu@mail.com', '$2y$10$/HoMgGbisQrmnPD1xK12LujGgRHOjvpJBJ40abylerjQh6ATWEC8y', ''),
(6, 2, 'Renaud', 'Rousselle', 'p.rous.renaud@gmail.com', '$2y$10$d32LDFVBiFGd2GtFzOUUTu.QVUyFLN/p3wmvLQ8wCtg9dc.rB85Na', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
