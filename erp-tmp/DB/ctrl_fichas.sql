-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-10-2018 a las 17:19:57
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.36-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ctrl_fichas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE `comunidades` (
  `id_comunidad` int(5) NOT NULL,
  `nombre_comunidad` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id_comunidad`, `nombre_comunidad`) VALUES
(1, 'COMUNIDAD-1'),
(2, 'COMUNIDAD2'),
(3, 'COMUNIDAD 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(17, 'Swiss Franc', 'CHF ', '2', '\'', '.', 'CHF'),
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
-- Estructura de tabla para la tabla `fichas_horas`
--

CREATE TABLE `fichas_horas` (
  `fichas_id` int(11) NOT NULL,
  `fichas_user_id` int(11) NOT NULL,
  `fichas_1_hra` int(11) NOT NULL DEFAULT '0',
  `fichas_2_hra` int(11) NOT NULL DEFAULT '0',
  `fichas_3_hra` int(11) NOT NULL DEFAULT '0',
  `fichas_4_hra` int(11) NOT NULL DEFAULT '0',
  `fichas_5_hra` int(11) NOT NULL DEFAULT '0',
  `fichas_6_hra` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fichas_horas`
--

INSERT INTO `fichas_horas` (`fichas_id`, `fichas_user_id`, `fichas_1_hra`, `fichas_2_hra`, `fichas_3_hra`, `fichas_4_hra`, `fichas_5_hra`, `fichas_6_hra`) VALUES
(1, 1, 0, 100, 20, 30, 0, 200),
(2, 9, 0, 0, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0, 0, 0),
(4, 13, 0, 0, 0, 0, 0, 0),
(5, 14, 0, 0, 0, 0, 0, 0),
(6, 15, 0, 0, 0, 0, 0, 0),
(7, 16, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
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
  `logo_url` varchar(255) NOT NULL,
  `numeracion_cliente_foraneo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_empresa`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `telefono`, `email`, `impuesto`, `moneda`, `logo_url`, `numeracion_cliente_foraneo`) VALUES
(1, 'MAXIMCODE', 'Colonia centro S/N', 'Tuxtepec', '68300', 'Oaxaca', '+(52) 2871453896', 'info@maximcode.com', 16, '$', 'img/1478792451_google30.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `record_cards`
--

CREATE TABLE `record_cards` (
  `record_card_id` int(11) NOT NULL,
  `record_card_user_id` int(11) NOT NULL,
  `record_card_num_hora` int(11) NOT NULL,
  `record_card_user` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `record_card_pasw` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `record_card_date` datetime NOT NULL,
  `record_card_used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `record_cards`
--

INSERT INTO `record_cards` (`record_card_id`, `record_card_user_id`, `record_card_num_hora`, `record_card_user`, `record_card_pasw`, `record_card_date`, `record_card_used`) VALUES
(223, 3, 1, 'j001', '4014', '2018-01-02 12:13:15', 1),
(224, 3, 1, 'j002', '6708', '2018-01-02 12:13:15', 1),
(225, 3, 1, 'j003', '1004', '2018-01-02 12:13:15', 1),
(226, 3, 1, 'j005', '2858', '2018-01-02 12:13:15', 1),
(227, 3, 1, 'j004', '3596', '2018-01-02 12:13:15', 1),
(228, 3, 2, 'j003', '5193', '2018-01-06 12:29:08', 1),
(229, 3, 2, 'j002', '5090', '2018-01-06 12:29:08', 1),
(230, 3, 2, 'j004', '7060', '2018-01-06 12:29:08', 1),
(231, 3, 2, 'j006', '7924', '2018-01-06 12:29:08', 1),
(232, 3, 2, 'j005', '5945', '2018-01-06 12:29:09', 1),
(233, 3, 2, 'j008', '9132', '2018-01-06 12:29:09', 1),
(234, 3, 2, 'j007', '2131', '2018-01-06 12:29:09', 1),
(235, 3, 2, 'j009', '1238', '2018-01-06 12:29:09', 1),
(236, 3, 2, 'j001', '3249', '2018-01-06 12:29:09', 1),
(237, 3, 2, 'j010', '2857', '2018-01-06 12:29:09', 1),
(238, 3, 1, 'j006', '8626', '2018-01-08 12:15:46', 1),
(239, 3, 1, 'j007', '1621', '2018-01-08 12:15:46', 1),
(240, 3, 1, 'j008', '6555', '2018-01-08 12:15:46', 1),
(241, 3, 1, 'j009', '1086', '2018-01-08 12:16:37', 1),
(242, 3, 1, 'j010', '7513', '2018-01-08 12:16:37', 1),
(243, 3, 1, 'j011', '9549', '2018-01-08 12:33:57', 1),
(244, 3, 1, 'j012', '5015', '2018-01-08 12:33:57', 1),
(245, 3, 1, 'j013', '9039', '2018-01-08 12:34:26', 1),
(246, 3, 1, 'j014', '5228', '2018-01-08 12:42:00', 1),
(247, 3, 1, 'j017', '9766', '2018-01-08 12:42:00', 1),
(248, 3, 1, 'j015', '9497', '2018-01-08 12:42:00', 1),
(249, 3, 1, 'j021', '3421', '2018-01-08 12:42:00', 1),
(250, 3, 1, 'j016', '4883', '2018-01-08 12:42:01', 1),
(251, 3, 1, 'j018', '4365', '2018-01-08 12:42:01', 1),
(252, 3, 1, 'j019', '4769', '2018-01-08 12:42:01', 1),
(253, 3, 1, 'j023', '8466', '2018-01-08 12:42:01', 1),
(254, 3, 1, 'j022', '8868', '2018-01-08 12:42:01', 1),
(255, 3, 1, 'j024', '1377', '2018-01-08 12:42:01', 1),
(256, 3, 1, 'j026', '4126', '2018-01-08 12:42:01', 1),
(257, 3, 1, 'j029', '2931', '2018-01-08 12:42:01', 1),
(258, 3, 1, 'j028', '8505', '2018-01-08 12:42:01', 1),
(259, 3, 1, 'j027', '7503', '2018-01-08 12:42:01', 1),
(260, 3, 1, 'j030', '9707', '2018-01-08 12:42:01', 1),
(261, 3, 1, 'j033', '4009', '2018-01-08 12:42:01', 1),
(262, 3, 1, 'j034', '7353', '2018-01-08 12:42:01', 1),
(263, 3, 1, 'j035', '2196', '2018-01-08 12:42:01', 1),
(264, 3, 1, 'j038', '1862', '2018-01-08 12:42:01', 1),
(265, 3, 1, 'j037', '5964', '2018-01-08 12:42:01', 1),
(266, 3, 1, 'j020', '4466', '2018-01-08 12:42:01', 1),
(267, 3, 1, 'j040', '4832', '2018-01-08 12:42:01', 1),
(268, 3, 1, 'j031', '8180', '2018-01-08 12:42:01', 1),
(269, 3, 1, 'j025', '6266', '2018-01-08 12:42:01', 1),
(270, 3, 1, 'j041', '8228', '2018-01-08 12:42:01', 1),
(271, 3, 1, 'j032', '4166', '2018-01-08 12:42:02', 1),
(272, 3, 1, 'j036', '1902', '2018-01-08 12:42:02', 1),
(273, 3, 1, 'j039', '3828', '2018-01-08 12:42:02', 1),
(274, 3, 1, 'j046', '7566', '2018-01-08 12:42:02', 1),
(275, 3, 1, 'j042', '1277', '2018-01-08 12:42:02', 1),
(276, 3, 1, 'j049', '9010', '2018-01-08 12:42:02', 1),
(277, 3, 1, 'j050', '3661', '2018-01-08 12:42:02', 1),
(278, 3, 1, 'j051', '7470', '2018-01-08 12:42:02', 1),
(279, 3, 1, 'j052', '4381', '2018-01-08 12:42:02', 1),
(280, 3, 1, 'j053', '6904', '2018-01-08 12:42:02', 1),
(281, 3, 1, 'j045', '6194', '2018-01-08 12:42:02', 1),
(282, 3, 1, 'j043', '8161', '2018-01-08 12:42:02', 1),
(283, 3, 1, 'j044', '2185', '2018-01-08 12:42:02', 1),
(284, 3, 1, 'j047', '8420', '2018-01-08 12:42:02', 1),
(285, 3, 1, 'j048', '4575', '2018-01-08 12:42:02', 1),
(286, 3, 3, 'j001', '6092', '2018-01-12 10:31:10', 1),
(287, 3, 3, 'j005', '5168', '2018-01-12 10:31:10', 1),
(288, 3, 3, 'j002', '8674', '2018-01-12 10:31:10', 1),
(289, 3, 3, 'j003', '3330', '2018-01-12 10:31:10', 1),
(290, 3, 3, 'j004', '3523', '2018-01-12 10:31:10', 1),
(291, 3, 3, 'j006', '6141', '2018-01-12 10:31:10', 1),
(292, 3, 3, 'j008', '7573', '2018-01-12 10:31:10', 1),
(293, 3, 3, 'j007', '3647', '2018-01-12 10:31:10', 1),
(294, 13, 2, 'l001', '9714', '2018-01-12 12:44:19', 1),
(295, 13, 2, 'l005', '6255', '2018-01-12 12:44:19', 1),
(296, 13, 2, 'l003', '3098', '2018-01-12 12:44:19', 1),
(297, 13, 2, 'l004', '9970', '2018-01-12 12:44:19', 1),
(298, 13, 2, 'l006', '9472', '2018-01-12 12:44:19', 1),
(299, 13, 2, 'l002', '8145', '2018-01-12 12:44:19', 1),
(300, 13, 2, 'l008', '5186', '2018-01-12 12:44:19', 1),
(301, 13, 2, 'l007', '2057', '2018-01-12 12:44:19', 1),
(302, 13, 1, 'l001', '6286', '2018-01-14 21:33:56', 1),
(303, 13, 1, 'l003', '7851', '2018-01-14 21:33:56', 1),
(304, 13, 1, 'l004', '9924', '2018-01-14 21:33:56', 1),
(305, 13, 1, 'l005', '8397', '2018-01-14 21:33:56', 1),
(306, 13, 1, 'l006', '1523', '2018-01-14 21:33:56', 1),
(307, 13, 1, 'l008', '7711', '2018-01-14 21:33:56', 1),
(308, 13, 1, 'l009', '9920', '2018-01-14 21:33:56', 1),
(309, 13, 1, 'l010', '4004', '2018-01-14 21:33:56', 1),
(310, 13, 1, 'l011', '1979', '2018-01-14 21:33:56', 1),
(311, 13, 1, 'l012', '8439', '2018-01-14 21:33:56', 1),
(312, 13, 1, 'l013', '4581', '2018-01-14 21:33:56', 1),
(313, 13, 1, 'l015', '3828', '2018-01-14 21:33:56', 1),
(314, 13, 1, 'l014', '5425', '2018-01-14 21:33:56', 1),
(315, 13, 1, 'l016', '4997', '2018-01-14 21:33:56', 1),
(316, 13, 1, 'l017', '7609', '2018-01-14 21:33:56', 1),
(317, 13, 1, 'l007', '4847', '2018-01-14 21:33:57', 1),
(318, 13, 1, 'l019', '4136', '2018-01-14 21:33:57', 1),
(319, 13, 1, 'l018', '8803', '2018-01-14 21:33:57', 1),
(320, 13, 1, 'l020', '7664', '2018-01-14 21:33:57', 1),
(321, 9, 3, 'p001', '7757', '2018-07-30 11:14:21', 1),
(322, 9, 3, 'p002', '3824', '2018-07-30 11:14:21', 1),
(323, 9, 3, 'p005', '5356', '2018-07-30 11:14:21', 1),
(324, 9, 3, 'p004', '9802', '2018-07-30 11:14:21', 1),
(325, 9, 3, 'p003', '1805', '2018-07-30 11:14:21', 1),
(326, 9, 3, 'p006', '6335', '2018-07-30 11:14:21', 1),
(327, 9, 3, 'p007', '3066', '2018-07-30 11:14:21', 1),
(328, 9, 3, 'p008', '5092', '2018-07-30 11:14:21', 1),
(329, 9, 3, 'p009', '3316', '2018-07-30 11:14:21', 1),
(330, 9, 3, 'p010', '8896', '2018-07-30 11:14:21', 1),
(331, 9, 3, 'p011', '4035', '2018-07-30 11:14:21', 1),
(332, 9, 3, 'p012', '4029', '2018-07-30 11:14:21', 1),
(333, 9, 3, 'p014', '7881', '2018-07-30 11:14:21', 1),
(334, 9, 3, 'p015', '5930', '2018-07-30 11:14:21', 1),
(335, 9, 3, 'p016', '1771', '2018-07-30 11:14:22', 1),
(336, 9, 3, 'p017', '5738', '2018-07-30 11:14:22', 1),
(337, 9, 3, 'p013', '6613', '2018-07-30 11:14:22', 1),
(338, 9, 3, 'p018', '3131', '2018-07-30 11:14:22', 1),
(339, 9, 3, 'p021', '2543', '2018-07-30 11:14:22', 1),
(340, 9, 3, 'p022', '4696', '2018-07-30 11:14:22', 1),
(341, 9, 3, 'p024', '2141', '2018-07-30 11:14:22', 1),
(342, 9, 3, 'p023', '4812', '2018-07-30 11:14:22', 1),
(343, 9, 3, 'p025', '4317', '2018-07-30 11:14:22', 1),
(344, 9, 3, 'p026', '9563', '2018-07-30 11:14:22', 1),
(345, 9, 3, 'p027', '3741', '2018-07-30 11:14:22', 1),
(346, 9, 3, 'p028', '4063', '2018-07-30 11:14:22', 1),
(347, 9, 3, 'p029', '8523', '2018-07-30 11:14:22', 1),
(348, 9, 3, 'p019', '3124', '2018-07-30 11:14:22', 1),
(349, 9, 3, 'p030', '1202', '2018-07-30 11:14:22', 1),
(350, 9, 3, 'p032', '8937', '2018-07-30 11:14:22', 1),
(351, 9, 3, 'p033', '5667', '2018-07-30 11:14:22', 1),
(352, 9, 3, 'p034', '1851', '2018-07-30 11:14:22', 1),
(353, 9, 3, 'p031', '7637', '2018-07-30 11:14:22', 1),
(354, 9, 3, 'p036', '9393', '2018-07-30 11:14:22', 1),
(355, 9, 3, 'p035', '2424', '2018-07-30 11:14:22', 1),
(356, 9, 3, 'p020', '6764', '2018-07-30 11:14:22', 1),
(357, 9, 3, 'p037', '5264', '2018-07-30 11:14:22', 1),
(358, 9, 3, 'p039', '4105', '2018-07-30 11:14:23', 1),
(359, 9, 3, 'p038', '7518', '2018-07-30 11:14:23', 1),
(360, 9, 3, 'p040', '2417', '2018-07-30 11:14:23', 1),
(361, 9, 3, 'p042', '9889', '2018-07-30 11:14:23', 1),
(362, 9, 3, 'p043', '1576', '2018-07-30 11:14:23', 1),
(363, 9, 3, 'p044', '5124', '2018-07-30 11:14:23', 1),
(364, 9, 3, 'p041', '2395', '2018-07-30 11:14:23', 1),
(365, 9, 3, 'p045', '3457', '2018-07-30 11:14:23', 1),
(366, 9, 3, 'p047', '5104', '2018-07-30 11:14:23', 1),
(367, 9, 3, 'p046', '3141', '2018-07-30 11:14:23', 1),
(368, 9, 3, 'p049', '1015', '2018-07-30 11:14:23', 1),
(369, 9, 3, 'p048', '7899', '2018-07-30 11:14:23', 1),
(370, 9, 3, 'p050', '1735', '2018-07-30 11:14:23', 1),
(371, 9, 4, 'p001', '8674', '2018-08-17 13:32:50', 1),
(372, 9, 4, 'p002', '5877', '2018-08-17 13:32:51', 1),
(373, 9, 4, 'p004', '2905', '2018-08-17 13:32:51', 1),
(374, 9, 4, 'p005', '4389', '2018-08-17 13:32:51', 1),
(375, 9, 4, 'p006', '5595', '2018-08-17 13:32:51', 1),
(376, 9, 4, 'p003', '1344', '2018-08-17 13:32:51', 1),
(377, 9, 4, 'p007', '3695', '2018-08-17 13:32:51', 1),
(378, 9, 4, 'p008', '1426', '2018-08-17 13:32:51', 1),
(379, 9, 4, 'p009', '8566', '2018-08-17 13:32:51', 1),
(380, 9, 4, 'p011', '3444', '2018-08-17 13:32:51', 1),
(381, 9, 4, 'p010', '4366', '2018-08-17 13:32:51', 1),
(382, 9, 4, 'p012', '8235', '2018-08-17 13:32:51', 1),
(383, 9, 4, 'p013', '5507', '2018-08-17 13:32:51', 1),
(384, 9, 4, 'p014', '6159', '2018-08-17 13:32:51', 1),
(385, 9, 4, 'p015', '9168', '2018-08-17 13:32:51', 1),
(386, 9, 4, 'p017', '5989', '2018-08-17 13:32:51', 1),
(387, 9, 4, 'p018', '7326', '2018-08-17 13:32:51', 1),
(388, 9, 4, 'p016', '9894', '2018-08-17 13:32:51', 1),
(389, 9, 4, 'p019', '1811', '2018-08-17 13:32:52', 1),
(390, 9, 4, 'p021', '8850', '2018-08-17 13:32:52', 1),
(391, 9, 4, 'p020', '7006', '2018-08-17 13:32:52', 1),
(392, 9, 4, 'p022', '1871', '2018-08-17 13:32:52', 1),
(393, 9, 4, 'p023', '9999', '2018-08-17 13:32:52', 1),
(394, 9, 4, 'p024', '6696', '2018-08-17 13:32:52', 1),
(395, 9, 4, 'p025', '9585', '2018-08-17 13:32:52', 1),
(396, 9, 4, 'p026', '9285', '2018-08-17 13:32:52', 1),
(397, 9, 4, 'p028', '2151', '2018-08-17 13:32:52', 1),
(398, 9, 4, 'p027', '9505', '2018-08-17 13:32:52', 1),
(399, 9, 4, 'p030', '5605', '2018-08-17 13:32:52', 1),
(400, 9, 4, 'p029', '5081', '2018-08-17 13:32:52', 1),
(401, 9, 4, 'p031', '9601', '2018-08-17 13:32:52', 1),
(402, 9, 4, 'p032', '8814', '2018-08-17 13:32:52', 1),
(403, 9, 4, 'p033', '9404', '2018-08-17 13:32:52', 1),
(404, 9, 4, 'p034', '2592', '2018-08-17 13:32:52', 1),
(405, 9, 4, 'p035', '8965', '2018-08-17 13:32:53', 1),
(406, 9, 4, 'p036', '5695', '2018-08-17 13:32:53', 1),
(407, 9, 4, 'p039', '9222', '2018-08-17 13:32:53', 1),
(408, 9, 4, 'p037', '5007', '2018-08-17 13:32:53', 1),
(409, 9, 4, 'p038', '9402', '2018-08-17 13:32:53', 1),
(410, 9, 4, 'p040', '1211', '2018-08-17 13:32:53', 1),
(411, 9, 4, 'p041', '8023', '2018-08-17 13:32:53', 1),
(412, 9, 4, 'p042', '2304', '2018-08-17 13:32:53', 1),
(413, 9, 4, 'p044', '9052', '2018-08-17 13:32:53', 1),
(414, 9, 4, 'p043', '3741', '2018-08-17 13:32:53', 1),
(415, 9, 4, 'p045', '8147', '2018-08-17 13:32:53', 1),
(416, 9, 4, 'p046', '7147', '2018-08-17 13:32:53', 1),
(417, 9, 4, 'p048', '2491', '2018-08-17 13:32:53', 1),
(418, 9, 4, 'p049', '2846', '2018-08-17 13:32:53', 1),
(419, 9, 4, 'p047', '2825', '2018-08-17 13:32:53', 1),
(420, 9, 4, 'p050', '7152', '2018-08-17 13:32:53', 1),
(421, 10, 1, 'p001', '6447', '2018-10-09 16:31:07', 0),
(422, 10, 1, 'p002', '8790', '2018-10-09 16:31:07', 0),
(423, 10, 1, 'p004', '3697', '2018-10-09 16:31:07', 0),
(424, 10, 1, 'p003', '8148', '2018-10-09 16:31:07', 0),
(425, 10, 1, 'p005', '5525', '2018-10-09 16:31:07', 0),
(426, 10, 1, 'p006', '5828', '2018-10-09 16:31:08', 0),
(427, 10, 1, 'p008', '4228', '2018-10-09 16:31:08', 0),
(428, 10, 1, 'p009', '3460', '2018-10-09 16:31:08', 0),
(429, 10, 1, 'p011', '5542', '2018-10-09 16:31:08', 0),
(430, 10, 1, 'p012', '8308', '2018-10-09 16:31:08', 0),
(431, 10, 1, 'p010', '1887', '2018-10-09 16:31:08', 0),
(432, 10, 1, 'p015', '2291', '2018-10-09 16:31:08', 0),
(433, 10, 1, 'p013', '3984', '2018-10-09 16:31:08', 0),
(434, 10, 1, 'p007', '3685', '2018-10-09 16:31:08', 0),
(435, 10, 1, 'p017', '5802', '2018-10-09 16:31:08', 0),
(436, 10, 1, 'p018', '1555', '2018-10-09 16:31:08', 0),
(437, 10, 1, 'p016', '4951', '2018-10-09 16:31:08', 0),
(438, 10, 1, 'p020', '7017', '2018-10-09 16:31:08', 0),
(439, 10, 1, 'p024', '5284', '2018-10-09 16:31:08', 0),
(440, 10, 1, 'p022', '7676', '2018-10-09 16:31:08', 0),
(441, 10, 1, 'p021', '5151', '2018-10-09 16:31:08', 0),
(442, 10, 1, 'p025', '4969', '2018-10-09 16:31:08', 0),
(443, 10, 1, 'p019', '1631', '2018-10-09 16:31:08', 0),
(444, 10, 1, 'p026', '7835', '2018-10-09 16:31:08', 0),
(445, 10, 1, 'p028', '2010', '2018-10-09 16:31:08', 0),
(446, 10, 1, 'p027', '1285', '2018-10-09 16:31:08', 0),
(447, 10, 1, 'p023', '1884', '2018-10-09 16:31:09', 0),
(448, 10, 1, 'p030', '9044', '2018-10-09 16:31:09', 0),
(449, 10, 1, 'p031', '7856', '2018-10-09 16:31:09', 0),
(450, 10, 1, 'p014', '1383', '2018-10-09 16:31:09', 0),
(451, 10, 1, 'p029', '2766', '2018-10-09 16:31:09', 0),
(452, 10, 1, 'p032', '3848', '2018-10-09 16:31:09', 0),
(453, 10, 1, 'p036', '7284', '2018-10-09 16:31:09', 0),
(454, 10, 1, 'p038', '3747', '2018-10-09 16:31:09', 0),
(455, 10, 1, 'p034', '7399', '2018-10-09 16:31:09', 0),
(456, 10, 1, 'p035', '9959', '2018-10-09 16:31:09', 0),
(457, 10, 1, 'p039', '1129', '2018-10-09 16:31:09', 0),
(458, 10, 1, 'p041', '9928', '2018-10-09 16:31:09', 0),
(459, 10, 1, 'p037', '4155', '2018-10-09 16:31:09', 0),
(460, 10, 1, 'p044', '1275', '2018-10-09 16:31:09', 0),
(461, 10, 1, 'p040', '4123', '2018-10-09 16:31:09', 0),
(462, 10, 1, 'p046', '8315', '2018-10-09 16:31:09', 0),
(463, 10, 1, 'p042', '9489', '2018-10-09 16:31:09', 0),
(464, 10, 1, 'p048', '3575', '2018-10-09 16:31:09', 0),
(465, 10, 1, 'p050', '7339', '2018-10-09 16:31:09', 0),
(466, 10, 1, 'p045', '3130', '2018-10-09 16:31:09', 0),
(467, 10, 1, 'p047', '9895', '2018-10-09 16:31:09', 0),
(468, 10, 1, 'p033', '1034', '2018-10-09 16:31:09', 0),
(469, 10, 1, 'p049', '1614', '2018-10-09 16:31:09', 0),
(470, 10, 1, 'p043', '2150', '2018-10-09 16:31:10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  `user_comunidad` int(1) NOT NULL DEFAULT '0',
  `user_hotspot` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_whatsap` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_comentarios` text COLLATE utf8_unicode_ci,
  `user_porcent` decimal(8,3) DEFAULT '0.000',
  `activado` int(1) DEFAULT '1',
  `prec_hra1` decimal(8,2) DEFAULT '0.00',
  `prec_hra2` decimal(8,2) DEFAULT '0.00',
  `prec_hra3` decimal(8,2) DEFAULT '0.00',
  `prec_hra4` decimal(8,2) DEFAULT '0.00',
  `prec_hra5` decimal(8,2) DEFAULT '0.00',
  `prec_hra6` decimal(8,2) DEFAULT '0.00',
  `print_prec_fichas` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`, `user_comunidad`, `user_hotspot`, `user_facebook`, `user_whatsap`, `user_comentarios`, `user_porcent`, `activado`, `prec_hra1`, `prec_hra2`, `prec_hra3`, `prec_hra4`, `prec_hra5`, `prec_hra6`, `print_prec_fichas`) VALUES
(1, 'Elio', 'Mojica', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'admin@maximcode.com', '2017-07-03 00:00:00', 0, 'hotspot', 'facebookelio', 'whatsap', 'comentarios para Elio', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(2, 'Laura', 'Lopez', 'laura', '$2y$10$EEVyerQ3JP8z8dNSwVXGCu0moxkdCAQOK9R3dse2VZ0A3fAVSVska', 'laura@gmail.com', '2017-07-03 13:12:20', 1, 'H_zuzul', '', '2871758958', 'No existen comentarios aun para Laura', '6.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(3, 'julin', 'Sanchez', 'julin', '$2y$10$iI6zxxP8hpT5cc9KiBEbKe/u40N8g1GKfcM3Ewioz090UeONuxVxm', 'admin@hotmail.com', '2017-08-11 11:00:43', 1, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(4, 'pepa', 'la peludita', 'pepita', '$2y$10$H8HHHXYebpUgow6UWoPRhegTtSDNH7jHmDs9w4xAIRg6imk4qfJQO', 'peludita@hotmail.com', '2017-08-11 13:13:43', 0, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(5, 'pepa2', 'la peludita', 'pepita2', '$2y$10$GXrjbNasfmIN724iBskzQubH3f0LUd20ZjFhK5Ovb.ODZ0e/ncBWi', 'pepa2@hotmail.com', '2017-08-11 13:20:43', 0, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(6, 'pepa3', 'la peludita', 'pepita3', '$2y$10$WMx70DNil0PyWqUMs36faeZZe8.lcQjqH6869acI4T2GJctEnz64G', 'pepa3@hotmail.com', '2017-08-11 13:24:45', 0, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(7, 'pepa4', 'la peludita', 'pepita4', '$2y$10$MWDza2/ibo1Apf4LHdepP.14NVrEMueWDwHrRVDVIXfnNHJqE8key', 'pepa4@hotmail.com', '2017-08-11 13:26:48', 0, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(8, 'pepa5', 'la peludita', 'pepita5', '$2y$10$2zwdlQNQ3TcgBj1YePFCyeRC.rXhPJpWjBz99hug.kQbXtKiiE8/m', 'pepa5@hotmail.com', '2017-08-11 13:53:43', 0, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(9, 'pepa6', 'la peludita', 'pepita6', '$2y$10$mjd7Gt2R9o2JkUfg7rE9/eVDTSnBjfh8qsIfGpHj7cXEJH3uiKxmm', 'pepa6@hotmail.com', '2017-08-11 14:27:41', 2, 'Hospot', '', '000000000', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(10, 'pasin', 'Mojica Pereda', 'pasin', '$2y$10$tOKsQytabbo2.78YoF3KT.SSdxESOkLmil/j248Zk3JdoWT0TSNn2', 'sistprof@hotmail.com', '2017-11-28 14:34:43', 3, 'Hospot-Pasin', 'Facebook-Pasin', 'whatsap-Pasin', 'Ã‘apo Pasin', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0),
(13, 'dsfsdfsdfsdfsd', 'fsfsdfsdf', 'lelo', '$2y$10$3Vn/NaMUQnhHsqqEqr48qeNpHh8oOaT0QQMiqumOOs.F0o3yX0bve', 'lelo@hotmail.com', '2018-01-11 11:24:49', 1, 'Hospot', '', 'whatsap', '', '1.000', 1, '2.00', '4.00', '6.00', '8.00', '10.00', '12.00', 1),
(14, 'fsdfsdfsdf', 'sdfsd', 'sdfds', '$2y$10$qvUypRuiPnzAiqglJ90m5ebPUwUw9P.S4VneDJQd4PtIN6ekztZ4W', 'sssssistprof@hotmail.com', '2018-01-29 13:55:20', 1, 'fsdfsdfd', '', 'dfsdfds', '', '1.000', 1, '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', 0),
(15, 'fsdfsdfsdf11', 'sdfsd22', 'sdfds22', '$2y$10$5C3ONiVrhpXjF9u853zhZePPDnXi879ZKIR/SeOKPZi3jYjflkZJG', 'sssssssistprof@hotmail.com', '2018-01-29 14:01:15', 1, 'fsdfsdfddddddd4', '', 'dfsdfds', '', '1.000', 1, '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', 1),
(16, 'checando', 'cc', 'uu', '$2y$10$j0ZpV.UojTa3QcJZwQ8Vfua1GJsKD4ZwWBu/hWxXNxW.Kb0zlqP4y', 'cc@hotmail.com', '2018-02-01 10:29:40', 1, 'cHospot', 'Facebook-cc', 'whatsap', '', '1.000', 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id_comunidad`),
  ADD UNIQUE KEY `nombre_comunidad` (`nombre_comunidad`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fichas_horas`
--
ALTER TABLE `fichas_horas`
  ADD PRIMARY KEY (`fichas_id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `record_cards`
--
ALTER TABLE `record_cards`
  ADD PRIMARY KEY (`record_card_id`);

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
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id_comunidad` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `fichas_horas`
--
ALTER TABLE `fichas_horas`
  MODIFY `fichas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `record_cards`
--
ALTER TABLE `record_cards`
  MODIFY `record_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
