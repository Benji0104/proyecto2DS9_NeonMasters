-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2025 a las 00:31:23
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
-- Base de datos: `Datos_personales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_datospersonales`
--

CREATE TABLE `formulario_datospersonales` (
  `id` int(90) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre1` varchar(50) NOT NULL,
  `nombre2` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `apellido_casada` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(4) NOT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL,
  `estado_civil` enum('Soltero','Casado','Viudo','Divorciado','Unido') NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `corregimiento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario_datospersonales`
--

INSERT INTO `formulario_datospersonales` (`id`, `cedula`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `apellido_casada`, `fecha_nacimiento`, `edad`, `sexo`, `estado_civil`, `telefono`, `email`, `provincia`, `distrito`, `corregimiento`) VALUES
(1, '8-1043-235', 'er', 'we', 'shi', 'wa', NULL, '2003-03-04', 0, 'Masculino', 'Soltero', '6705-2422', 'pruebra1denose@gmail.com', 'Panamá Oeste', 'La Chorrera', 'Barrio Balboa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formulario_datospersonales`
--
ALTER TABLE `formulario_datospersonales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formulario_datospersonales`
--
ALTER TABLE `formulario_datospersonales`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
