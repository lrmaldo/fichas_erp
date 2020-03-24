-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2016 a las 10:48:32
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simple_invoice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `precision`, `thousand_separator`, `decimal_separator`, `code`) VALUES
(1, 'US Dollar', '$', '2', ',', '.', 'USD'),
(2, 'Libra Esterlina', '&pound;', '2', ',', '.', 'GBP'),
(3, 'Euro', 'â‚¬', '2', '.', ',', 'EUR'),
(4, 'South African Rand', 'R', '2', '.', ',', 'ZAR'),
(5, 'Danish Krone', 'kr ', '2', '.', ',', 'DKK'),
(6, 'Israeli Shekel', 'NIS ', '2', ',', '.', 'ILS'),
(7, 'Swedish Krona', 'kr ', '2', '.', ',', 'SEK'),
(8, 'Kenyan Shilling', 'KSh ', '2', ',', '.', 'KES'),
(9, 'Canadian Dollar', 'C$', '2', ',', '.', 'CAD'),
(10, 'Philippine Peso', 'P ', '2', ',', '.', 'PHP'),
(11, 'Indian Rupee', 'Rs. ', '2', ',', '.', 'INR'),
(12, 'Australian Dollar', '$', '2', ',', '.', 'AUD'),
(13, 'Singapore Dollar', 'SGD ', '2', ',', '.', 'SGD'),
(14, 'Norske Kroner', 'kr ', '2', '.', ',', 'NOK'),
(15, 'New Zealand Dollar', '$', '2', ',', '.', 'NZD'),
(16, 'Vietnamese Dong', 'VND ', '0', '.', ',', 'VND'),
(17, 'Swiss Franc', 'CHF ', '2', '''', '.', 'CHF'),
(18, 'Quetzal Guatemalteco', 'Q', '2', ',', '.', 'GTQ'),
(19, 'Malaysian Ringgit', 'RM', '2', ',', '.', 'MYR'),
(20, 'Real Brasile&ntilde;o', 'R$', '2', '.', ',', 'BRL'),
(21, 'Thai Baht', 'THB ', '2', ',', '.', 'THB'),
(22, 'Nigerian Naira', 'NGN ', '2', ',', '.', 'NGN'),
(23, 'Peso Argentino', '$', '2', '.', ',', 'ARS'),
(24, 'Bangladeshi Taka', 'Tk', '2', ',', '.', 'BDT'),
(25, 'United Arab Emirates Dirham', 'DH ', '2', ',', '.', 'AED'),
(26, 'Hong Kong Dollar', '$', '2', ',', '.', 'HKD'),
(27, 'Indonesian Rupiah', 'Rp', '2', ',', '.', 'IDR'),
(28, 'Peso Mexicano', '$', '2', ',', '.', 'MXN'),
(29, 'Egyptian Pound', '&pound;', '2', ',', '.', 'EGP'),
(30, 'Peso Colombiano', '$', '2', '.', ',', 'COP'),
(31, 'West African Franc', 'CFA ', '2', ',', '.', 'XOF'),
(32, 'Chinese Renminbi', 'RMB ', '2', ',', '.', 'CNY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` varchar(30) NOT NULL,
  `total_venta` varchar(20) NOT NULL,
  `estado_factura` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `impuesto` int(2) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--
ape_pat_cliente
INSERT INTO `perfil` (`id_perfil`, `nombre_empresa`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `telefono`, `email`, `impuesto`, `moneda`, `logo_url`) VALUES
(1, 'SISTEMAS WEB LA', 'Colonias Los Andes  #250', 'Moncagua', '3301', 'San Miguel', '+(503) 2682-555', 'info@obedalvarado.pw', 13, '$', 'img/1478792451_google30.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `status_producto` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`ape_pat_cliente
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`ape_pat_cliente
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'Obed', 'Alvarado', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'admin@admin.com', '2016-05-21 15:06:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `codigo_producto` (`nombre_cliente`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_factura`,`id_producto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero_factura`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--==================================================================================================================*
--NUEVAS ACTUALIZACIONES POR EMG 21MAR2017
--==================================================================================================================*
--
-- Create table `unidades`
--
CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_unidad` varchar(3) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Create table `marcas`
--
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(30) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--ape_pat_cliente
-- Create table `lineas`
--
CREATE TABLE IF NOT EXISTS `lineas` (
  `id_linea` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_linea` varchar(30) NOT NULL,
  PRIMARY KEY (`id_linea`),
  UNIQUE INDEX (`nombre_linea`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `products` ADD `product_img` varchar(50) NULL;
 
ALTER TABLE `unidades` ADD UNIQUE INDEX ( `nombre_unidad` );

ALTER TABLE `marcas` ADD UNIQUE INDEX ( `nombre_marca` );
ape_pat_cliente
---------------------------------------------------------------------------------------------------------------------------- 28 Abr 17

-- Alter changes table `products`

-- Anterior 255,finalidad se utiliza otro campo para el nombre largo
ALTER TABLE products MODIFY COLUMN `nombre_producto` VARCHAR(50);
ALTER TABLE products ADD COLUMN `nombre_producto_l` TINYTEXT AFTER `nombre_producto`;

-- Añadir nuevo precio entrada o de compra de los productos
ALTER TABLE products ADD COLUMN `precio_cost` DOUBLE(15,2) AFTER `nombre_producto_l`;

-- Añadir nuevos precios 1 y 2 de los productos
ALTER TABLE products ADD COLUMN `precio2` DOUBLE(15,2) AFTER `precio_producto`;
ALTER TABLE products ADD COLUMN `precio3` DOUBLE(15,2) AFTER `precio2`;

-- Añadir unidad,linea y marca a los productos
ALTER TABLE products ADD COLUMN `id_unidad` INT(5) AFTER `precio3`;
ALTER TABLE products ADD COLUMN `id_marca` INT(5) DEFAULT 0 AFTER `id_unidad`;
ALTER TABLE products ADD COLUMN `id_linea` INT(5) AFTER `id_marca`;

-- Añadir stock minimo a los productos
ALTER TABLE products ADD COLUMN `stock_min` DOUBLE(11,2) AFTER `id_linea`;

---------------------------------------------------------------------------------------------------------------------------- 29 Abr 17

-- Añadir inventario inical a los productos
ALTER TABLE products ADD COLUMN `invent_ini` DOUBLE(11,2) AFTER `id_linea`;

---------------------------------------------------------------------------------------------------------------------------- 02 May 17

-- Añadir id proveedor a los productos
ALTER TABLE products ADD COLUMN `id_provee` INT(5) AFTER `precio3`;

-- Añadir utilidades 1,2 y 3 a los productos
ALTER TABLE products ADD COLUMN `utili` INT(5) AFTER `id_linea`;
ALTER TABLE products ADD COLUMN `utili2` INT(5) AFTER `utili`;
ALTER TABLE products ADD COLUMN `utili3` INT(5) AFTER `utili2`;


---------------------------------------------------------------------------------------------------------------------------- 04 May 17
----------------------------------------------------------------------------------------------------------------------Update 08 May 17
-- OJO se tiene que modificar en hostinger
--
-- Table structure for table `stock_locations`
--

CREATE TABLE `stock_locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  `activate` int(1) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--------------------------------------------------------------------------------------------------------------------------- 11 May 17
-- Cambios a la estructura de clientes de nuevo - Falta reacer todo en hostinger

ALTER TABLE clientes ADD COLUMN `ape_pat_cliente` VARCHAR(20) AFTER `nombre_cliente`;
ALTER TABLE clientes ADD COLUMN `ape_mat_cliente` VARCHAR(20) AFTER `ape_pat_cliente`;
ALTER TABLE clientes ADD COLUMN `col_cliente` VARCHAR(100) AFTER `ape_mat_cliente`;
ALTER TABLE clientes ADD COLUMN `cp_cliente` VARCHAR(08) AFTER `col_cliente`;
ALTER TABLE clientes ADD COLUMN `ciudad_cliente` VARCHAR(50) AFTER `cp_cliente`;
ALTER TABLE clientes ADD COLUMN `estado_cliente` VARCHAR(20) AFTER `ciudad_cliente`;
ALTER TABLE clientes ADD COLUMN `pais_cliente` VARCHAR(20) AFTER `estado_cliente`;
ALTER TABLE clientes ADD COLUMN `tipo_cliente` TINYINT(1) AFTER `pais_cliente`;
ALTER TABLE clientes ADD COLUMN `rfc_cliente` VARCHAR(13) AFTER `tipo_cliente`;
ALTER TABLE clientes ADD COLUMN `tipo_prec_cliente` TINYINT(1) AFTER `rfc_cliente`;
ALTER TABLE clientes ADD COLUMN `lim_cred_cliente` DOUBLE(15,2) AFTER `tipo_prec_cliente`;
ALTER TABLE clientes ADD COLUMN `act_cred_cliente` TINYINT(1) AFTER `lim_cred_cliente`;
ALTER TABLE clientes MODIFY COLUMN `status_cliente` TINYINT(1);


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Crear tabla inventory para almacenar las bitacoras de entradas y vincularlo con los productos
CREATE TABLE `inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_product` int(11) NOT NULL DEFAULT '0',
  `trans_user` int(11) NOT NULL DEFAULT '0',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text NOT NULL,
  `trans_location` int(5) NOT NULL,
  `trans_inventory` decimal(15,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`trans_id`),
  KEY `trans_product` (`trans_product`),
  KEY `trans_user` (`trans_user`),
  KEY `trans_location` (`trans_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `inventory` 
  ADD CONSTRAINT `inventory_fk_1` FOREIGN KEY (`trans_product`) REFERENCES `products` (`id_producto`),
  ADD CONSTRAINT `inventory_fk_2` FOREIGN KEY (`trans_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `inventory_fk_3` FOREIGN KEY (`trans_location`) REFERENCES `stock_locations` (`location_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




-- Crear tabla cantidades_products para almacenar las cantidades y  vincularlo con los productos
CREATE TABLE `cantidades_products` (
  `item_id` int(11) NOT NULL,
  `location_id` int(5) NOT NULL,
  `cantidad` decimal(15,3) NOT NULL DEFAULT '0.000',
  ADD PRIMARY KEY (`item_id`,`location_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `cantidades_products`
  ADD CONSTRAINT `cantidades_products_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `products` (`id_producto`),
  ADD CONSTRAINT `cantidades_products_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `stock_locations` (`location_id`);


