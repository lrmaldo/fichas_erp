CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` VARCHAR(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` VARCHAR(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` VARCHAR(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',AUTO_INCREMENT=2;

--
-- Para ajustar se necesitan estos complementos  
ALTER TABLE `users` ADD COLUMN `user_comunidad` VARCHAR(50) NOT NULL;
ALTER TABLE `users` ADD COLUMN `user_hotspot` VARCHAR(50) NOT NULL;
ALTER TABLE `users` ADD COLUMN `user_facebook` VARCHAR(50);
ALTER TABLE `users` ADD COLUMN `user_whatsap` VARCHAR(30) NOT NULL;
ALTER TABLE `users` ADD COLUMN `user_comentarios` TEXT;
ALTER TABLE `users` ADD COLUMN `user_porcent` DECIMAL(8,3) DEFAULT '0';
ALTER TABLE `users` ADD COLUMN `activado` INT(1) DEFAULT 1;


CREATE TABLE IF NOT EXISTS `fichas_horas` (
  `fichas_id` INT(11) NOT NULL,
  `fichas_user_id` INT(11) NOT NULL,
  `fichas_1_hra` INT(11) NOT NULL DEFAULT 0,
  `fichas_2_hra` INT(11) NOT NULL DEFAULT 0,
  `fichas_3_hra` INT(11) NOT NULL DEFAULT 0,
  `fichas_4_hra` INT(11) NOT NULL DEFAULT 0,
  `fichas_5_hra` INT(11) NOT NULL DEFAULT 0,
  `fichas_6_hra` INT(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Para ajustar se necesitan estos complementos  																			11Ago2017
ALTER TABLE `fichas_horas` ADD PRIMARY KEY (`fichas_id`);
ALTER TABLE `fichas_horas` MODIFY `fichas_id` INT(11) NOT NULL AUTO_INCREMENT;


-- Registro y control de fichas																								22Ago2017
CREATE TABLE IF NOT EXISTS `record_cards` (
  `record_card_id` INT(11) NOT NULL,
  `record_card_user_id` INT(11) NOT NULL,
  `record_card_num_hora` INT(11) NOT NULL,
  `record_card_user` INT(11) NOT NULL DEFAULT 0,
  `record_card_pasw` INT(11) NOT NULL DEFAULT 0,
  `record_card_date` DATETIME NOT NULL,
  `record_card_used` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`record_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `record_cards` MODIFY `record_card_id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `record_cards` MODIFY `record_card_user` VARCHAR(08) NOT NULL;
ALTER TABLE `record_cards` MODIFY `record_card_pasw` VARCHAR(08) NOT NULL;

ALTER TABLE `record_cards` AUTO_INCREMENT=0;

--- =========================================================================================================================
--- Nueva tabla comunidades																							28Nov2017
CREATE TABLE IF NOT EXISTS `comunidades` (
  `id_comunidad` INT(5) NOT NULL AUTO_INCREMENT,
  `nombre_comunidad` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_comunidad`),
  UNIQUE INDEX (`nombre_comunidad`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `users` ADD COLUMN `user_comunidad` INT(1) NOT NULL DEFAULT 0 AFTER date_added;

--- ================================================================================================================15DIC2017
--- Agregar nuevo campo a users para las iniciales que iran en la generacion del codigo del usuario ejemplo:
--- USUARIO: elio	INICIALES: E
--- Se suspende, se tomara la primera letra inicial del usuario en automatico

--- ================================================================================================================29ENE2018
--- Se necesita almacenar en el catalogo de users lo sisguientes campos
	
	ALTER TABLE `users` ADD COLUMN `prec_hra1` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `prec_hra2` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `prec_hra3` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `prec_hra4` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `prec_hra5` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `prec_hra6` DECIMAL(8,2) DEFAULT '0';
	ALTER TABLE `users` ADD COLUMN `print_prec_fichas` TINYINT(1) DEFAULT 0;

--- ================================================================================================================09OCT2018
--- Se necesita crear la tablas tiempos
