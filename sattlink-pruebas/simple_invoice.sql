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
  `id_cliente` INT(11) NOT NULL,
  `nombre_cliente` VARCHAR(255) NOT NULL,
  `telefono_cliente` CHAR(30) NOT NULL,
  `email_cliente` VARCHAR(64) NOT NULL,
  `direccion_cliente` VARCHAR(255) NOT NULL,
  `status_cliente` TINYINT(4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- Como referencia
-- PRIMARY KEY (`id_cliente`),
-- UNIQUE KEY `codigo_producto` (`nombre_cliente`);
-- MODIFY `id_cliente` INT(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` INT(10) unsigned NOT NULL,
  `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` VARCHAR(255) NOT NULL,
  `precision` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
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
  `id_detalle` INT(11) NOT NULL,
  `numero_factura` INT(11) NOT NULL,
  `id_producto` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `precio_venta` DOUBLE NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ADD PRIMARY KEY (`id_detalle`),
-- (OJO ANTERIOR) KEY `numero_cotizacion` (`numero_factura`,`id_producto`);
-- ADD KEY `numero_factura` (`numero_factura`);
-- MODIFY `id_detalle` INT(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` INT(11) NOT NULL,
  `numero_factura` INT(11) NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `id_cliente` INT(11) NOT NULL,
  `id_vendedor` INT(11) NOT NULL,
  `condiciones` VARCHAR(30) NOT NULL,
  `total_venta` VARCHAR(20) NOT NULL,
  `estado_factura` TINYINT(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- Como referencia
-- PRIMARY KEY (`id_factura`),
-- UNIQUE KEY `numero_cotizacion` (`numero_factura`);
-- MODIFY `id_factura` INT(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` INT(11) NOT NULL,
  `nombre_empresa` VARCHAR(150) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `ciudad` VARCHAR(100) NOT NULL,
  `codigo_postal` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `impuesto` INT(2) NOT NULL,
  `moneda` VARCHAR(6) NOT NULL,
  `logo_url` VARCHAR(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_empresa`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `telefono`, `email`, `impuesto`, `moneda`, `logo_url`) VALUES
(1, 'MAXIMCODE', 'Colonia centro S/N', 'Tuxtepec', '68300', 'Oaxaca', '+(52) 2871453896', 'info@maximcode.com', 16, '$', 'img/1478792451_google30.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id_producto` INT(11) NOT NULL,
  `codigo_producto` CHAR(20) NOT NULL,
  `nombre_producto` CHAR(255) NOT NULL,
  `status_producto` TINYINT(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` DOUBLE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` INT(11) NOT NULL,
  `id_producto` INT(11) NOT NULL,
  `cantidad_tmp` INT(11) NOT NULL,
  `precio_tmp` DOUBLE(8,2) DEFAULT NULL,
  `session_id` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` VARCHAR(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` VARCHAR(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
-- Como refrencia
-- RIMARY KEY (`user_id`),
-- UNIQUE KEY `user_name` (`user_name`),
-- UNIQUE KEY `user_email` (`user_email`);
-- MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT 

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'Elio', 'Mojica', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'admin@maximcode.com', curdate());

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
  ADD KEY `numero_factura` (`numero_factura`);

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
  MODIFY `id_cliente` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` INT(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Create table `unidades`
--
CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` INT(5) NOT NULL AUTO_INCREMENT,
  `nombre_unidad` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Create table `marcas`
--
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` INT(5) NOT NULL AUTO_INCREMENT,
  `nombre_marca` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Create table `lineas`
--
CREATE TABLE IF NOT EXISTS `lineas` (
  `id_linea` INT(5) NOT NULL AUTO_INCREMENT,
  `nombre_linea` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_linea`),
  UNIQUE INDEX (`nombre_linea`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `products` ADD `product_img` VARCHAR(50) NULL;
 
ALTER TABLE `unidades` ADD UNIQUE INDEX ( `nombre_unidad` );

ALTER TABLE `marcas` ADD UNIQUE INDEX ( `nombre_marca` );

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

-- Añadir inventario inical a los productos
ALTER TABLE products ADD COLUMN `invent_ini` DOUBLE(11,2) AFTER `id_linea`;

-- Añadir id proveedor a los productos
ALTER TABLE products ADD COLUMN `id_provee` INT(5) AFTER `precio3`;

-- Añadir utilidades 1,2 y 3 a los productos
ALTER TABLE products ADD COLUMN `utili` INT(5) AFTER `id_linea`;
ALTER TABLE products ADD COLUMN `utili2` INT(5) AFTER `utili`;
ALTER TABLE products ADD COLUMN `utili3` INT(5) AFTER `utili2`;

-- Añadir si el producto es inventariable si es NO su valor es cero y se refiere a un servicio
ALTER TABLE products ADD COLUMN `prod_invent` TINYINT(1) DEFAULT 1 AFTER `utili3`;

--
-- Table structure for table `stock_locations`
--
CREATE TABLE `stock_locations` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `activate` INT(1) NOT NULL,
  `deleted` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 11 May 17
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

-- Crear tabla inventory para almacenar las bitacoras de entradas y vincularlo con los productos
CREATE TABLE `inventory` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_product` INT(11) NOT NULL DEFAULT '0',
  `id_user` INT(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `comment` text NOT NULL,
  `id_location` INT(5) NOT NULL,
  `cant_inventory` DECIMAL(15,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`),
  KEY `id_location` (`id_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `inventory` 
  ADD CONSTRAINT `inventory_fk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_producto`),
  ADD CONSTRAINT `inventory_fk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `inventory_fk_3` FOREIGN KEY (`id_location`) REFERENCES `stock_locations` (`id`);


-- Crear tabla cantidades_products para almacenar las cantidades y  vincularlo con los productos
CREATE TABLE `cant_products` (
  `id_product` INT(11) NOT NULL,
  `id_location` INT(5) NOT NULL,
  `cantidad` DECIMAL(15,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id_product`,`id_location`),
  KEY `id_product` (`id_product`),
  KEY `id_location` (`id_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `cant_products`
  ADD CONSTRAINT `cant_products_fk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_producto`),
  ADD CONSTRAINT `cant_products_fk_2` FOREIGN KEY (`id_location`) REFERENCES `stock_locations` (`id`);

-- Añadir a la tabla facturas el campo tipo de documento: tipo_doc el cual sera su valor
-- "1" Venta, "2" Cotizacion
ALTER TABLE facturas ADD COLUMN `tipo_doc` TINYINT(1) DEFAULT 0 AFTER `estado_factura`;
ALTER TABLE facturas ADD COLUMN `cerrada` TINYINT(1) DEFAULT 0 AFTER `tipo_doc`;

--
--     												23 MAY 2017 SE TIENEN QUE HACER EN UBUNTU SERVER (YA EN TODOS)

-- Se crea tabla para los valores de utilidades en automatico
CREATE TABLE `utilidades` (
  `id` INT(2) NOT NULL,
  `utilidad_1` DECIMAL(5,3) NOT NULL DEFAULT '0.000',
  `utilidad_2` DECIMAL(5,3) NOT NULL DEFAULT '0.000',
  `utilidad_3` DECIMAL(5,3) NOT NULL DEFAULT '0.000',
  `utilidad_4` DECIMAL(5,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE products ADD COLUMN `utili4` INT(5) AFTER `utili3`;
ALTER TABLE products ADD COLUMN `precio4` DOUBLE(15,2) AFTER `precio3`;


ALTER TABLE `products` AUTO_INCREMENT=0;
ALTER TABLE `inventory` AUTO_INCREMENT=0;
ALTER TABLE `facturas` AUTO_INCREMENT=1302;
ALTER TABLE `detalle_factura` AUTO_INCREMENT=1302;

--																														24 MAY 2017 

-- Crear un campo en el detalle de las facturas para almacenar la MAC de un producto que cuente con ello, sera un dato adicional
-- al guardarse el detalle de ese documento

ALTER TABLE detalle_factura ADD COLUMN `dato_adicional` TEXT AFTER `precio_venta`;
ALTER TABLE tmp ADD COLUMN `dato_adicional` TEXT;
ALTER TABLE tmp ADD COLUMN `tax_tmp` TINYINT(1);

--
--                      																			29 MAY 2017 CREADO EN TODOS H Y S

CREATE TABLE `proveedores` (
  `id_prove` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_prove` CHAR(100) NOT NULL, 
  `rfc_prove` CHAR(15), 
  `tel1_prove` CHAR(20), 
  `tel2_prove` CHAR(20), 
  `direccion_prove` CHAR(100) NOT NULL, 
  `colonia_prove` CHAR(100), 
  `cp_prove` CHAR(10), 
  `ciudad_prove` CHAR(50), 
  `estado_prove` CHAR(20), 
  `email_prove` CHAR(50), 
  `represe_legal_prove` CHAR(50), 
  `saldo_prove` DECIMAL(15,2) DEFAULT 0, 
  `dias_cred_prove` TINYINT(3) DEFAULT 0, 
  PRIMARY KEY (`id_prove`),
  UNIQUE KEY (`nombre_prove`) 
) engine=innodb default charset=utf8;

--
--                      																								31 MAY 2017 
-- Se requiere registrar un cliente foraneo sin necesidad de registrarlo en el catalogo de clientes, para ello se crearan campos
-- basicos de registro que iran en la tabla factura:
ALTER TABLE facturas ADD COLUMN `cliente_foraneo` CHAR(100);
ALTER TABLE facturas ADD COLUMN `tel_cliente_foraneo` CHAR(30);
ALTER TABLE facturas ADD COLUMN `email_cliente_foraneo` CHAR(64);

-- Se crea campo para controlar el numero asignado para cliente foraneo en el catalogo de clientes,primero se debe de registrar el 
-- cliente foraneo
ALTER TABLE perfil ADD COLUMN `numeracion_cliente_foraneo` INT(11);

--
--                      																								06 MAY 2017 
-- Se requiere registrar las entradas de los productos a manera rapida
-- *** Pendiente ***

--
--                      																								06 MAY 2017 
-- Compras
CREATE TABLE `compras` (
  `id_compra` INT(11) NOT NULL AUTO_INCREMENT,
  `id_prove` INT(11) NOT NULL DEFAULT '0',
  `id_almacen` INT(5) NOT NULL DEFAULT '0',
  `numero_factura` VARCHAR(20) NOT NULL,
  `pedido` VARCHAR(20),
  `fecha_fact` DATETIME NOT NULL,
  `plazo_pago_dias` INT(5) DEFAULT '0',
  `fecha_fact_venc` DATETIME,
  `metodo_pago` INT(2) NOT NULL DEFAULT '0',
  `forma_pago` INT(2) NOT NULL DEFAULT '0',
  `cargo_envio_fact` DECIMAL(15,3) DEFAULT '0',
  `cargo_externo_flete` DECIMAL(15,3) DEFAULT '0',
  `desc1` INT(5) DEFAULT '0',
  `desc2` INT(5) DEFAULT '0',
  `total_factura` DECIMAL(15,3) DEFAULT '0',
  PRIMARY KEY (`id_compra`),
  KEY `numero_factura` (`numero_factura`),
  KEY `id_prove` (`id_prove`),
  KEY `id_almacen` (`id_almacen`)
) ENGINE=innodb DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE compras MODIFY COLUMN `fecha_fact_venc` DATETIME NULL DEFAULT NULL;  -- **Este comando se omite***


#
# Table structure for table 'DETA_COMPRAS'
#

CREATE TABLE `deta_compras` (
  `id_deta_compra` INT(11) NOT NULL AUTO_INCREMENT, 
  `numero_factura` VARCHAR(20) NOT NULL,
  `id_producto` INT(11) NOT NULL DEFAULT '0', 
  `cantidad` DECIMAL(15,3) NOT NULL DEFAULT '0', 
  `precio_costo` DECIMAL(15,3) NOT NULL DEFAULT '0', 
  `obser_partida` TEXT COLLATE utf8_unicode_ci, 
  `importe` DECIMAL(15,3) NOT NULL DEFAULT '0', 
  `iva` DECIMAL(15,3) NOT NULL DEFAULT '0', 
  `desc1` DECIMAL(15,3) DEFAULT '0', 
  `desc2` DECIMAL(15,3) DEFAULT '0', 
  `desc3` DECIMAL(15,3) DEFAULT '0', 
  `acumu_desc` DECIMAL(15,3) DEFAULT '0', 
  `total_desc` DECIMAL(15,3) DEFAULT '0', 
  `cantidad_ant` DECIMAL(15,3) DEFAULT '0', 
  PRIMARY KEY (`id_deta_compra`),
  KEY `numero_factura` (`numero_factura`),
  KEY `id_producto` (`id_producto`)
) ENGINE=innodb DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tmp_deta_compras` (
  `id_tmp` INT(11) NOT NULL AUTO_INCREMENT,
  `id_producto_tmp` INT(11) NOT NULL,
  `cantidad_tmp` INT(11) NOT NULL,
  `precio_tmp` DECIMAL(15,2) NOT NULL,
  `session_id_tmp` VARCHAR(100) NOT NULL,
  `obser_partida_tmp` TEXT COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--                      																								15 JUL 2017 
-- Se requiere cambiar el campo id_deta_compra de la tabla deta_compras y quitarle AUTO_INCREMENT
-- *** Pendiente *** en Hostinger
--ALTER TABLE deta_compras MODIFY COLUMN `id_deta_compra` INT(11) NOT NULL;
--ALTER TABLE deta_compras DROP PRIMARY KEY (`id_deta_compra`);
--ALTER TABLE deta_compras DROP INDEX index_name;
--ALTER TABLE deta_compras ADD PRIMARY KEY `id_deta_compra` NOT NULL AUTO_INCREMENT;
SHOW INDEX FROM deta_compras;
ALTER TABLE deta_compras ADD COLUMN `id_compra` INT(11) NOT NULL DEFAULT 0 AFTER `id_deta_compra`;
ALTER TABLE deta_compras ADD KEY `id_compra` (`id_compra`);

--                      																								18 JUL 2017 
-- Se requieren agregar campos a la tabla users y perfil para el envio de correo electronico
ALTER TABLE users ADD COLUMN `pasw_mail` VARCHAR(255) COLLATE utf8_unicode_ci AFTER `user_email`;
ALTER TABLE perfil ADD COLUMN `activate_smtp` TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE perfil ADD COLUMN `type_encript` TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE perfil ADD COLUMN `host_mail` VARCHAR(50) NULL;
ALTER TABLE perfil ADD COLUMN `host_port` INT(2) NOT NULL DEFAULT 0;
-- 																														25 JUL 2017 
-- Asunto y mensaje del cuerpo del correo
ALTER TABLE perfil ADD COLUMN `subject` VARCHAR(100) NOT NULL;
ALTER TABLE perfil ADD COLUMN `body` TINYTEXT NOT NULL;

-- 																														25 JUL 2017 
-- Asunto ampliar ancho de mails tanto para clientes como para cliente foraneo en facturas
ALTER TABLE clientes MODIFY COLUMN `email_cliente` VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci;
ALTER TABLE facturas MODIFY COLUMN `email_cliente_foraneo` VARCHAR(255) COLLATE utf8_unicode_ci;

--**********************************************************************************************************************A G O S T O

-- 																														28 AGO 2017 
-- Asunto agregar a la tabla tmp fecha de creacion *** Ya se actualizo en produccion
ALTER TABLE tmp ADD COLUMN `date_added` DATETIME NOT NULL;

--                      																								30 AGO 2017 
-- Se requiere agregar un campo a la tabla users para el identificar el administrador *** Ya se actualizo en produccion
ALTER TABLE users ADD COLUMN `type_user` TINYINT(1) NOT NULL DEFAULT 0;

--**********************************************************************************************************************O C T U B R E
-- Asunto crear resto de campos para almacenar datos del cliente foraneo *** Ya se actualizo en produccion
ALTER TABLE facturas ADD COLUMN `direccion_cliente_foraneo` VARCHAR(255) NULL COLLATE utf8_general_ci;
ALTER TABLE facturas ADD COLUMN `col_cliente_foraneo` VARCHAR(100) NULL COLLATE utf8_general_ci;
ALTER TABLE facturas ADD COLUMN `ciudad_cliente_foraneo` VARCHAR(50) NULL COLLATE utf8_general_ci;
ALTER TABLE facturas ADD COLUMN `rfc_cliente_foraneo` VARCHAR(13) NULL COLLATE utf8_general_ci;
--**********************************************************************************************************************O C T U B R E
-- Asunto crear un campo para las membresias seleccionadas *** Ya se actualizo en produccion
ALTER TABLE facturas ADD COLUMN `membresias_selections` VARCHAR(20) NULL COLLATE utf8_general_ci;

--**************************************************************************************************************************NOVIEMBRE
-- Se requiere agregar un campo a la tabla users para el mail alterno no obligado *** Ya se actualizo en produccion
ALTER TABLE users ADD COLUMN `mail_alterno` VARCHAR(64) NULL;

-- Se requiere agregar un campo a la tabla products para el IVA individual por cada producto o servicio***Ya se actualizo en produccion
ALTER TABLE products ADD COLUMN `iva` TINYINT(1) DEFAULT 1;

-- Se requiere agregar un campo a la tabla tmp para el IVA individual por cada producto o servicio
-- esto por si en la venta o coti se quisieran cambiar para estos casos sin alterar el valor original en el catalog de productos
-- 																							***Ya se actualizo en produccion
ALTER TABLE tmp ADD COLUMN `tax_iva` TINYINT(1) DEFAULT 0;

-- Se requiere el IVA individual por cada producto o servicio esto valor viene de la tabla tmp al ser guardado el nuevo documento 
--																							***Ya se actualizo en produccion
ALTER TABLE `detalle_factura` ADD `tax_iva` TINYINT(1) DEFAULT 0;

-- ==========================================================================================================================
-- ==================================================( 2018 )================================================================
-- ==========================================================================================================================
--																													03Dic2018
-- Eliminar el index para poder repetir nombres de clientes		*** Ya se actualizo en produccion
ALTER TABLE clientes DROP INDEX codigo_producto

-- ==========================================================================================================================
--																													04Jun2018
-- Hay servicios en el catalogo de productos que se se toma en cuenta la cantidad para ser multiplicadas, para eso
-- se creara una bandera(flag) valor 0-Off, 1-On

ALTER TABLE `products` ADD `allow_ope_quantity` TINYINT(1) DEFAULT 1;	*** Ya se actualizo en produccion,NO existe FORM

-- ==========================================================================================================================
--																													04Jun2019
-- Seleccionar empresa interna para los documentos ventas o cotizaciones
-- selector: ENLACE DE DATOS Y REDES, SARAHI YULIANA GARCIA USCANGA

ALTER TABLE `facturas` ADD `empresaslc` TINYINT(1) NULL DEFAULT 0;
