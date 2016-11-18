-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2016 at 04:50 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mail_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `lastname`, `firstname`, `mail`, `mail_content`) VALUES
(1, 'xu', 'jie', 'jaycxu@sina.com', 'wrt;l''\\lkjhfdsaJKL/LGHFDSAAsjkl;jfdsasjhk.jhgfdwa;LKYUTRE');

-- --------------------------------------------------------

--
-- Table structure for table `infos`
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
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `name`, `phone`, `adress`, `mail`, `photo1`, `photo2`, `photo3`, `carroussel_title1`, `carroussel_text1`, `carroussel_title2`, `carroussel_text2`, `carroussel_title3`, `carroussel_text3`) VALUES
(1, 'DAT mussolini', '0651907680', '23 rue Jean Raymond Guyon', 'p.rous.renaud@gmail.com', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
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
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `recipe_author`, `recipe_title`, `recipe_time`, `cook_time`, `people`, `ingredients`, `preparation`, `advice`, `photo`, `date_publish`) VALUES
(11, 'Lysianne', 'Nouveautes', 30, 15, '2', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd6f25c8ae.jpg', '2016-11-17 17:12:34'),
(12, 'Renaud', 'Crepes', 30, 60, '6', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd753ea979.jpg', '2016-11-17 17:14:11'),
(13, 'Lynne', 'Cuisine Asiatique', 15, 45, '4', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd7d50dfe7.jpg', '2016-11-17 17:16:21'),
(15, 'Caroline', 'Soupes', 30, 30, '3', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd8586cb27.jpg', '2016-11-17 17:18:32'),
(16, 'Antony', 'Dessert', 15, 30, '5', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd89cc10d8.jpg', '2016-11-17 17:19:40'),
(17, 'Jayxu', 'Cuisine Française', 15, 30, '6', '- 500 g de spaghetti\r\n- 1 oignon\r\n- 2 gousses d''ail\r\n- 1 carotte\r\n- 1 branche de céleri\r\n- 850 g de tomates (fraîches ou en boîte selon la saison)\r\n- 37.5 ml de vin rouge\r\n- 500 g de boeuf haché\r\n- 50 cl de bouillon\r\n- persil\r\n- 1 cuillère à café de sucre\r\n- 2 cuillères à soupe d''huile', 'Hachez l''ail, l''oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\n\r\nFaites chauffer l''huile dans une casserole assez grande. Faites revenir l''ail, l''oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\n\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\n\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\n\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s''évapore.\r\n\r\nFaites cuire les spaghetti, puis mettez-les dans un plat. Ajoutez la sauce bolognaise.', 'Vous pensiez avoir épuisé les ressources de notre base de recettes ? C''est compter sans le talent de nos visiteurs... Retrouvez ici-même les dernières recettes rentrées en ligne.', 'uploads/photo_582dd9044b7a8.jpg', '2016-11-17 17:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `perm`, `firstname`, `lastname`, `mail`, `password`, `pwd_token`) VALUES
(1, 2, 'Renaud', 'Rousselle', 'rous.renaud@gmail.com', '$2y$10$x/tsJ15CAfk.mphZX2Etruhq07erKXH4WAwG0ibxw8hLJpL9CW8SW', ''),
(3, 0, 'bob', 'labeille', 'bob@mail.com', '$2y$10$y0lP/U271mgiVCSTGrOf1.J9bVN5AS4MEoPf4qXnWXJieKC4upJNS', ''),
(4, 2, 'Jie', 'superXu', 'jaycexu@mail.com', '123456789', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
