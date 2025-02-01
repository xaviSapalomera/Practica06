-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-01-2025 a las 15:22:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ptxy_xavi_gallego`
--
CREATE DATABASE IF NOT EXISTS `ptxy_xavi_gallego` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ptxy_xavi_gallego`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titol` varchar(255) NOT NULL,
  `cos` longtext NOT NULL,
  `data` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `titol`, `cos`, `data`, `user_id`) VALUES
(24, 'Kelvin van der Linde se une a BMW, pero podría quedarse sin asiento en el DTM', 'El piloto sudafricano Kelvin van der Linde ha firmado con BMW, sin embargo, su participación en la temporada 2025 del DTM aún no está asegurada.\r\n', '2024-12-25', 1),
(25, 'Nuevo equipo Porsche se une al DTM en 2025 y firma al ex piloto de Audi, Feller', 'Un nuevo equipo respaldado por Porsche ingresará al DTM en 2025, contando con el ex piloto de Audi, Ricardo Feller, en su alineación.\r\n', '2024-12-25', 1),
(27, 'HWA EVO: Una reinterpretación moderna del Mercedes-Benz 190E Evo II', 'HWA AG ha presentado el HWA EVO, una versión contemporánea del icónico Mercedes-Benz 190E 2.5-16 EVO II de 1990. Este modelo, limitado a 100 unidades y con un precio de 714.000 euros, incorpora un motor V6 biturbo de 3.0 litros que genera hasta 500 caballos de fuerza y 550 Nm de torque. El diseño mantiene la esencia del original, con mejoras como un chasis reforzado y una carrocería de carbono.', '2025-01-15', 1),
(28, 'Aston Martin incorpora a Daniel Juncadella como piloto de simulador', 'Aston Martin ha contratado al piloto español Daniel Juncadella, de 33 años, como nuevo piloto de simulador. Juncadella, con amplia experiencia en WEC, GT y DTM, comenzó sus funciones durante el Gran Premio de Abu Dhabi, participando desde la fábrica de Silverstone. El jefe del equipo, Mike Krack, destacó la importancia de este rol para el desarrollo del coche. ', '2025-01-15', 1),
(29, 'Audi se retira del DTM para enfocarse en la Fórmula 1', 'Audi ha decidido concentrarse en su entrada a la Fórmula 1 en 2026, lo que implica la retirada del DTM y el fin de la colaboración con ABT Sportsline, que ha sido exitosa durante años. Hans-Jürgen Abt ha expresado críticas hacia esta decisión, señalando que el programa de clientes es financieramente viable y actualmente está en auge. Teme que los clientes se desvíen hacia competidores como BMW o Mercedes.', '2025-01-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `dni` char(9) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `cognom` varchar(45) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `dni`, `nickname`, `nom`, `cognom`, `email`, `contrasenya`, `admin`) VALUES
(1, '45654312R', 'xgallego', 'Xavi', 'Gallego', 'xavigallegopalau@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1),
(2, '45962292N', 'adelgado', 'Alfonso', 'Delgado', 'adelgado@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0),
(3, '54810442Q', 'bgandullo', 'Bryan', 'Gandullo', 'bgandullo@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris_auth`
--

DROP TABLE IF EXISTS `usuaris_auth`;
CREATE TABLE `usuaris_auth` (
  `id` int(11) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `email` int(45) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris_auth`
--
ALTER TABLE `usuaris_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `usuaris_auth`
--
ALTER TABLE `usuaris_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `usuaris` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
