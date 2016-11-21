-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 21 Novembre 2016 à 10:55
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

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
(2, 'Rousselle', 'Renaud', 'p.rous.renaud@gmail.com', 'azerty333333333', 1),
(3, 'Rousselle', 'Renaud', 'rous.renaud@gmail.com', 'hhhhhhhhhhhhhhhhhhhhhhhhhh', 1);

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
(1, 'O''Fifou', '0651907680', '23 rue Jean Raymond Guyon', 'p.rous.renaud@gmail.com', 'admin/pics/photo1_5832ac716a9ef.jpg', 'admin/pics/photo2_5832ac716aefe.jpg', 'admin/pics/photo3_5832ac716b387.jpg', 'Sa mère', 'Son père', 'Sa soeur', 'Son frère', 'Sa nièce', 'Sa tante');

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
(11, 1, 'Lysianne', 'Nouveautes', 30, 15, '2', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd6f25c8ae.jpg', '2016-11-17 17:12:34'),
(12, 1, 'Renaud', 'Crepes', 30, 60, '6', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd753ea979.jpg', '2016-11-17 17:14:11'),
(13, 1, 'Lynne', 'Cuisine Asiatique', 15, 45, '4', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd7d50dfe7.jpg', '2016-11-17 17:16:21'),
(15, 1, 'Caroline', 'Soupes', 30, 30, '3', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd8586cb27.jpg', '2016-11-17 17:18:32'),
(16, 1, 'Antony', 'Dessert', 15, 30, '5', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd89cc10d8.jpg', '2016-11-17 17:19:40'),
(17, 1, 'Jayxu', 'Cuisine Française', 15, 30, '6', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd9044b7a8.jpg', '2016-11-17 17:21:24');

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
(1, 2, 'Renaud', 'Rousselle', 'rous.renaud@gmail.com', '$2y$10$J6h.m8DGZSkvkdhprOKLSeN623cZr8ckdliWdnzEeZDJiMfDHY0nm', ''),
(3, 0, 'bob', 'labeille', 'bob@mail.com', '$2y$10$y0lP/U271mgiVCSTGrOf1.J9bVN5AS4MEoPf4qXnWXJieKC4upJNS', ''),
(4, 2, 'Loup', 'Desbois', 'loup@desbois.com', '$2y$10$GUpQdtzTqqJ8w8fKn05j9OI5xDp1y2N.BDhP91P5UryMhGgLwIisy', ''),
(5, 2, 'Jay', 'SuperXu', 'jayxu@mail.com', '$2y$10$/HoMgGbisQrmnPD1xK12LujGgRHOjvpJBJ40abylerjQh6ATWEC8y', ''),
(7, 1, 'Renaud', 'Rousselle', 'p.rous.renaud@gmail.com', '$2y$10$9/Dhb0.hPSuyzWBMgmtJeOZf6D0JnWu4Ab4I8YRZWB8EZtrDndn6.', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
