-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2025 a las 20:03:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `general`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poject_18_productos`
--

CREATE TABLE `poject_18_productos` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `cod` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `pre` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `poject_18_productos`
--

INSERT INTO `poject_18_productos` (`id`, `img`, `cod`, `nom`, `pre`) VALUES
(1, 'img/mesa.png', 'KDFI1', 'Mesa', 12.00),
(3, 'img/radio.png', 'P4KU1L', 'Radio', 32.00),
(4, 'img/silla.png', 'KFJD31', 'Silla', 3.00),
(5, 'img/sofa.png', 'ASDKQ1', 'Sofa', 10.00),
(6, 'img/tv.png', 'OQMKEM4', 'Televisor', 41.00),
(7, 'img/microondas.png', 'AAS2DGE', 'Microondas', 32.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `poject_18_productos`
--
ALTER TABLE `poject_18_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod` (`cod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `poject_18_productos`
--
ALTER TABLE `poject_18_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
