-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2025 a las 18:01:36
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
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdifficulties`
--

CREATE TABLE `tdifficulties` (
  `id_difficult` int(11) NOT NULL,
  `difficult_description` varchar(255) NOT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgame_genders`
--

CREATE TABLE `tgame_genders` (
  `id_game_gender` int(11) NOT NULL,
  `id_videogame` int(11) DEFAULT NULL,
  `id_gender` int(11) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgame_platforms`
--

CREATE TABLE `tgame_platforms` (
  `id_game_platform` int(11) NOT NULL,
  `id_videogame` int(11) DEFAULT NULL,
  `id_platform` int(11) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgenders`
--

CREATE TABLE `tgenders` (
  `id_gender` int(11) NOT NULL,
  `gender_description` varchar(255) NOT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tplatforms`
--

CREATE TABLE `tplatforms` (
  `id_platform` int(11) NOT NULL,
  `platform_name` varchar(255) NOT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpublisher`
--

CREATE TABLE `tpublisher` (
  `id_publisher` int(11) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tvideogames`
--

CREATE TABLE `tvideogames` (
  `id_videogame` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `id_developer` int(11) DEFAULT NULL,
  `id_publisher` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `price` double NOT NULL,
  `time_to_finish` int(11) DEFAULT NULL,
  `id_difficult` int(11) DEFAULT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tdevelopers`
--
ALTER TABLE `tdevelopers`
  ADD PRIMARY KEY (`id_developer`);

--
-- Indices de la tabla `tdifficulties`
--
ALTER TABLE `tdifficulties`
  ADD PRIMARY KEY (`id_difficult`);

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
  ADD PRIMARY KEY (`id_gender`);

--
-- Indices de la tabla `tplatforms`
--
ALTER TABLE `tplatforms`
  ADD PRIMARY KEY (`id_platform`);

--
-- Indices de la tabla `tpublisher`
--
ALTER TABLE `tpublisher`
  ADD PRIMARY KEY (`id_publisher`);

--
-- Indices de la tabla `tvideogames`
--
ALTER TABLE `tvideogames`
  ADD PRIMARY KEY (`id_videogame`),
  ADD KEY `idx_game_title` (`tittle`),
  ADD KEY `idx_developer` (`id_developer`),
  ADD KEY `idx_publisher` (`id_publisher`),
  ADD KEY `idx_release_date` (`release_date`),
  ADD KEY `idx_difficult` (`id_difficult`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tdevelopers`
--
ALTER TABLE `tdevelopers`
  MODIFY `id_developer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tdifficulties`
--
ALTER TABLE `tdifficulties`
  MODIFY `id_difficult` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tgame_genders`
--
ALTER TABLE `tgame_genders`
  MODIFY `id_game_gender` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tgame_platforms`
--
ALTER TABLE `tgame_platforms`
  MODIFY `id_game_platform` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tgenders`
--
ALTER TABLE `tgenders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tplatforms`
--
ALTER TABLE `tplatforms`
  MODIFY `id_platform` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tpublisher`
--
ALTER TABLE `tpublisher`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tvideogames`
--
ALTER TABLE `tvideogames`
  MODIFY `id_videogame` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `tvideogames_ibfk_2` FOREIGN KEY (`id_publisher`) REFERENCES `tpublisher` (`id_publisher`),
  ADD CONSTRAINT `tvideogames_ibfk_3` FOREIGN KEY (`id_difficult`) REFERENCES `tdifficulties` (`id_difficult`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
