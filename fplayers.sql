-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2024 a las 13:15:18
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fplayers`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player`
--

CREATE TABLE `player` (
  `Nombre` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Dorsal` int(11) NOT NULL,
  `Posicion` set('Portero','Defensa','Centrocampista','Delantero') NOT NULL,
  `Equipo` varchar(50) NOT NULL,
  `N_Goles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `player`
--

INSERT INTO `player` (`Nombre`, `DNI`, `Dorsal`, `Posicion`, `Equipo`, `N_Goles`) VALUES
('Player1', '12345678A', 7, 'Defensa,Centrocampista', 'TeamA', 20),
('Player5', '32165498B', 9, 'Centrocampista,Delantero', 'TeamE', 25),
('jose', '45678912A', 8, 'Portero,Defensa', 'miami', 12),
('Player3', '45678912C', 10, 'Defensa,Centrocampista,Delantero', 'TeamC', 5),
('victorro', '50623017R', 12, 'Centrocampista,Delantero', 'Team A', 0),
('Juan', '50623018H', 7, 'Defensa,Centrocampista', 'miami', 10),
('Victor', '50623019L', 8, 'Defensa', 'miami', 15),
('Player4', '78912345H', 1, 'Portero', 'TeamD', 0),
('Cristiano Ronaldo', '98745612T', 7, 'Delantero', 'ErBetis', 1001),
('Messi', '98745632B', 10, 'Delantero', 'miami', 1012),
('Player2', '98765432J', 5, 'Delantero', 'TeamB', 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
