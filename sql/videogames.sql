-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2025 a las 23:46:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videogames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdevelopers`
--

CREATE TABLE `tdevelopers` (
  `id_developer` int(11) NOT NULL,
  `developer_name` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tdevelopers`
--

INSERT INTO `tdevelopers` (`id_developer`, `developer_name`, `active`) VALUES
(1, 'Nintendo', 1),
(2, 'Electronic Arts', 1),
(3, 'Ubisoft', 1),
(4, 'Rockstar Games', 1),
(5, 'Square Enix', 1),
(6, 'CD Projekt Red', 1),
(7, 'Bethesda', 1),
(8, 'Activision Blizzard', 1),
(9, 'FromSoftware', 1),
(10, 'Naughty Dog', 1),
(11, 'Sega', 1),
(12, 'Team ASOBI', 1),
(13, 'Disney', 1),
(14, 'Disney DLKAJSDIOFJAIOEJLKNVJKZHVIOJZXC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdifficulties`
--

CREATE TABLE `tdifficulties` (
  `id_difficulty` int(11) NOT NULL,
  `difficult_description` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tdifficulties`
--

INSERT INTO `tdifficulties` (`id_difficulty`, `difficult_description`, `active`) VALUES
(1, 'Easy', 1),
(2, 'Medium', 1),
(3, 'Hard', 1),
(4, 'Very Hard', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgame_genders`
--

CREATE TABLE `tgame_genders` (
  `id_game_gender` int(11) NOT NULL,
  `id_videogame` int(11) DEFAULT NULL,
  `id_gender` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tgame_genders`
--

INSERT INTO `tgame_genders` (`id_game_gender`, `id_videogame`, `id_gender`, `active`) VALUES
(9, 3, 1, 1),
(10, 3, 3, 1),
(11, 4, 4, 1),
(12, 5, 1, 1),
(13, 5, 2, 1),
(14, 5, 3, 1),
(15, 6, 1, 1),
(16, 6, 3, 1),
(17, 7, 1, 1),
(18, 7, 2, 1),
(19, 7, 3, 1),
(20, 8, 7, 1),
(21, 8, 2, 1),
(22, 9, 1, 1),
(23, 9, 2, 1),
(24, 9, 3, 1),
(25, 10, 1, 1),
(26, 10, 3, 1),
(27, 10, 6, 1),
(28, 11, 8, 1),
(29, 12, 1, 1),
(30, 12, 6, 1),
(31, 13, 1, 1),
(32, 13, 2, 1),
(33, 13, 3, 1),
(34, 14, 1, 1),
(35, 14, 3, 1),
(36, 14, 6, 1),
(37, 15, 4, 1),
(38, 16, 1, 1),
(39, 16, 2, 1),
(40, 17, 1, 1),
(41, 17, 2, 1),
(42, 18, 3, 1),
(43, 18, 2, 1),
(44, 19, 1, 1),
(45, 19, 3, 1),
(46, 20, 1, 1),
(47, 20, 10, 1),
(48, 21, 1, 1),
(49, 21, 2, 1),
(50, 22, 1, 1),
(51, 22, 6, 1),
(52, 23, 7, 1),
(53, 23, 2, 1),
(54, 24, 1, 1),
(55, 24, 7, 1),
(56, 25, 1, 1),
(57, 25, 3, 1),
(58, 26, 11, 1),
(59, 26, 12, 1),
(60, 27, 13, 1),
(61, 27, 14, 1),
(78, 2, 2, 1),
(82, 1, 1, 1),
(84, 28, 15, 1),
(91, 29, 19, 1),
(95, 30, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgame_platforms`
--

CREATE TABLE `tgame_platforms` (
  `id_game_platform` int(11) NOT NULL,
  `id_videogame` int(11) DEFAULT NULL,
  `id_platform` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tgame_platforms`
--

INSERT INTO `tgame_platforms` (`id_game_platform`, `id_videogame`, `id_platform`, `active`) VALUES
(8, 3, 1, 1),
(9, 3, 2, 1),
(10, 3, 4, 1),
(11, 4, 1, 1),
(12, 4, 2, 1),
(13, 4, 3, 1),
(14, 4, 4, 1),
(15, 5, 1, 1),
(16, 5, 2, 1),
(17, 15, 4, 1),
(18, 6, 1, 1),
(19, 6, 4, 1),
(20, 7, 1, 1),
(21, 7, 2, 1),
(22, 7, 3, 1),
(23, 7, 4, 1),
(24, 8, 3, 1),
(25, 9, 1, 1),
(26, 9, 5, 1),
(27, 10, 1, 1),
(28, 10, 2, 1),
(29, 10, 4, 1),
(30, 11, 3, 1),
(31, 12, 1, 1),
(32, 12, 2, 1),
(33, 12, 4, 1),
(34, 13, 1, 1),
(35, 13, 5, 1),
(36, 14, 2, 1),
(37, 14, 4, 1),
(38, 15, 3, 1),
(39, 16, 1, 1),
(40, 16, 2, 1),
(41, 16, 4, 1),
(42, 17, 1, 1),
(43, 17, 4, 1),
(44, 18, 1, 1),
(45, 18, 2, 1),
(46, 18, 3, 1),
(47, 18, 4, 1),
(48, 19, 3, 1),
(49, 19, 4, 1),
(50, 20, 1, 1),
(51, 20, 2, 1),
(52, 20, 4, 1),
(53, 21, 1, 1),
(54, 21, 5, 1),
(55, 22, 1, 1),
(56, 22, 2, 1),
(57, 22, 4, 1),
(58, 23, 1, 1),
(59, 23, 2, 1),
(60, 23, 4, 1),
(61, 24, 3, 1),
(62, 25, 1, 1),
(63, 26, 6, 1),
(64, 26, 5, 1),
(65, 27, 3, 1),
(84, 2, 6, 1),
(88, 1, 1, 1),
(90, 28, 8, 1),
(96, 29, 10, 1),
(98, 30, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgenders`
--

CREATE TABLE `tgenders` (
  `id_gender` int(11) NOT NULL,
  `gender_description` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tgenders`
--

INSERT INTO `tgenders` (`id_gender`, `gender_description`, `active`) VALUES
(1, 'Action-Adventure', 1),
(2, 'Open world', 1),
(3, 'RPG', 1),
(4, 'Sports', 1),
(5, 'Strategy', 1),
(6, 'Shooter', 1),
(7, 'Plataform', 1),
(8, 'Simulation', 1),
(9, 'Fight', 1),
(10, 'Survival Horror', 1),
(11, 'Rhythm', 1),
(12, 'Music', 1),
(13, 'Platform', 1),
(14, 'Family', 1),
(15, 'all', 1),
(16, 'MALEEE', 1),
(17, 'MALEEEASTDGFS RNHGFDJHDF TMI K', 1),
(18, 'GL   HGDFGSBERT', 1),
(19, 'MALEEEEE AKLJSDFIO AJWEKLFJAIOSDJFOKASDJFIOPAwej', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tplatforms`
--

CREATE TABLE `tplatforms` (
  `id_platform` int(11) NOT NULL,
  `platform_name` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tplatforms`
--

INSERT INTO `tplatforms` (`id_platform`, `platform_name`, `active`) VALUES
(1, 'Nintendo Switch', 1),
(2, 'Wii U', 1),
(3, 'PlayStation 5', 1),
(4, 'Xbox Series X|S', 1),
(5, 'PC', 1),
(6, 'PlayStation 4', 1),
(7, 'Xbox One', 1),
(8, 'all', 1),
(9, 'COMPUTAICION', 1),
(10, 'COMPUTAICION V AWRDFGVQGB3RYN JFCX B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpublishers`
--

CREATE TABLE `tpublishers` (
  `id_publisher` int(11) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tpublishers`
--

INSERT INTO `tpublishers` (`id_publisher`, `publisher_name`, `active`) VALUES
(1, 'Nintendo', 1),
(2, 'Electronic Arts', 1),
(3, 'Ubisoft', 1),
(4, 'Take-Two Interactive', 1),
(5, 'Square Enix', 1),
(6, 'CD Projekt', 1),
(7, 'Bethesda Softworks', 1),
(8, 'Activision', 1),
(9, 'Bandai Namco', 1),
(10, 'Sony Interactive Entertainment', 1),
(11, 'Sega', 1),
(13, 'Sony', 1),
(14, 'PLAYTAICHON', 1),
(15, 'PLAYTAICHON MLKSDFJOIAREJFOKSJBPXJPOVB CX', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tvideogames`
--

CREATE TABLE `tvideogames` (
  `id_videogame` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `id_developer` int(11) NOT NULL,
  `id_publisher` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `price` double NOT NULL,
  `time_to_finish` int(11) NOT NULL,
  `id_difficulty` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tvideogames`
--

INSERT INTO `tvideogames` (`id_videogame`, `tittle`, `id_developer`, `id_publisher`, `release_date`, `price`, `time_to_finish`, `id_difficulty`, `active`) VALUES
(1, 'The Legend of Zelda: Breath of the Wild', 1, 1, '2020-10-08', 60, 60, 4, 1),
(2, 'Red Dead Redemption 2', 4, 4, '2018-10-26', 60, 20, 2, 1),
(3, 'Elden Ring', 9, 9, '2022-02-25', 59.99, 70, 4, 1),
(4, 'FIFA 23', 2, 2, '2022-09-30', 69.99, 15, 2, 1),
(5, 'Assassin\'s Creed Valhalla', 3, 3, '2020-11-10', 59.99, 60, 2, 1),
(6, 'Final Fantasy VII Remake', 5, 5, '2020-04-10', 59.99, 40, 2, 1),
(7, 'The Witcher 3: Wild Hunt', 6, 6, '2015-05-19', 39.99, 100, 3, 1),
(8, 'Super Mario Odyssey', 1, 1, '2017-10-27', 59.99, 15, 1, 1),
(9, 'God of War Ragnarök', 10, 10, '2022-11-09', 69.99, 40, 2, 1),
(10, 'Cyberpunk 2077', 6, 6, '2020-12-10', 59.99, 50, 3, 1),
(11, 'Animal Crossing: New Horizons', 1, 1, '2020-03-20', 59.99, 0, 1, 1),
(12, 'Call of Duty: Modern Warfare II', 8, 8, '2022-10-28', 69.99, 8, 2, 1),
(13, 'Horizon Forbidden West', 10, 10, '2022-02-18', 69.99, 35, 2, 1),
(14, 'Starfield', 7, 7, '2023-09-06', 69.99, 80, 2, 1),
(15, 'Mario Kart 8 Deluxe', 1, 1, '2017-04-28', 59.99, 10, 1, 1),
(16, 'Sekiro: Shadows Die Twice', 9, 8, '2019-03-22', 59.99, 40, 4, 1),
(17, 'Spider-Man: Miles Morales', 10, 10, '2020-11-12', 49.99, 15, 2, 1),
(18, 'Persona 5 Royal', 5, 5, '2020-03-31', 59.99, 100, 3, 1),
(19, 'Hades', 1, 1, '2020-09-17', 24.99, 25, 3, 1),
(20, 'Resident Evil Village', 8, 8, '2021-05-07', 59.99, 12, 3, 1),
(21, 'Ghost of Tsushima', 10, 10, '2020-07-17', 59.99, 30, 2, 1),
(22, 'Deathloop', 7, 7, '2021-09-14', 59.99, 20, 3, 1),
(23, 'It Takes Two', 2, 2, '2021-03-26', 39.99, 15, 2, 1),
(24, 'Metroid Dread', 1, 1, '2021-10-08', 59.99, 12, 3, 1),
(25, 'Demon\'s Souls', 9, 10, '2020-11-12', 69.99, 30, 4, 1),
(26, 'Project Diva Mega Mix', 11, 11, '2025-02-08', 59, 50, 3, 1),
(27, 'Astro Bot', 12, 13, '2024-02-16', 60, 20, 1, 1),
(28, 'Paw patrol', 13, 1, '1983-10-21', 99, 40, 4, 0),
(29, 'JURASSIC PARK', 14, 15, '0040-02-12', 1e30, 2147483647, 1, 0),
(30, 'Paw patrol 2', 1, 11, '2025-02-06', 50, 10, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tdevelopers`
--
ALTER TABLE `tdevelopers`
  ADD PRIMARY KEY (`id_developer`),
  ADD UNIQUE KEY `unique_developer` (`developer_name`);

--
-- Indices de la tabla `tdifficulties`
--
ALTER TABLE `tdifficulties`
  ADD PRIMARY KEY (`id_difficulty`),
  ADD UNIQUE KEY `unique_difficulty` (`difficult_description`);

--
-- Indices de la tabla `tgame_genders`
--
ALTER TABLE `tgame_genders`
  ADD PRIMARY KEY (`id_game_gender`),
  ADD KEY `id_videogame` (`id_videogame`),
  ADD KEY `id_gender` (`id_gender`);

--
-- Indices de la tabla `tgame_platforms`
--
ALTER TABLE `tgame_platforms`
  ADD PRIMARY KEY (`id_game_platform`),
  ADD KEY `id_videogame` (`id_videogame`),
  ADD KEY `id_platform` (`id_platform`);

--
-- Indices de la tabla `tgenders`
--
ALTER TABLE `tgenders`
  ADD PRIMARY KEY (`id_gender`),
  ADD UNIQUE KEY `unique_gender` (`gender_description`);

--
-- Indices de la tabla `tplatforms`
--
ALTER TABLE `tplatforms`
  ADD PRIMARY KEY (`id_platform`),
  ADD UNIQUE KEY `unique_platform` (`platform_name`);

--
-- Indices de la tabla `tpublishers`
--
ALTER TABLE `tpublishers`
  ADD PRIMARY KEY (`id_publisher`),
  ADD UNIQUE KEY `unique_publisher` (`publisher_name`);

--
-- Indices de la tabla `tvideogames`
--
ALTER TABLE `tvideogames`
  ADD PRIMARY KEY (`id_videogame`),
  ADD KEY `idx_game_title` (`tittle`),
  ADD KEY `idx_developer` (`id_developer`),
  ADD KEY `idx_publisher` (`id_publisher`),
  ADD KEY `idx_release_date` (`release_date`),
  ADD KEY `idx_difficult` (`id_difficulty`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tdevelopers`
--
ALTER TABLE `tdevelopers`
  MODIFY `id_developer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tdifficulties`
--
ALTER TABLE `tdifficulties`
  MODIFY `id_difficulty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tgame_genders`
--
ALTER TABLE `tgame_genders`
  MODIFY `id_game_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `tgame_platforms`
--
ALTER TABLE `tgame_platforms`
  MODIFY `id_game_platform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `tgenders`
--
ALTER TABLE `tgenders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tplatforms`
--
ALTER TABLE `tplatforms`
  MODIFY `id_platform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tpublishers`
--
ALTER TABLE `tpublishers`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tvideogames`
--
ALTER TABLE `tvideogames`
  MODIFY `id_videogame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tgame_genders`
--
ALTER TABLE `tgame_genders`
  ADD CONSTRAINT `tgame_genders_ibfk_1` FOREIGN KEY (`id_videogame`) REFERENCES `tvideogames` (`id_videogame`),
  ADD CONSTRAINT `tgame_genders_ibfk_2` FOREIGN KEY (`id_gender`) REFERENCES `tgenders` (`id_gender`);

--
-- Filtros para la tabla `tgame_platforms`
--
ALTER TABLE `tgame_platforms`
  ADD CONSTRAINT `tgame_platforms_ibfk_1` FOREIGN KEY (`id_videogame`) REFERENCES `tvideogames` (`id_videogame`),
  ADD CONSTRAINT `tgame_platforms_ibfk_2` FOREIGN KEY (`id_platform`) REFERENCES `tplatforms` (`id_platform`);

--
-- Filtros para la tabla `tvideogames`
--
ALTER TABLE `tvideogames`
  ADD CONSTRAINT `tvideogames_ibfk_1` FOREIGN KEY (`id_developer`) REFERENCES `tdevelopers` (`id_developer`),
  ADD CONSTRAINT `tvideogames_ibfk_2` FOREIGN KEY (`id_publisher`) REFERENCES `tpublishers` (`id_publisher`),
  ADD CONSTRAINT `tvideogames_ibfk_3` FOREIGN KEY (`id_difficulty`) REFERENCES `tdifficulties` (`id_difficulty`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
