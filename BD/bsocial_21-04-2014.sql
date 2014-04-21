-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2014 a las 22:28:36
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bsocial_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `id_empresa`, `nombre`, `deleted`) VALUES
(1, 1, 'Novedades', 0),
(2, 1, 'Avisos', 0),
(3, 1, 'Encuestas', 0),
(4, 1, 'Mercadito', 0),
(5, 1, 'Cumpleaños', 0),
(6, 1, 'El mejor', 0),
(7, 1, 'Beneficios', 0),
(8, 1, 'Liquidaciones', 0),
(9, 3, 'Novedades', 0),
(10, 3, 'Cumpleaños', 0),
(11, 3, 'Mercadito', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_publicacion`, `id_usuario`, `texto`, `created`, `deleted`) VALUES
(1, 28, 3, 'plop', '2014-02-21 15:51:08', 0),
(2, 28, 3, 'plop', '2014-02-21 15:51:20', 0),
(3, 26, 3, 'plop', '2014-02-21 16:52:45', 0),
(4, 26, 3, 'plop', '2014-02-21 16:53:58', 0),
(5, 31, 3, 'bgdfaghfdg', '2014-03-11 16:52:35', 0),
(6, 31, 3, 'dfdfbfdb', '2014-03-11 16:52:53', 0),
(7, 38, 3, 'plop\r\n', '2014-03-31 22:45:11', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE IF NOT EXISTS `comunas` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `comuna` varchar(255) DEFAULT NULL,
  `id_region` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id`, `comuna`, `id_region`) VALUES
(346, 'ALTO HOSPICIO', 1),
(296, 'CAMINA', 1),
(297, 'COLCHANE', 1),
(3, 'HUARA', 1),
(2, 'IQUIQUE', 1),
(4, 'PICA', 1),
(5, 'POZO ALMONTE', 1),
(7, 'ANTOFAGASTA', 2),
(10, 'CALAMA', 2),
(298, 'MARIA ELENA', 2),
(8, 'MEJILLONES', 2),
(300, 'OLLAGÜE', 2),
(301, 'SAN PEDRO DE ATACAMA', 2),
(299, 'SIERRA GORDA', 2),
(9, 'TALTAL', 2),
(6, 'TOCOPILLA', 2),
(302, 'ALTO DEL CARMEN', 3),
(14, 'CALDERA', 3),
(11, 'CHAÑARAL', 3),
(13, 'COPIAPO', 3),
(12, 'DIEGO DE ALMAGRO', 3),
(17, 'FREIRINA', 3),
(18, 'HUASCO', 3),
(15, 'TIERRA AMARILLA', 3),
(16, 'VALLENAR', 3),
(22, 'ANDACOLLO', 4),
(31, 'CANELA', 4),
(29, 'COMBARBALA', 4),
(21, 'COQUIMBO', 4),
(30, 'ILLAPEL', 4),
(20, 'LA HIGUERA', 4),
(19, 'LA SERENA', 4),
(33, 'LOS VILOS', 4),
(26, 'MONTE PATRIA', 4),
(25, 'OVALLE', 4),
(24, 'PAIHUANO', 4),
(27, 'PUNITAQUI', 4),
(28, 'RIO HURTADO', 4),
(32, 'SALAMANCA', 4),
(23, 'VICUÑA', 4),
(44, 'ALGARROBO', 5),
(56, 'CABILDO', 5),
(67, 'CALLE LARGA', 5),
(46, 'CARTAGENA', 5),
(40, 'CASABLANCA', 5),
(63, 'CATEMU', 5),
(340, 'CONCON', 5),
(45, 'EL QUISCO', 5),
(47, 'EL TABO', 5),
(51, 'HIJUELAS', 5),
(41, 'ISLA DE PASCUA', 5),
(321, 'JUAN FERNANDEZ', 5),
(50, 'LA CALERA', 5),
(49, 'LA CRUZ', 5),
(59, 'LA LIGUA', 5),
(53, 'LIMACHE', 5),
(65, 'LLAY LLAY', 5),
(66, 'LOS ANDES', 5),
(52, 'NOGALES', 5),
(54, 'OLMUE', 5),
(62, 'PANQUEHUE', 5),
(57, 'PAPUDO', 5),
(55, 'PETORCA', 5),
(36, 'PUCHUNCAVI', 5),
(61, 'PUTAENDO', 5),
(48, 'QUILLOTA', 5),
(38, 'QUILPUE', 5),
(35, 'QUINTERO', 5),
(68, 'RINCONADA', 5),
(42, 'SAN ANTONIO', 5),
(69, 'SAN ESTEBAN', 5),
(60, 'SAN FELIPE', 5),
(64, 'SANTA MARIA', 5),
(43, 'SANTO DOMINGO', 5),
(34, 'VALPARAISO', 5),
(39, 'VILLA ALEMANA', 5),
(37, 'VIÑA DEL MAR', 5),
(58, 'ZAPALLAR', 5),
(132, 'CHEPICA', 6),
(125, 'CHIMBARONGO', 6),
(110, 'CODEGUA', 6),
(114, 'COINCO', 6),
(113, 'COLTAUCO', 6),
(112, 'DOÑIHUE', 6),
(107, 'GRANEROS', 6),
(139, 'LA ESTRELLA', 6),
(116, 'LAS CABRAS', 6),
(136, 'LITUECHE', 6),
(129, 'LOLOL', 6),
(106, 'MACHALI', 6),
(122, 'MALLOA', 6),
(134, 'MARCHIGUE', 6),
(126, 'NANCAGUA', 6),
(138, 'NAVIDAD', 6),
(120, 'OLIVAR', 6),
(130, 'PALMILLA', 6),
(133, 'PAREDONES', 6),
(131, 'PERALILLO', 6),
(115, 'PEUMO', 6),
(118, 'PICHIDEGUA', 6),
(137, 'PICHILEMU', 6),
(127, 'PLACILLA', 6),
(135, 'PUMANQUE', 6),
(123, 'QUINTA DE TILCOCO', 6),
(105, 'RANCAGUA', 6),
(121, 'RENGO', 6),
(119, 'REQUINOA', 6),
(124, 'SAN FERNANDO', 6),
(111, 'SAN FRANCISCO DE MOSTAZAL', 6),
(117, 'SAN VICENTE', 6),
(128, 'SANTA CRUZ', 6),
(166, 'CAUQUENES', 7),
(167, 'CHANCO', 7),
(161, 'COLBUN', 7),
(157, 'CONSTITUCION', 7),
(155, 'CUREPTO', 7),
(140, 'CURICO', 7),
(158, 'EMPEDRADO', 7),
(144, 'HUALAÑE', 7),
(145, 'LICANTEN', 7),
(159, 'LINARES', 7),
(162, 'LONGAVI', 7),
(154, 'MAULE', 7),
(147, 'MOLINA', 7),
(164, 'PARRAL', 7),
(152, 'PELARCO', 7),
(320, 'PELLUHUE', 7),
(153, 'PENCAHUE', 7),
(143, 'RAUCO', 7),
(165, 'RETIRO', 7),
(149, 'RIO CLARO', 7),
(141, 'ROMERAL', 7),
(148, 'SAGRADA FAMILIA', 7),
(151, 'SAN CLEMENTE', 7),
(156, 'SAN JAVIER', 7),
(341, 'SAN RAFAEL', 7),
(150, 'TALCA', 7),
(142, 'TENO', 7),
(146, 'VICHUQUEN', 7),
(163, 'VILLA ALEGRE', 7),
(160, 'YERBAS BUENAS', 7),
(303, 'ANTUCO', 8),
(198, 'ARAUCO', 8),
(180, 'BULNES', 8),
(208, 'CABRERO', 8),
(201, 'CAÑETE', 8),
(344, 'CHIGUAYANTE', 8),
(168, 'CHILLAN', 8),
(342, 'CHILLAN VIEJO', 8),
(175, 'COBQUECURA', 8),
(186, 'COELEMU', 8),
(170, 'COIHUECO', 8),
(188, 'CONCEPCION', 8),
(202, 'CONTULMO', 8),
(194, 'CORONEL', 8),
(197, 'CURANILAHUE', 8),
(185, 'EL CARMEN', 8),
(193, 'FLORIDA', 8),
(192, 'HUALQUI', 8),
(210, 'LAJA', 8),
(199, 'LEBU', 8),
(200, 'LOS ALAMOS', 8),
(204, 'LOS ANGELES', 8),
(195, 'LOTA', 8),
(214, 'MULCHEN', 8),
(212, 'NACIMIENTO', 8),
(213, 'NEGRETE', 8),
(174, 'NINHUE', 8),
(184, 'PEMUCO', 8),
(191, 'PENCO', 8),
(169, 'PINTO', 8),
(171, 'PORTEZUELO', 8),
(215, 'QUILACO', 8),
(206, 'QUILLECO', 8),
(182, 'QUILLON', 8),
(172, 'QUIRIHUE', 8),
(187, 'RANQUIL', 8),
(176, 'SAN CARLOS', 8),
(178, 'SAN FABIAN', 8),
(177, 'SAN GREGORIO DE ÑIQUEN', 8),
(181, 'SAN IGNACIO', 8),
(179, 'SAN NICOLAS', 8),
(343, 'SAN PEDRO DE LA PAZ', 8),
(211, 'SAN ROSENDO', 8),
(205, 'SANTA BARBARA', 8),
(196, 'SANTA JUANA', 8),
(189, 'TALCAHUANO', 8),
(203, 'TIRUA', 8),
(190, 'TOME', 8),
(173, 'TREHUACO', 8),
(209, 'TUCAPEL', 8),
(207, 'YUMBEL', 8),
(183, 'YUNGAY', 8),
(216, 'ANGOL', 9),
(235, 'CARAHUE', 9),
(220, 'COLLIPULLI', 9),
(230, 'CUNCO', 9),
(225, 'CURACAUTIN', 9),
(305, 'CURARREHUE', 9),
(221, 'ERCILLA', 9),
(229, 'FREIRE', 9),
(232, 'GALVARINO', 9),
(238, 'GORBEA', 9),
(231, 'LAUTARO', 9),
(240, 'LONCOCHE', 9),
(226, 'LONQUIMAY', 9),
(218, 'LOS SAUCES', 9),
(223, 'LUMACO', 9),
(304, 'MELIPEUCO', 9),
(234, 'NUEVA IMPERIAL', 9),
(345, 'PADRE LAS CASAS', 9),
(233, 'PERQUENCO', 9),
(237, 'PITRUFQUEN', 9),
(242, 'PUCON', 9),
(236, 'PUERTO SAAVEDRA', 9),
(217, 'PUREN', 9),
(219, 'RENAICO', 9),
(227, 'TEMUCO', 9),
(306, 'TEODORO SCHMIDT', 9),
(239, 'TOLTEN', 9),
(222, 'TRAIGUEN', 9),
(224, 'VICTORIA', 9),
(228, 'VILCUN', 9),
(241, 'VILLARRICA', 9),
(277, 'ANCUD', 10),
(265, 'CALBUCO', 10),
(270, 'CASTRO', 10),
(280, 'CHAITEN', 10),
(271, 'CHONCHI', 10),
(262, 'COCHAMO', 10),
(276, 'CURACO DE VELEZ', 10),
(279, 'DALCAHUE', 10),
(268, 'FRESIA', 10),
(269, 'FRUTILLAR', 10),
(281, 'FUTALEUFU', 10),
(308, 'HUALAIHUE', 10),
(267, 'LLANQUIHUE', 10),
(264, 'LOS MUERMOS', 10),
(263, 'MAULLIN', 10),
(255, 'OSORNO', 10),
(282, 'PALENA', 10),
(261, 'PUERTO MONTT', 10),
(258, 'PUERTO OCTAY', 10),
(266, 'PUERTO VARAS', 10),
(274, 'PUQUELDON', 10),
(260, 'PURRANQUE', 10),
(256, 'PUYEHUE', 10),
(272, 'QUEILEN', 10),
(273, 'QUELLON', 10),
(278, 'QUEMCHI', 10),
(275, 'QUINCHAO', 10),
(259, 'RIO NEGRO', 10),
(307, 'SAN JUAN DE LA COSTA', 10),
(257, 'SAN PABLO', 10),
(285, 'AYSEN', 11),
(287, 'CHILE CHICO', 11),
(286, 'CISNES', 11),
(289, 'COCHRANE', 11),
(284, 'COYHAIQUE', 11),
(309, 'GUAITECAS', 11),
(312, 'LAGO VERDE', 11),
(310, 'O´HIGGINS', 11),
(288, 'RIO IBAÑEZ', 11),
(311, 'TORTEL', 11),
(316, 'LAGUNA BLANCA', 12),
(319, 'NAVARINO', 12),
(292, 'PORVENIR', 12),
(317, 'PRIMAVERA', 12),
(291, 'PUERTO NATALES', 12),
(290, 'PUNTA ARENAS', 12),
(314, 'RIO VERDE', 12),
(315, 'SAN GREGORIO', 12),
(318, 'TIMAUKEL', 12),
(313, 'TORRES DEL PAINE', 12),
(109, 'ALHUE', 13),
(103, 'BUIN', 13),
(99, 'CALERA DE TANGO', 13),
(333, 'CERRILLOS', 13),
(324, 'CERRO NAVIA', 13),
(76, 'COLINA', 13),
(75, 'CONCHALI', 13),
(83, 'CURACAVI', 13),
(338, 'EL BOSQUE', 13),
(89, 'EL MONTE', 13),
(328, 'ESTACION CENTRAL', 13),
(334, 'HUECHURABA', 13),
(330, 'INDEPENDENCIA', 13),
(87, 'ISLA DE MAIPO', 13),
(96, 'LA CISTERNA', 13),
(93, 'LA FLORIDA', 13),
(97, 'LA GRANJA', 13),
(327, 'LA PINTANA', 13),
(92, 'LA REINA', 13),
(78, 'LAMPA', 13),
(71, 'LAS CONDES', 13),
(332, 'LO BARNECHEA', 13),
(337, 'LO ESPEJO', 13),
(325, 'LO PRADO', 13),
(323, 'MACUL', 13),
(94, 'MAIPU', 13),
(90, 'MARIA PINTO', 13),
(88, 'MELIPILLA', 13),
(91, 'ÑUÑOA', 13),
(339, 'PADRE HURTADO', 13),
(104, 'PAINE', 13),
(336, 'PEDRO AGUIRRE CERDA', 13),
(85, 'PEÑAFLOR', 13),
(322, 'PEÑALOLEN', 13),
(101, 'PIRQUE', 13),
(72, 'PROVIDENCIA', 13),
(82, 'PUDAHUEL', 13),
(100, 'PUENTE ALTO', 13),
(79, 'QUILICURA', 13),
(81, 'QUINTA NORMAL', 13),
(329, 'RECOLETA', 13),
(77, 'RENCA', 13),
(98, 'SAN BERNARDO', 13),
(335, 'SAN JOAQUIN', 13),
(102, 'SAN JOSE DE MAIPO', 13),
(95, 'SAN MIGUEL', 13),
(108, 'SAN PEDRO', 13),
(326, 'SAN RAMON', 13),
(70, 'SANTIAGO CENTRO', 13),
(73, 'SANTIAGO OESTE', 13),
(84, 'SANTIAGO SUR', 13),
(86, 'TALAGANTE', 13),
(80, 'TIL-TIL', 13),
(331, 'VITACURA', 13),
(244, 'CORRAL', 14),
(248, 'FUTRONO', 14),
(251, 'LA UNION', 14),
(254, 'LAGO RANCO', 14),
(249, 'LANCO', 14),
(247, 'LOS LAGOS', 14),
(246, 'MAFIL', 14),
(245, 'MARIQUINA', 14),
(243, 'VALDIVIA', 14),
(250, 'PANGUIPULLI', 14),
(252, 'PAILLACO', 14),
(253, 'RIO BUENO', 14),
(1, 'ARICA', 15),
(295, 'CAMARONES', 15),
(293, 'GENERAL LAGOS', 15),
(294, 'PUTRE', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `deleted`) VALUES
(1, 'SUMA', 0),
(2, 'LVS', 0),
(3, 'Default', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `id_empresa`, `nombre`, `deleted`) VALUES
(1, 1, 'grupo 1', 0),
(2, 2, 'grupo 2', 0),
(3, 1, 'grupo 3', 0),
(4, 3, 'default', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuario`
--

CREATE TABLE IF NOT EXISTS `grupo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `grupo_usuario`
--

INSERT INTO `grupo_usuario` (`id`, `id_usuario`, `id_grupo`) VALUES
(1, 3, 1),
(3, 3, 3),
(4, 8, 4),
(5, 12, 4),
(6, 13, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacion` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `id_publicacion`, `id_comentario`, `id_usuario`, `created`, `deleted`) VALUES
(1, 28, 0, 1, '2014-02-24 00:00:00', 0),
(2, 28, 0, 2, '2014-02-24 03:06:02', 0),
(3, 28, 0, 3, '2014-02-24 14:32:07', 1),
(4, 27, 0, 3, '2014-02-24 14:38:38', 1),
(5, 28, 0, 3, '2014-02-24 14:43:45', 1),
(6, 28, 0, 3, '2014-02-24 14:51:59', 1),
(7, 28, 0, 3, '2014-02-26 18:23:42', 1),
(8, 28, 2, 3, '2014-02-26 18:23:48', 1),
(9, 28, 0, 3, '2014-02-26 18:35:40', 1),
(10, 28, 0, 3, '2014-03-06 13:05:20', 0),
(11, 29, 0, 3, '2014-03-07 12:50:02', 0),
(12, 33, 0, 3, '2014-03-11 18:00:29', 1),
(13, 33, 0, 3, '2014-03-11 18:02:14', 1),
(14, 31, 6, 3, '2014-03-11 23:39:00', 0),
(15, 31, 5, 3, '2014-03-11 23:39:01', 0),
(16, 38, 7, 3, '2014-04-02 22:38:37', 1),
(17, 36, 0, 3, '2014-04-02 22:38:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_mensaje` int(11) NOT NULL,
  `para` int(11) DEFAULT NULL,
  `de` int(11) DEFAULT NULL,
  `leido` varchar(180) DEFAULT NULL,
  `fecha` varchar(180) DEFAULT NULL,
  `asunto` varchar(180) DEFAULT NULL,
  `texto` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `id_mensaje`, `para`, `de`, `leido`, `fecha`, `asunto`, `texto`, `created`) VALUES
(1, 0, 3, 4, 'si', '23/05/2011, 10:58 pm', 'Bienvenido al sistema', 'Hola marcofbb, bienvenido a el sistema de mensajería privada', '0000-00-00 00:00:00'),
(2, 0, 4, 3, 'si', '23/05/2011, 11:04 pm', 'Probando', 'Hola como estas?', '0000-00-00 00:00:00'),
(26, 0, 3, 3, NULL, '28/02/2014, 9:50 pm', 'sxc', 'sxc', '0000-00-00 00:00:00'),
(25, 0, 2, 3, NULL, '28/02/2014, 9:46 pm', 'sdc', 'sxz c', '0000-00-00 00:00:00'),
(24, 0, 2, 3, NULL, '28/02/2014, 9:15 pm', 'wdfc', 'sadc', '0000-00-00 00:00:00'),
(35, 1, 4, 4, NULL, '6/03/2014, 3:26 pm', 'Bienvenido al sistema', 'dfbdgf', '2014-03-06 11:26:45'),
(22, 0, 2, 3, NULL, '28/02/2014, 8:55 pm', 'khgvhk', 'ljbjkh', '0000-00-00 00:00:00'),
(18, 0, 3, 3, 'si', '28/02/2014, 2:51 pm', 'dfgv', 'dfvb', '0000-00-00 00:00:00'),
(20, 0, 4, 3, NULL, '28/02/2014, 6:52 pm', 'etg', 'dgfh', '0000-00-00 00:00:00'),
(21, 0, 3, 3, NULL, '28/02/2014, 7:54 pm', 'ftyh', 'treg', '0000-00-00 00:00:00'),
(27, 0, 3, 3, 'si', '28/02/2014, 9:51 pm', 'sxc', 'sxc', '0000-00-00 00:00:00'),
(28, 0, 3, 3, 'si', '5/03/2014, 4:11 pm', 'adnvndlnm', 'ñknmsdncvknsdkcvkdslkmldlnvkdnlvcndsknsdncsdcvnsdnvñksdñwñdñddñcsdk', '2014-03-05 12:11:09'),
(34, 0, 3, 4, NULL, '6/03/2014, 3:22 pm', 'fgdvcd', 'dgxgchv', '2014-03-06 11:22:15'),
(33, 28, 3, 3, NULL, '6/03/2014, 3:18 pm', 'adnvndlnm', 'gdbfvdsaWRHY', '2014-03-06 11:18:46'),
(32, 1, 4, 3, NULL, '6/03/2014, 3:18 pm', 'Bienvenido al sistema', 'ksgdvcjkbsdkb', '2014-03-06 11:18:21'),
(36, 1, 3, 4, NULL, '6/03/2014, 3:28 pm', 'Bienvenido al sistema', 'sfrgreg', '2014-03-06 11:28:45'),
(37, 1, 3, 4, NULL, '6/03/2014, 3:51 pm', 'Bienvenido al sistema', 'adfvfdavf', '2014-03-06 11:51:48'),
(38, 2, 3, 4, NULL, '6/03/2014, 4:11 pm', 'Probando', 'njkhgjhg', '2014-03-06 12:11:51'),
(39, 0, 3, 3, 'si', '7/03/2014, 5:22 pm', 'mhgfy', 'ytdyu', '2014-03-07 13:22:44'),
(40, 0, 2, 3, NULL, '7/03/2014, 7:40 pm', 'fdv', 'asdv', '2014-03-07 15:40:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_usuario`
--

CREATE TABLE IF NOT EXISTS `mensaje_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mensaje` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'Si es emisor o receptor',
  `deleted` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `mensaje_usuario`
--

INSERT INTO `mensaje_usuario` (`id`, `id_mensaje`, `id_usuario`, `rol`, `deleted`, `created`) VALUES
(7, 1, 3, 1, 0, '2014-02-28 12:56:28'),
(8, 1, 4, 2, 0, '2014-02-28 12:56:28'),
(9, 2, 4, 1, 0, '2014-02-28 12:56:28'),
(10, 2, 3, 2, 0, '2014-02-28 12:56:28'),
(11, 18, 3, 1, 0, '2014-02-28 12:56:28'),
(12, 18, 3, 2, 0, '2014-02-28 12:56:28'),
(13, 27, 3, 1, 0, '2014-02-28 17:51:19'),
(14, 27, 3, 2, 0, '2014-02-28 17:51:19'),
(15, 28, 3, 1, 0, '2014-03-05 12:11:09'),
(16, 28, 3, 2, 0, '2014-03-05 12:11:09'),
(17, 34, 3, 1, 0, '2014-03-06 11:22:15'),
(18, 34, 4, 2, 0, '2014-03-06 11:22:15'),
(19, 39, 3, 1, 0, '2014-03-07 13:22:44'),
(20, 39, 3, 2, 0, '2014-03-07 13:22:44'),
(21, 40, 2, 1, 0, '2014-03-07 15:40:25'),
(22, 40, 3, 2, 0, '2014-03-07 15:40:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE IF NOT EXISTS `publicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_etiquetado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `texto` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `id_categoria`, `id_usuario`, `id_usuario_etiquetado`, `id_grupo`, `id_tipo`, `texto`, `created`, `deleted`) VALUES
(1, 1, 1, 0, 1, 1, 'texto de ejemplo', '2014-02-04 01:42:17', 0),
(18, 1, 2, 0, 1, 1, '			test', '2014-02-12 04:05:31', 0),
(17, 1, 1, 0, 1, 1, 'akjsdfhaskdfh', '2014-02-12 04:04:16', 0),
(19, 1, 3, 0, 2, 1, 'plop	', '2014-02-21 01:23:44', 0),
(20, 1, 3, 0, 2, 1, 'plop	', '2014-02-21 01:43:58', 0),
(21, 1, 3, 0, 1, 1, '			plop', '2014-02-21 02:11:31', 0),
(22, 1, 3, 0, 1, 1, '			replop', '2014-02-21 02:46:58', 0),
(23, 1, 3, 0, 1, 1, '		cueck	', '2014-02-21 02:50:10', 0),
(24, 1, 3, 0, 1, 3, '			', '2014-02-21 03:35:52', 0),
(25, 1, 3, 0, 1, 1, '		.jhgfdsasdfghjkml	', '2014-02-21 03:36:03', 0),
(26, 1, 3, 0, 1, 1, 'lkjagdskgkgds', '2014-02-21 03:41:09', 0),
(27, 1, 3, 0, 1, 1, 'lkjagdskgkgds', '2014-02-21 03:42:48', 0),
(28, 1, 3, 0, 1, 1, 'plop', '2014-02-22 00:47:57', 0),
(29, 5, 0, 3, 0, 1, 'Feliz cumpleaños Felix Saucedo, te desea SUMA.', '2014-03-10 16:44:12', 0),
(30, 1, 3, 0, 1, 1, 're plop \r\n', '2014-03-11 15:06:27', 0),
(31, 1, 3, 0, 1, 1, 'rghb', '2014-03-11 15:07:10', 0),
(32, 1, 3, 0, 1, 1, 'jmhngbvdxsaz', '2014-03-11 20:54:04', 0),
(33, 1, 3, 0, 1, 1, 'jmhngbvdxsaz', '2014-03-11 20:54:51', 0),
(34, 1, 3, 0, 3, 1, 'frghbrt', '2014-03-12 03:36:51', 0),
(35, 1, 3, 0, 3, 1, 'plop', '2014-03-25 19:41:58', 0),
(36, 5, 0, 4, 0, 1, 'Feliz cumpleaños Angel Saucedo, te desea SUMA.', '2014-03-25 20:39:28', 0),
(37, 9, 8, 0, 4, 1, 'plop\r\n', '2014-03-27 19:56:21', 0),
(38, 1, 3, 0, 1, 1, 'pepito', '2014-03-31 22:20:03', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE IF NOT EXISTS `regiones` (
  `id` int(11) NOT NULL,
  `region` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `region`) VALUES
(14, 'Región de Los Ríos'),
(13, 'Región Metropolitana'),
(12, 'Región de Magallanes y la Antártica Chilena'),
(11, 'Región de Aysén del General Carlos Ibáñez del Campo'),
(10, 'Región de Los Lagos'),
(9, 'Región de la Araucanía'),
(8, 'Región del Bío-Bío'),
(7, 'Región del Maule'),
(6, 'Región del Libertador General Bernardo O Higgins'),
(5, 'Región de Valparaiso'),
(4, 'Región de Coquimbo'),
(3, 'Región de Atacama'),
(2, 'Región de Antofagasta'),
(1, 'Región de Tarapacá'),
(15, 'Región de Arica y Parinacota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rut` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` char(1) NOT NULL,
  `direccion` varchar(10000) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_empresa`, `username`, `password`, `rut`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `direccion`, `id_comuna`, `descripcion`, `cargo`, `created`, `deleted`) VALUES
(1, 1, 'julio', 'e10adc3949ba59abbe56e057f20f883e', 11111111, 'julio', '', '0000-00-00', 'm', '', 0, '', '', '0000-00-00 00:00:00', 0),
(2, 1, 'felipe', 'e10adc3949ba59abbe56e057f20f883e', 22222222, 'felipe', '', '0000-00-00', 'm', '', 0, '', '', '0000-00-00 00:00:00', 0),
(3, 1, 'felix', '25779f8829ab7a7650e85a4cc871e6ac', 33333333, 'Felix', 'Saucedo', '1991-09-15', 'm', 'La Florida', 93, '', 'Desarrollador', '0000-00-00 00:00:00', 0),
(4, 1, 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', 44444444, 'angel', 'saucedo', '1991-03-25', 'm', 'florida', 93, '', 'nada', '0000-00-00 00:00:00', 0),
(8, 3, 'dsfgds', '64a4e8faed1a1aa0bf8bf0fc84938d25', 55555555, 'sfv', 'dfv', '1930-06-16', 'f', 'fdsv', 65, 'dvf', '0', '0000-00-00 00:00:00', 0),
(12, 3, 'plop', '64a4e8faed1a1aa0bf8bf0fc84938d25', 66666666, 'plop', 'plop', '1918-01-02', 'm', 'sdc', 305, 'cfs', '0', '0000-00-00 00:00:00', 0),
(13, 3, 'plop', '64a4e8faed1a1aa0bf8bf0fc84938d25', 77777777, 'plop', 'plop', '1919-07-03', 'f', 'edvbkhcb', 238, 'wrtjklñ', '0', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
