-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2025 a las 04:52:51
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
-- Base de datos: `api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `id_videojuego` int(11) DEFAULT NULL,
  `nombre_genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `id_videojuego`, `nombre_genero`) VALUES
(1, 1, 'Acción-Aventura'),
(2, 1, 'Mundo Abierto'),
(3, 1, 'RPG'),
(4, 2, 'Acción-Aventura'),
(5, 2, 'Mundo Abierto'),
(6, 2, 'Western'),
(7, 3, 'Acción-Aventura'),
(8, 3, 'Hack and Slash'),
(9, 3, 'Mitología'),
(10, 4, 'Acción RPG'),
(11, 4, 'Mundo Abierto'),
(12, 4, 'Soulslike'),
(13, 5, 'RPG'),
(14, 5, 'Acción'),
(15, 5, 'Mundo Abierto'),
(16, 5, 'Cyberpunk'),
(17, 6, 'Deportes'),
(18, 6, 'Simulación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id` int(11) NOT NULL,
  `id_videojuego` int(11) DEFAULT NULL,
  `nombre_plataforma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id`, `id_videojuego`, `nombre_plataforma`) VALUES
(1, 1, 'Nintendo Switch'),
(2, 1, 'Wii U'),
(3, 2, 'PlayStation 4'),
(4, 2, 'Xbox One'),
(5, 2, 'PC'),
(6, 3, 'PlayStation 5'),
(7, 3, 'PlayStation 4'),
(8, 4, 'PlayStation 5'),
(9, 4, 'PlayStation 4'),
(10, 4, 'Xbox Series X/S'),
(11, 4, 'Xbox One'),
(12, 4, 'PC'),
(13, 5, 'PlayStation 5'),
(14, 5, 'PlayStation 4'),
(15, 5, 'Xbox Series X/S'),
(16, 5, 'Xbox One'),
(17, 5, 'PC'),
(18, 6, 'PlayStation 5'),
(19, 6, 'PlayStation 4'),
(20, 6, 'Xbox Series X/S'),
(21, 6, 'Xbox One'),
(22, 6, 'PC'),
(23, 6, 'Nintendo Switch');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `desarrollador` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `calificacion_esrb` varchar(10) DEFAULT NULL,
  `precio_valor` decimal(10,2) NOT NULL,
  `precio_moneda` varchar(3) NOT NULL,
  `resolucion` varchar(50) DEFAULT NULL,
  `fps` int(11) DEFAULT NULL,
  `peso_archivo` float DEFAULT NULL,
  `duracion_promedio` varchar(50) DEFAULT NULL,
  `dificultad` varchar(20) DEFAULT NULL,
  `mundo_abierto` tinyint(1) DEFAULT NULL,
  `metacritic` int(11) DEFAULT NULL,
  `usuarios_score` decimal(3,1) DEFAULT NULL,
  `total_ventas` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id`, `titulo`, `desarrollador`, `publisher`, `fecha_lanzamiento`, `calificacion_esrb`, `precio_valor`, `precio_moneda`, `resolucion`, `fps`, `peso_archivo`, `duracion_promedio`, `dificultad`, `mundo_abierto`, `metacritic`, `usuarios_score`, `total_ventas`) VALUES
(1, 'The Legend of Zelda: Breath of the Wild', 'Nintendo EPD', 'Nintendo', '2017-03-03', 'E10+', 59.99, 'USD', '1920x1080', 30, 13.4, '50', 'Media', 1, 97, 8.7, 29.81),
(2, 'Red Dead Redemption 2', 'Rockstar Games', 'Take-Two Interactive', '2018-10-26', 'M', 59.99, 'USD', '3840x2160', 60, 150, '60', 'Media', 1, 97, 9.0, 50),
(3, 'God of War Ragnarök', 'Santa Monica Studio', 'Sony Interactive Entertainment', '2022-11-09', 'M', 69.99, 'USD', '4K', 60, 118.5, '40', 'Media-Alta', 0, 94, 9.2, 15),
(4, 'Elden Ring', 'FromSoftware', 'Bandai Namco Entertainment', '2022-02-25', 'M', 59.99, 'USD', '4K', 60, 60, '70', 'Alta', 1, 96, 8.9, 20),
(5, 'Cyberpunk 2077', 'CD Projekt Red', 'CD Projekt', '2020-12-10', 'M', 59.99, 'USD', '4K', 60, 70, '55', 'Media', 1, 86, 7.5, 25),
(6, 'FIFA 23', 'EA Vancouver', 'Electronic Arts', '2022-09-30', 'E', 59.99, 'USD', '4K', 60, 100, '0', 'Variable', 0, 80, 7.8, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_videojuego` (`id_videojuego`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_videojuego` (`id_videojuego`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `generos`
--
ALTER TABLE `generos`
  ADD CONSTRAINT `generos_ibfk_1` FOREIGN KEY (`id_videojuego`) REFERENCES `videojuegos` (`id`);

--
-- Filtros para la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD CONSTRAINT `plataformas_ibfk_1` FOREIGN KEY (`id_videojuego`) REFERENCES `videojuegos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
