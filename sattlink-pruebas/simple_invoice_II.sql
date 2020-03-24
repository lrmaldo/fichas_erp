--
-- Diagrama II Referencia para contruir las estructura de la tabla cotizacion
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
-- Como referencia
-- PRIMARY KEY (`id_factura`),
-- UNIQUE KEY `numero_cotizacion` (`numero_factura`);
-- MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- Como referencia
-- RIMARY KEY (`id_detalle`),
-- KEY `numero_cotizacion` (`numero_factura`,`id_producto`);
-- MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- Como referencia
-- PRIMARY KEY (`id_cliente`),
-- UNIQUE KEY `codigo_producto` (`nombre_cliente`);
-- MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
-- Como refrencia
-- RIMARY KEY (`user_id`),
-- UNIQUE KEY `user_name` (`user_name`),
-- UNIQUE KEY `user_email` (`user_email`);
-- MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT 

--
-- estructura tabla cotizaciones
--
CREATE TABLE IF NOT EXISTS `cotizaciones` (
	`id_cotizacion` int(11) NOT NULL AUTO_INCREMENT,
	`numero_cotizacion` int(11) NOT NULL,
	`fecha_cotizacion` datetime NOT NULL,
	`id_cliente` int(11) NOT NULL,
	`id_vendedor` int(11) NOT NULL,
	`condiciones` varchar(30) NOT NULL,
	`total_cotizacion` varchar(20) NOT NULL,
	`estado_cotizacion` tinyint(1) NOT NULL,
	PRIMARY KEY (`id_cotizacion`),
	UNIQUE KEY `numero_cotizacion` (`numero_cotizacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `detalle_cotizaciones` (
	`id_detalle` int(11) NOT NULL AUTO_INCREMENT,
	`numero_cotizacion` int(11) NOT NULL,
	`id_producto` int(11) NOT NULL,
	`cantidad` int(11) NOT NULL,
	`precio_venta` double NOT NULL,
	PRIMARY KEY (`id_detalle`),
	KEY `numero_documento_detalle` (`numero_cotizacion`,`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
