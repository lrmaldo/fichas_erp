-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2018 a las 16:45:28
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.36-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fichas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `time_opc`
--

CREATE TABLE `time_opc` (
  `id` int(122) UNSIGNED NOT NULL,
  `time_select` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `time_opc`
--

INSERT INTO `time_opc` (`id`, `time_select`) VALUES
(1, '00:15:00' ),
(2, '00:30:00'  );

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `time_opc`
--
ALTER TABLE `time_opc`
  ADD PRIMARY KEY (`id`);

  
  
--
-- Insertar campo  OJO YA NO SE ESTÁ UTILIZANDO 26/09/2018
-- 
-- ALTER TABLE `time_opc` ADD `id_1_precio` DECIMAL(15,2);
-- ALTER TABLE `time_opc` ADD `id_2_precio` DECIMAL(15,2);
-- ALTER TABLE `time_opc` ADD `id_3_precio` DECIMAL(15,2);
-- ALTER TABLE `time_opc` ADD `id_4_precio` DECIMAL(15,2);


--
-- Cambios 26/09/2018
-- Crear campo 	user_id
ALTER TABLE `time_opc` ADD `user_id` INT(2);

--
-- Cambios 26/09/2018
-- Crear campo 	user_id
ALTER TABLE `time_opc` ADD `precio` DECIMAL(15,2);


--
-- Cambios 27/09/2018
-- Indices de la tabla `time_opc`
ALTER TABLE `time_opc`
  DROP  INDEX `time_select`;

--
-- AUTO_INCREMENT de la tabla `time_opc`
--
ALTER TABLE `time_opc`
  MODIFY `id` int(122) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


