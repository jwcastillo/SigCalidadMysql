-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-01-2014 a las 13:47:03
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.22

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `db_sigcalidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `absences`
--

CREATE TABLE IF NOT EXISTS `absences` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Colaborador',
  `absence_type_id` int(11) unsigned DEFAULT NULL COMMENT 'ID del Tipo de Ausencia',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción',
  `departure_date` date DEFAULT NULL COMMENT 'Fecha de Salida',
  `arrival_date` date DEFAULT NULL COMMENT 'Fecha de Llegada',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fceha de Modificación',
  PRIMARY KEY (`id`),
  KEY `absence_type_id` (`absence_type_id`),
  KEY `worker_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ID del Tipo de Ausencia' AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `absences`
--

INSERT INTO `absences` (`id`, `employee_id`, `absence_type_id`, `description`, `departure_date`, `arrival_date`, `created`, `modified`) VALUES
(1, 3, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-03-31', '2014-05-05', '2013-12-19 14:02:21', '2014-01-08 08:32:11'),
(4, 19, 2, 'Vacaciones 2012 - 2013', '2013-12-02', '2014-01-09', '2013-12-19 14:03:59', '2014-01-08 08:38:40'),
(5, 1, 2, 'Vacaciones 2012 - 2013 y  Matrimonio', '2013-11-25', '2014-01-07', '2013-12-20 08:11:56', '2013-12-20 08:11:56'),
(6, 5, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-03-05', '2014-03-10', '2013-12-20 08:14:31', '2014-01-08 08:07:16'),
(8, 1, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-04-14', '2014-04-21', '2013-12-20 08:17:13', '2013-12-20 08:20:30'),
(9, 1, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-08-25', '2014-10-01', '2013-12-20 08:20:06', '2013-12-20 08:20:44'),
(10, 15, 2, 'Parte I: Vacaciones 2013-2014', '2014-07-21', '2014-08-04', '2014-01-07 13:22:54', '2014-01-07 13:25:48'),
(11, 15, 2, 'Parte II: Vacaciones 2013-2014', '2014-12-01', '2014-12-15', '2014-01-07 13:25:21', '2014-01-07 13:26:03'),
(12, 16, 2, 'Parte I: Vacaciones 2013-2014', '2014-02-24', '2014-03-10', '2014-01-07 13:31:26', '2014-01-07 13:31:26'),
(13, 16, 2, 'Parte II: Vacaciones 2013-2014', '2014-07-21', '2014-08-04', '2014-01-07 13:35:56', '2014-01-07 13:35:56'),
(14, 16, 2, 'Parte III: Vacaciones 2013-2014', '2014-12-22', '2015-01-19', '2014-01-07 13:38:46', '2014-01-07 13:38:46'),
(15, 4, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-03-17', '2014-03-24', '2014-01-08 06:29:22', '2014-01-08 06:29:22'),
(16, 4, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-01', '2014-12-26', '2014-01-08 06:32:09', '2014-01-08 06:35:55'),
(17, 6, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-06-25', '2014-06-30', '2014-01-08 06:45:36', '2014-01-08 06:45:36'),
(18, 6, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-09-01', '2014-09-22', '2014-01-08 06:47:17', '2014-01-08 06:47:17'),
(19, 7, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-09-15', '2014-09-29', '2014-01-08 06:53:11', '2014-01-08 06:53:11'),
(20, 7, 2, 'Parte II: Vacaciones 2013 - 2014', '2015-01-08', '2015-01-19', '2014-01-08 06:59:48', '2014-01-08 06:59:48'),
(21, 9, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-06-25', '2014-06-30', '2014-01-08 07:06:18', '2014-01-08 07:06:18'),
(22, 9, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-01', '2014-12-09', '2014-01-08 07:07:52', '2014-01-08 07:07:52'),
(23, 10, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-06-03', '2014-06-25', '2014-01-08 07:12:09', '2014-01-08 07:12:09'),
(24, 17, 2, 'Vacaciones 2012 - 2013', '2014-01-29', '2014-02-03', '2014-01-08 07:19:14', '2014-01-08 07:19:14'),
(25, 17, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-06-16', '2014-07-01', '2014-01-08 07:25:21', '2014-01-08 07:25:21'),
(26, 17, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-09', '2014-12-22', '2014-01-08 07:27:59', '2014-01-08 07:27:59'),
(27, 2, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-04-28', '2014-05-12', '2014-01-08 07:36:41', '2014-01-08 07:36:41'),
(28, 2, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-26', '2015-01-09', '2014-01-08 07:39:04', '2014-01-08 07:51:11'),
(29, 20, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-12-22', '2015-01-05', '2014-01-08 08:00:47', '2014-01-08 08:00:47'),
(30, 5, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-04-14', '2014-04-21', '2014-01-08 08:10:14', '2014-01-08 08:10:14'),
(31, 5, 2, 'Parte III: Vacaciones 2013 - 2014', '2014-06-25', '2014-06-30', '2014-01-08 08:11:20', '2014-01-08 08:11:20'),
(32, 12, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-04-21', '2014-05-05', '2014-01-08 08:18:48', '2014-01-08 08:18:48'),
(33, 12, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-08-11', '2014-08-19', '2014-01-08 08:23:25', '2014-01-08 08:23:25'),
(34, 12, 2, 'Parte III: Vacaciones 2013 - 2014', '2015-01-02', '2015-01-06', '2014-01-08 08:25:11', '2014-01-08 08:25:11'),
(35, 11, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-04-07', '2014-04-28', '2014-01-08 08:27:57', '2014-01-08 08:29:33'),
(36, 18, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-06-03', '2014-07-07', '2014-01-08 08:36:45', '2014-01-08 08:36:45'),
(37, 19, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-07-21', '2014-08-19', '2014-01-08 11:12:05', '2014-01-08 11:12:31'),
(38, 19, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-22', '2015-01-02', '2014-01-08 11:19:09', '2014-01-08 11:19:09'),
(39, 13, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-09-08', '2014-09-30', '2014-01-08 11:23:01', '2014-01-08 11:23:01'),
(40, 14, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-09-01', '2014-09-08', '2014-01-08 11:26:02', '2014-01-08 11:26:02'),
(41, 14, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-12-09', '2014-12-26', '2014-01-08 11:28:17', '2014-01-08 11:28:17'),
(42, 8, 2, 'Parte I: Vacaciones 2013 - 2014', '2014-01-31', '2014-02-04', '2014-01-08 11:31:43', '2014-01-08 11:31:43'),
(43, 8, 2, 'Parte II: Vacaciones 2013 - 2014', '2014-02-27', '2014-03-06', '2014-01-08 11:34:35', '2014-01-08 11:34:35'),
(44, 8, 2, 'Parte III: Vacaciones 2013 - 2014', '2014-07-01', '2014-07-21', '2014-01-08 11:37:28', '2014-01-08 11:37:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `absence_types`
--

CREATE TABLE IF NOT EXISTS `absence_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre de Ausencia',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `absence_types`
--

INSERT INTO `absence_types` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Reposo', '2013-12-19 13:27:13', '2013-12-19 13:27:13'),
(2, 'Vacaciones', '2013-12-19 13:32:19', '2013-12-19 13:32:19'),
(3, 'Cursos', '2013-12-19 13:32:34', '2013-12-19 13:32:34'),
(4, 'Matrimonio', '2013-12-19 13:32:49', '2013-12-19 13:32:49'),
(5, 'Maternidad', '2013-12-19 13:32:57', '2013-12-19 13:32:57'),
(6, 'Cumpleaños', '2013-12-19 13:33:11', '2014-01-09 11:48:13'),
(7, 'Diligencia', '2013-12-19 13:33:22', '2013-12-19 13:33:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Nombre del Área de Negocio',
  `management_id` int(10) unsigned DEFAULT NULL COMMENT 'ID de la Gerencia que es Líder del Área de Negocio',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `management_id` (`management_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Áreas de las empresa' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `name`, `management_id`, `created`, `modified`) VALUES
(1, 'Pasivos', 3, NULL, '2014-01-10 22:34:26'),
(2, 'Canales', 4, NULL, NULL),
(3, 'Servicios Internos', 4, NULL, NULL),
(4, 'Activa', 3, NULL, NULL),
(5, 'Filiales', 3, NULL, NULL),
(6, 'Arq/Infra', 4, NULL, NULL),
(7, 'Otros', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complexities`
--

CREATE TABLE IF NOT EXISTS `complexities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT 'Complejidad',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Complejidad del Cambio' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `complexities`
--

INSERT INTO `complexities` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Baja', NULL, NULL),
(2, 'Media', NULL, NULL),
(3, 'Alta', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `development_managers`
--

CREATE TABLE IF NOT EXISTS `development_managers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL COMMENT 'Nombre y Apellido del Jefe del Gerente de Desarrollo',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Gerentes de Desarrollo' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `development_managers`
--

INSERT INTO `development_managers` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Miguel Lara', NULL, '2014-01-10 00:02:32'),
(2, 'Beatriz Mazutiel', NULL, NULL),
(3, 'David Morón', NULL, NULL),
(4, 'Fernando Chavez', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bc` varchar(8) NOT NULL DEFAULT '' COMMENT 'Número de Colaborador',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Nombre del Colaborador',
  `lastname` varchar(100) NOT NULL DEFAULT '' COMMENT 'Apellido del Colaborador',
  `position_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Cargo que Desempeña',
  `ci` varchar(10) NOT NULL DEFAULT '' COMMENT 'Cédula de Identidad',
  `management_id` int(10) unsigned NOT NULL,
  `entry_date` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha de Ingreso al Banco',
  `birthdate` varchar(6) NOT NULL DEFAULT '' COMMENT 'Fecha de Cumpleaños',
  `home_phone` varchar(11) NOT NULL DEFAULT '' COMMENT 'Número de Teléfono',
  `work_phone` varchar(11) NOT NULL DEFAULT '' COMMENT 'Número de Teléfono del Trabajo',
  `cell_phone` varchar(11) NOT NULL DEFAULT '' COMMENT 'Número de Celular',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT 'Dirección de Residencia',
  `type` varchar(100) DEFAULT NULL COMMENT 'Tipo de Empleado',
  `active` char(2) DEFAULT NULL COMMENT 'Activo',
  `company` varchar(100) DEFAULT NULL COMMENT 'Compañia a la que pertenece',
  `email` varchar(255) DEFAULT NULL COMMENT 'Emails',
  `image` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bc` (`bc`),
  UNIQUE KEY `mail` (`email`),
  KEY `position_id` (`position_id`),
  KEY `management_id` (`management_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Personal' AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `bc`, `name`, `lastname`, `position_id`, `ci`, `management_id`, `entry_date`, `birthdate`, `home_phone`, `work_phone`, `cell_phone`, `address`, `type`, `active`, `company`, `email`, `image`, `created`, `modified`) VALUES
(1, 'bc20095', 'Johnmer Rafael', 'Salazar Rangel', 9, 'V-12880871', 1, '2000-01-01', '11-02', '02129540585', '02129545281', '04143280335', 'Av. Principal de El Bosque, Res. El Bosque del Country Club, Torre A, piso 20, apto 203-A', 'Fijo', 'Si', 'Bancaribe', 'johnmer@gmail.com', 'img/upload/workers/Johnmer.jpg', NULL, '2014-01-23 09:59:50'),
(2, 'bc210397', 'Carlos Luis', 'Quijada Alfonzo', 3, 'V-16330539', 3, '2010-11-15', '25-11', '02128588605', '02129545250', '04127147778', 'Calle Real de la Cañada, Urb 23 de enero, bloque 15, piso 6, apto 67', 'Fijo', 'Si', 'Bancaribe', 'cluisquijada@gmail.com', 'img/upload/workers/CarlosQ.jpg', NULL, '2014-01-23 10:00:23'),
(3, 'bc211041', 'Angie Marvinic', 'Uzcategui Rodríguez', 2, 'V-13459237', 2, '2011-02-22', '08-09', '02127159347', '02129546130', '04263188698', 'Colinas de Carrizal, Urbanización Montaña Alta, Edificio 8, Piso 16, Apartamento 6.', 'Fijo', 'Si', 'Bancaribe', 'Auzcategui@bancaribe.com.ve / angie.uzcategui@gmail.com', 'img/upload/workers/Angie.jpg', NULL, NULL),
(4, 'bc211366', 'José Gregorio', 'Valecillos González', 7, 'V-17506219', 4, '2011-09-05', '10-11', '', '02129545115', '04120790579', 'Av. Andrés Bello con Calle Norte 23-2. Res. Danal. Torre B. Piso 21. Apto. 211-B', 'Fijo', 'Si', 'Bancaribe', 'valecillosjg@gmail.com / JValecillos@bancaribe.com.ve', 'img/upload/workers/JoseV.jpg', NULL, NULL),
(5, 'bc211430', 'Javier Ivan', 'Dumont Puerta', 6, 'V-17312330', 3, '2011-10-19', '03-12', '02128389456', '02129545267', '04262171486', 'Calle principal del Lidice, Res. Los Apamates, Bloque 25, apto. 5. La Pastora', 'Fijo', 'Si', 'Bancaribe', 'javierdumont@gmail.com / Jdumont@bancaribe.com.ve', 'img/upload/workers/JavierD.jpg', NULL, NULL),
(6, 'bc211483', 'Javier Eduardo', 'Sandoval Conti', 7, 'V-15758153', 4, '2011-12-13', '27-03', '02129512353', '02129545253', '04122328689', 'Apto. 15B. Edif. Ritz. El Bosque. ', 'Fijo', 'Si', 'Bancaribe', 'javiersandovalc@gmail.com  / JASandoval2@bancaribe.com.ve', 'img/upload/workers/JavierS.jpg', NULL, NULL),
(7, 'bc212173', 'Graciela Antonia', 'Colmenares', 7, 'V-14809474', 4, '2012-05-07', '21-12', '02122350155', '02129545242', '04167275294', 'Av. Sanz, Urb. El Marqués. Res. Bremen. Piso 4 Apto. 2.', 'Fijo', 'Si', '', 'colmenares.g@gmail.com', 'img/upload/workers/Graciela.jpg', NULL, '2014-01-23 10:02:58'),
(8, 'bc212313', 'Darwin Ramón', 'Ramos Flores', 8, 'V-14455667', 4, '2012-08-15', '24-05', '02128147388', '02129546310', '04141833076', 'Sector la Cortada de Catia. Calle Arauca. Casa #3. Catia.', 'Fijo', 'Si', 'Bancaribe', 'ramos.darwin@gmail.com / dramos@bancaribe.com.ve', 'img/upload/workers/Darwin.jpg', NULL, NULL),
(9, 'bc212463', 'Jesús Ramón', 'Urbaez Malave', 7, 'V-14411258', 4, '2012-11-21', '07-05', '02122576613', '02127502626', '04167054612', 'El Llanito, Av. Guaicaipuro con Calle Tiuna. Residencias Doré. Piso 3 apto. 9', 'Fijo', 'Si', 'Bancaribe', 'jesusurbaez@gmail.com / jurbaez@bancaribe.com.ve', 'img/upload/workers/Jesus.jpg', NULL, NULL),
(10, 'bc213067', 'Carlos Jesús', 'Sánchez Otalora', 7, 'V-15958403', 4, '2013-03-14', '03-04', '02124810884', '02129545379', '04142698933', 'El Paraíso. Calle Machado, Qta. 3-1.', 'Fijo', 'Si', 'Bancaribe', 'carlos_jesus_sanchez@yahoo.es / csanchez2@bancaribe.com.ve', '', NULL, NULL),
(11, 'bc213072', 'Guillermo', 'Torres', 6, 'V-16162106', 3, '2013-03-21', '15-11', '02122725663', '02129545729', '04241418018', 'Av. Viena Quinta maybe la Californica Norte', 'Fijo', 'Si', 'Bancaribe', 'guillermousm@gmail.com / gtorres@bancaribe.com.ve', 'img/upload/workers/Guillermo.jpg', NULL, NULL),
(12, 'bc213075', 'Norangel Pastora', 'Escalona Sánchez', 6, 'V-17035366', 3, '2013-03-25', '16-09', '02122644218', '02129545723', '04143658145', 'Av. Francisco de Miranda. Entre Calle Élice y La Joya. Edif. Banco Caracas. Piso 1 Apto. 11.', 'Fijo', 'Si', 'Bancaribe', 'norangelescalona@gmail.com / nescalona@bancaribe.com.ve', 'img/upload/workers/Norangel.jpg', NULL, NULL),
(13, 'bc213078', 'Gilberto José', 'Torrealba Stevenson', 5, 'V-12810100', 2, '2013-04-01', '15-10', '02122579149', '02122575727', '04166152521', 'Av Ppal Paulo VI Edif Altair Piso 14 Apto 7', 'Fijo', 'Si', 'Bancaribe', 'gtorrealba2@bancaribe.com.ve', 'img/upload/workers/Gilberto.jpg', NULL, NULL),
(14, 'bc213316', 'José Wenceslao Antonio', 'Castillo Mendoza', 5, 'V-15227124', 2, '2013-09-30', '16-07', '02416355171', '02129545724', '04264509666', 'Calle 1 El Dorado, Barrio Campo Rico', 'Fijo', 'Si', 'Bancaribe', 'jwcastillo@gmail.com / jcastillo@bancaribe.com.ve', 'img/upload/workers/JoseW.jpg', NULL, NULL),
(15, 'bc22193', 'Kellys Patricia', 'Carbó Mayora', 6, 'V-14312651', 3, '2002-03-11', '25-10', '02123528281', '02129545440', '04120214663', 'Urb. Armando Reveron (Guaracarumbo), bloque 1, Piso1,  apto 0105 Parroquia Urimare. Catia La Mar/ Estado Vargas', 'Fijo', 'Si', 'Bancaribe', 'kcarbo@bancaribe.com.ve', 'img/upload/workers/Kellys.jpg', NULL, '2014-01-07 12:16:13'),
(16, 'bc25470', 'Jean Carlos', 'Bolívar Flores', 4, 'V-13637974', 4, '2005-12-07', '17-04', '02128732931', '02129545282', '04143987916', 'Av. Sucre, al frente del metro de agua salud. Edificio La industrial, Piso 17, Apto - 17C.', 'Fijo', 'Si', 'Bancaribe', 'jeancbf@hotmail.com / jbolivar@bancaribe.com.ve', 'img/upload/workers/Jean.jpg', NULL, NULL),
(17, 'bc26171', 'Maryoli Alejandra', 'Méndez Carmona', 1, 'V-15832933', 3, '2006-06-01', '01-04', '02122425006', '02129546043', '04169120966', 'Terrazas de Guaicoco. Edif. Los Cedros. Piso 6. Apto. 63', 'Fijo', 'Si', 'Bancaribe', 'maryopo@gmail.com', 'img/upload/workers/Maryoli.jpg', NULL, '2014-01-23 10:01:09'),
(18, 'bc28355', 'Silvia Skaidrite', 'Kalnins Salas', 5, 'V-11976382', 2, '2008-03-14', '01-12', '02395166451', '02129545821', '04164044911', 'Conjunto Residencial Matalinda. Sector 3A3, Torre C, apto C-104. Charallave /\r\nUrb. San Carlos. Calle A. casa nro B2. Turmero. Aragua', 'Fijo', 'Si', 'Bancaribe', 'silviakalnins@hotmail.com / kasilvia@bancaribe.com.ve', 'img/upload/workers/Silvia.jpg', NULL, NULL),
(19, 'bc29060', 'Rosanna Isabel', 'Paredes Perdomo', 5, 'V-16247482', 2, '2009-02-16', '09-11', '02129451796', '02129545879', '04142626969', 'Urb. Manzanares Este, calle Loma Redonda, edif. Villa Blu, piso 2, apto 2C', 'Fijo', 'Si', 'Bancaribe', 'rosannaparedes@hotmail.com / rosannaparedes09@cantv.net / rparedes@bancaribe.com.ve', 'img/upload/workers/Rosanna.jpg', NULL, NULL),
(20, 'bc29183', 'Carlos Julio', 'Rodríguez Peña', 6, 'V-16224024', 3, '2009-05-18', '22-06', '02129795350', '02129545655', '04122963603', 'Residencias Monte Pino, Torre 3 Apto 3-B-14. Carretera Los Guayavitos vía el Placer. Baruta', 'Fijo', 'Si', 'Bancaribe', 'navy_ven@hotmail.com / CARodriguez2@bancaribe.com.ve', 'img/upload/workers/CarlosR.jpg', NULL, NULL),
(21, 'bc00000', 'No Asignado', '', NULL, '', 5, '0000-00-00', '01-12', '', '', '', '', NULL, NULL, NULL, NULL, 'img/noImagen.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE IF NOT EXISTS `evaluations` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `effectiveness_evaluation` varchar(10) DEFAULT NULL COMMENT 'Evaluación de Efectividad',
  `quality_assessment` varchar(10) DEFAULT NULL COMMENT 'Evaluación de Calidad',
  `month` char(2) DEFAULT NULL COMMENT 'Mes de Evaluación',
  `year` char(4) DEFAULT NULL COMMENT 'Año de Evaluación',
  `employee_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Especialista o Analista Evaluado',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`Id`),
  KEY `worker_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Evaluación Mensual de Cada Colaborador' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_states`
--

CREATE TABLE IF NOT EXISTS `evaluation_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Estado de la Evaluación',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estados de la evaluación' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `evaluation_states`
--

INSERT INTO `evaluation_states` (`id`, `name`, `created`, `modified`) VALUES
(1, 'No iniciado', NULL, NULL),
(2, 'Revisado por Gerente de Área', NULL, NULL),
(3, 'Revisado por Gerente de Calidad IT', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `final_statuses`
--

CREATE TABLE IF NOT EXISTS `final_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Estatus Final del Paquete',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estado final del paquete' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `final_statuses`
--

INSERT INTO `final_statuses` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Calidad IT - No Satisfactorio', NULL, NULL),
(2, 'Producción - No Satisfactorio', NULL, NULL),
(3, 'Producción - Rollback', NULL, NULL),
(4, 'No Aplica', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'administrators', '2013-12-20 22:18:00', '2013-12-20 22:18:00'),
(2, 'managers', '2013-12-20 22:18:12', '2013-12-20 22:18:53'),
(3, 'users', '2013-12-20 22:19:02', '2013-12-20 22:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`name`,`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `holidays`
--

INSERT INTO `holidays` (`id`, `name`, `date`) VALUES
(2, ' Día de Reyes*', '2014-01-06'),
(8, ' San José*', '2014-03-19'),
(1, 'Año Nuevo', '2014-01-01'),
(26, 'Año Nuevo', '2015-01-01'),
(13, 'Ascensión del Señor* (por el día de la celebración que es el 29 de mayo)', '2014-06-02'),
(19, 'Asunción de Nuestra Señora* (por el día de la celebración que es el 15 de agosto).', '2014-08-18'),
(15, 'Batalla de Carabobo', '2014-06-24'),
(3, 'Carnavales', '2014-03-03'),
(4, 'Carnavales', '2014-03-04'),
(14, 'Corpus Christi* (por el día de la celebración que es el 19 de mayo)', '2014-06-23'),
(11, 'Declaración de la Independencia*', '2014-04-19'),
(17, 'Día de la Independencia', '2014-07-05'),
(22, 'Día de la Inmaculada Concepción', '2014-12-08'),
(20, 'Día de la Resistencia Indígena', '2014-10-12'),
(16, 'Día de San Pedro y San Pablo', '2014-06-29'),
(21, 'Día de Todos los Santos*', '2014-11-01'),
(12, 'Día del Trabajador', '2014-05-01'),
(7, 'Feriado Nacional (según el art. 185 de la LOTTT)', '2013-12-31'),
(25, 'Feriado nacional(según el art. 185 de la LOTTT)\r\n', '2014-12-31'),
(18, 'Natalicio del Libertador', '2014-07-24'),
(6, 'Natividad de Nuestro Señor', '2013-12-25'),
(24, 'Natividad de Nuestro Señor', '2014-12-25'),
(5, 'Navidad (según el art. 185 de la LOTTT)', '2013-12-24'),
(23, 'Navidad (según el art. 185 de la LOTTT)', '2014-12-24'),
(9, 'Semana Santa', '2014-04-17'),
(10, 'Semana Santa', '2014-04-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `managements`
--

CREATE TABLE IF NOT EXISTS `managements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Nombre de la Gerencia',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Gerencias' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `managements`
--

INSERT INTO `managements` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Gerencia de Calidad IT', NULL, NULL),
(2, 'Gerencia de Proyectos de Auditoria de Calidad IT', NULL, NULL),
(3, 'Gerencia de Calidad IT Sistemas Centrales', NULL, NULL),
(4, 'Gerencia de Calidad IT Canales Electrónicos', NULL, NULL),
(5, 'No Asignado', NULL, NULL),
(6, 'VP Adjunto Planificación, Calidad y Servicio', '2014-01-23 09:55:23', '2014-01-23 09:55:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Nombre del Módulo de Harvest',
  `area_id` int(10) unsigned DEFAULT NULL COMMENT 'Id del Área de Negocio',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Modulos' AUTO_INCREMENT=107 ;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id`, `name`, `area_id`, `created`, `modified`) VALUES
(1, 'ACL', 2, '2013-12-10 12:34:29', '2013-12-17 06:53:38'),
(2, 'Adm_Int_Riesgo', 2, '2013-12-10 12:35:40', '2013-12-10 12:35:40'),
(3, 'Archivos_de_Configuracion', 6, '2013-12-13 13:21:55', '2013-12-18 11:50:17'),
(4, 'Assist', 3, '2013-12-13 13:25:59', '2013-12-13 13:25:59'),
(5, 'Atm', 2, '2013-12-13 13:27:19', '2013-12-13 13:27:19'),
(6, 'Atm_Administrador_Fotos', 2, '2013-12-13 13:27:54', '2013-12-13 13:27:54'),
(7, 'Atm_Conciliacion_Integral', 2, '2013-12-13 13:28:30', '2013-12-13 13:28:30'),
(8, 'Atm_Monitor', 2, '2013-12-13 13:28:54', '2013-12-13 13:28:54'),
(9, 'Atm_Server', 2, '2013-12-13 13:29:14', '2013-12-13 13:29:14'),
(10, 'Balanceo', 7, '2013-12-13 13:30:38', '2013-12-17 06:54:07'),
(11, 'Banca_Virtual', 2, '2013-12-13 13:35:39', '2013-12-13 13:35:39'),
(12, 'Bancaribe_Movil', 2, '2013-12-13 13:36:04', '2013-12-13 13:36:04'),
(13, 'Bancaribe_Web', 1, '2013-12-13 13:37:57', '2013-12-13 13:37:57'),
(14, 'Batch', 7, '2013-12-13 13:38:56', '2013-12-13 13:38:56'),
(15, 'BPMS', 4, '2013-12-13 13:39:28', '2013-12-13 13:39:28'),
(16, 'Buro_de_Credito', 4, NULL, NULL),
(17, 'Buzon', 7, NULL, NULL),
(18, 'Camara_y_Remesas', 1, NULL, NULL),
(19, 'Camaras_Regiscope', 1, NULL, NULL),
(20, 'Cartera', 4, NULL, NULL),
(21, 'Cartera_BG', 4, NULL, NULL),
(22, 'Cartera_TDC', 3, '2013-12-16 11:06:16', '2013-12-16 11:06:16'),
(23, 'CashMG', 1, '2013-12-16 11:11:24', '2013-12-16 11:11:24'),
(24, 'Cbc', 1, '2013-12-16 11:11:55', '2013-12-16 11:11:55'),
(25, 'Cezanne', 3, '2013-12-16 11:12:35', '2013-12-16 11:12:35'),
(26, 'Comex', 4, '2013-12-16 11:13:29', '2013-12-16 11:13:29'),
(27, 'Conciliaciones_Bancarias', 1, '2013-12-16 11:14:22', '2013-12-16 11:14:22'),
(28, 'Conexion_Bancaribe_2008', 2, '2013-12-16 11:14:55', '2013-12-16 11:14:55'),
(29, 'Configuracion_TOMCAT6', 6, '2013-12-16 11:16:02', '2013-12-16 11:16:02'),
(30, 'Consolidado_de_Riesgo', 4, '2013-12-16 11:16:45', '2013-12-16 11:16:45'),
(31, 'Conta', 3, '2013-12-16 11:17:24', '2013-12-16 11:17:24'),
(32, 'Control_de_Gestion', 3, '2013-12-16 11:17:55', '2013-12-16 11:17:55'),
(33, 'Control_de_Resoluciones', 3, '2013-12-16 11:18:25', '2013-12-16 11:18:25'),
(34, 'Correspondencia', 3, '2013-12-16 11:18:49', '2013-12-16 11:18:49'),
(35, 'Credito', 4, '2013-12-16 11:19:27', '2013-12-16 11:19:27'),
(36, 'CrossNet', 7, '2013-12-16 11:20:29', '2013-12-16 11:20:29'),
(37, 'Ctacte', 1, '2013-12-16 11:21:13', '2013-12-16 11:21:13'),
(38, 'Ctahorro', 1, '2013-12-16 11:21:44', '2013-12-16 11:21:44'),
(39, 'CTD', 3, '2013-12-16 11:22:15', '2013-12-16 11:22:15'),
(40, 'Curacao', 5, '2013-12-16 11:22:45', '2013-12-16 11:22:45'),
(41, 'Datawarehouse', 3, '2013-12-16 11:35:16', '2013-12-16 11:35:16'),
(42, 'Dep_Chq_Cliente', 4, '2013-12-16 11:38:27', '2013-12-16 11:38:27'),
(43, 'DOTES', 2, '2013-12-16 11:42:03', '2013-12-16 11:42:03'),
(44, 'Dpf', 4, '2013-12-16 11:42:51', '2013-12-16 11:42:51'),
(45, 'E_Learning', 3, '2013-12-16 13:23:23', '2013-12-16 13:23:23'),
(46, 'EDI', 2, '2013-12-16 13:23:56', '2013-12-16 13:23:56'),
(47, 'EdoCta_por_Correo', 2, '2013-12-16 13:25:05', '2013-12-16 13:25:05'),
(48, 'Fideicomiso', 5, '2013-12-16 13:25:39', '2013-12-16 13:25:39'),
(49, 'Filtros', 2, '2013-12-16 13:26:07', '2013-12-16 13:26:07'),
(50, 'Firmas', 3, '2013-12-16 13:26:35', '2013-12-16 13:26:35'),
(51, 'Fondo_Mutual', 3, '2013-12-16 13:27:22', '2013-12-16 13:27:22'),
(52, 'Fraude', 3, '2013-12-16 13:28:04', '2013-12-16 13:28:04'),
(53, 'Garantias', 4, '2013-12-16 13:28:44', '2013-12-16 13:28:44'),
(54, 'GCC_Contable', 7, '2013-12-16 13:29:36', '2013-12-16 13:29:36'),
(55, 'Gestion_de_Identidad', 3, '2013-12-16 13:30:13', '2013-12-16 13:30:13'),
(56, 'Gestion_de_Oficio', 3, '2013-12-16 13:30:48', '2013-12-16 13:30:48'),
(57, 'Gestion_Documental', 3, '2013-12-16 13:31:25', '2013-12-16 13:31:25'),
(58, 'Gestion_Oficinas', 3, '2013-12-16 13:32:50', '2013-12-16 13:32:50'),
(59, 'GP_Adm_Bancaribe', 3, '2013-12-16 13:33:39', '2013-12-16 13:33:39'),
(60, 'HITN', 4, '2013-12-16 13:34:27', '2013-12-16 13:34:27'),
(61, 'IDB', 7, '2013-12-16 13:34:51', '2013-12-16 13:34:51'),
(62, 'Indicadores_de_Gestion', 3, '2013-12-16 13:35:22', '2013-12-16 13:35:22'),
(63, 'Infinix', 1, '2013-12-16 13:35:56', '2013-12-16 13:35:56'),
(64, 'Infinix_WS', 1, '2013-12-16 13:36:50', '2013-12-16 13:36:50'),
(65, 'Inforcuenta', 2, '2013-12-16 13:37:18', '2013-12-16 13:37:18'),
(66, 'Intranet', 3, '2013-12-16 13:37:51', '2013-12-16 13:37:51'),
(67, 'Inv_Libretas', 7, '2013-12-16 13:39:03', '2013-12-16 13:39:03'),
(68, 'IVR', 2, '2013-12-16 13:39:21', '2013-12-16 13:39:21'),
(69, 'IVSS', 1, '2013-12-16 13:40:00', '2013-12-16 13:40:00'),
(70, 'Kioscos', 2, '2013-12-16 13:40:35', '2013-12-16 13:40:35'),
(71, 'LineaAuto_Bancaribe', 3, '2013-12-16 13:41:15', '2013-12-16 13:41:15'),
(72, 'MACB', 3, '2013-12-16 13:41:37', '2013-12-16 13:41:37'),
(73, 'Mis', 3, '2013-12-16 13:42:05', '2013-12-16 13:42:05'),
(74, 'MonExt', 3, '2013-12-16 13:42:49', '2013-12-16 13:42:49'),
(75, 'Monitor_Transaccional', 3, '2013-12-16 13:43:15', '2013-12-16 13:43:15'),
(76, 'Morosos', 4, '2013-12-16 13:43:47', '2013-12-16 13:43:47'),
(77, 'OnBase', 4, '2013-12-16 13:44:15', '2013-12-16 13:44:15'),
(78, 'Pagina_Publica', 2, '2013-12-16 13:45:03', '2013-12-16 13:45:03'),
(79, 'PCP', 7, '2013-12-16 13:46:13', '2013-12-16 13:46:13'),
(80, 'Personalizacion', 1, '2013-12-16 13:46:46', '2013-12-16 13:46:46'),
(81, 'Picasso', 3, '2013-12-16 13:47:15', '2013-12-16 13:47:15'),
(82, 'Platinum', 7, '2013-12-16 13:47:49', '2013-12-16 13:47:49'),
(83, 'PORTAL_ATOGESTION', 3, '2013-12-16 13:48:29', '2013-12-16 13:48:29'),
(84, 'Proveeduria', 3, '2013-12-16 13:49:08', '2013-12-16 13:49:08'),
(85, 'Prowide_LBTR', 3, '2013-12-16 13:49:55', '2013-12-16 13:49:55'),
(86, 'QFG', 3, '2013-12-16 13:50:12', '2013-12-16 13:50:12'),
(87, 'QFLOW', 1, '2013-12-16 13:50:52', '2013-12-16 13:50:52'),
(88, 'Recaudaciones_Generales', 7, '2013-12-16 13:51:43', '2013-12-16 13:51:43'),
(89, 'Reportes_Antifraude', 3, '2013-12-16 13:52:24', '2013-12-16 13:52:24'),
(90, 'Requisiciones_Procura', 3, '2013-12-16 13:53:18', '2013-12-16 13:53:18'),
(91, 'ROCA', 3, '2013-12-16 13:53:32', '2013-12-16 13:53:32'),
(92, 'Sacre', 3, '2013-12-16 13:53:51', '2013-12-16 13:53:51'),
(93, 'SafeWatch', 2, '2013-12-16 13:54:25', '2013-12-16 13:54:25'),
(94, 'Saguimiento', 3, '2013-12-16 13:55:00', '2013-12-16 13:55:00'),
(95, 'Seguridad', 3, '2013-12-16 13:55:48', '2013-12-16 13:55:48'),
(96, 'Service_Desk', 3, '2013-12-16 13:56:10', '2013-12-16 13:56:10'),
(97, 'Servicios_Bancarios', 1, '2013-12-16 13:56:53', '2013-12-16 13:56:53'),
(98, 'Sicri_TDC', 4, '2013-12-16 13:57:20', '2013-12-16 13:57:20'),
(99, 'SIMM', 7, '2013-12-16 13:57:49', '2013-12-16 13:57:49'),
(100, 'SIP_CCE', 1, '2013-12-16 13:58:19', '2013-12-16 13:58:19'),
(101, 'Sistema_Administrativo_Efectivo(SAE)', 1, '2013-12-16 13:59:02', '2013-12-16 14:07:00'),
(102, 'SWIFT', 2, '2013-12-16 13:59:38', '2013-12-16 13:59:38'),
(103, 'Tesoreria', 3, '2013-12-16 14:00:12', '2013-12-16 14:00:12'),
(104, 'UAP', 1, '2013-12-16 14:00:46', '2013-12-16 14:00:46'),
(105, 'Validador_SUDEBAN', 7, '2013-12-16 14:01:20', '2013-12-16 14:01:20'),
(106, 'Z_Proyect', 7, '2013-12-16 14:02:13', '2013-12-16 14:02:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabla de opciones y parámetros del sistema' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `package_classes`
--

CREATE TABLE IF NOT EXISTS `package_classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Clase de Paquete',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tipos de paquetes' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `package_classes`
--

INSERT INTO `package_classes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Requerimiento', NULL, NULL),
(2, 'Requerimiento de Comité', NULL, NULL),
(3, 'Proyecto CON Gerente de Proyecto', NULL, NULL),
(4, 'Proyecto SIN Gerente de Proyecto', NULL, NULL),
(5, 'Por Validar', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `package_statuses`
--

CREATE TABLE IF NOT EXISTS `package_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Estatus del Paquete',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Estatus del Paquete' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `package_statuses`
--

INSERT INTO `package_statuses` (`id`, `name`, `created`, `modified`) VALUES
(1, 'No Iniciado', NULL, NULL),
(2, 'En Preparación de Ambiente', NULL, NULL),
(3, 'En Pruebas Técnicas', NULL, NULL),
(4, 'En Pruebas Funcionales', NULL, NULL),
(5, 'Suspendido', NULL, NULL),
(6, 'Certificado', NULL, NULL),
(7, 'Prelado', NULL, NULL),
(8, 'Eliminado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planning_managers`
--

CREATE TABLE IF NOT EXISTS `planning_managers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre y Apellido del Gerente de Proyecto',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Gerentes de Planificación' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `planning_managers`
--

INSERT INTO `planning_managers` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Ayary Olivares', NULL, NULL),
(2, 'Verónica Carrero', NULL, NULL),
(3, 'Ana Colmenares', NULL, NULL),
(4, 'Rolmer Cuenci', NULL, NULL),
(5, 'José Dubois', NULL, NULL),
(6, 'Jean Gómez', NULL, NULL),
(7, 'No Aplica', '2014-01-23 09:18:19', '2014-01-23 09:18:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Nombre del Cargo',
  `mission` text NOT NULL COMMENT 'Propósito del Cargo',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Cargo desempeñado' AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id`, `name`, `mission`, `created`, `modified`) VALUES
(1, 'Gerente de Calidad IT', 'Planificar, evaluar y controlar las actividades relacionadas con el proceso de pruebas de sistemas nuevos o actualizados a ser implantados en la plataforma tecnológica de Bancaribe y sus filiales, con la finalidad de garantizar la funcionalidad y disponibilidad de los mismos, con la menor cantidad de recursos y tiempo, siguiendo los lineamientos emitidos por la VP de Tecnología. ', NULL, NULL),
(2, 'Gerente de Proyectos de Auditoria de Calidad IT', 'Planificar, dirigir y liderizar las actividades relacionadas al proceso de pruebas (instalación, ejecución de pruebas técnicas, funcionales y de seguridad) de los sistemas de Bancaribe y sus filiales, con la finalidad de cerrar los hallazgos de auditoria y maximizar la disponibilidad y calidad de las aplicaciones que permiten apoyar el cumplimiento de los objetivos de la organización, siguiendo los lineamietos emitidos por la Gerencia de Calidad IT y la VP de Tecnología.  Así como también, supervisar las actividades de monitoreo y administración de los Ambientes de Calidad IT para la gestión de hallazgos de auditorias.', NULL, NULL),
(3, 'Gerente de Calidad IT Sistemas Centrales', 'Planificar, dirigir y liderizar las actividades relacionadas al proceso de pruebas (instalación, ejecución de pruebas técnicas, funcionales y de seguridad) de los sistemas de Bancaribe y sus filiales, con la finalidad de maximizar la disponibilidad y calidad de las aplicaciones que permiten apoyar el cumplimiento de los objetivos de la organización, siguiendo los lineamietos emitidos por la Gerencia de Calidad IT y la VP de Tecnología.', NULL, NULL),
(4, 'Gerente de Calidad IT Canales Electrónicos', 'Planificar, dirigir y liderizar las actividades relacionadas al proceso de pruebas (instalación, ejecución de pruebas técnicas, funcionales y de seguridad) de los sistemas de Bancaribe y sus filiales, con la finalidad de maximizar la disponibilidad y calidad de las aplicaciones que permiten apoyar el cumplimiento de los objetivos de la organización, siguiendo los lineamietos emitidos por la Gerencia de Calidad IT y la VP de Tecnología.', NULL, NULL),
(5, 'Especialista de Calidad IT Auditoria', 'Diseñar, coordinar y ejecutar las pruebas de software y hardware, con la finalidad de cerrar los hallazgos de auditoria presentes en los sistemas del Banco, manteniendo los niveles de calidad necesarios a los productos técnológicos creados por el resto de las áreas que conforman la V.P. de Tecnología, para garantizar la correcta operatividad y continuidad de la institución bancaria y sus empresas filiales, cumpliendo los lineamientos de la VP de Tecnología y la VP de Seguridad Integral y otras áreas relacionadas. ', NULL, NULL),
(6, 'Especialista de Calidad IT Sistemas Centrales', 'Diseñar, coordinar y ejecutar las pruebas de software y hardware, con la finalidad de mantener los niveles de calidad necesarios a los productos técnológicos creados por el resto de las áreas que conforman la V.P. de Tecnología, para garantizar la correcta operatividad y continuidad de la institución bancaria y sus empresas filiales, cumpliendo los lineamientos de la VP de Tecnología y la VP de Seguridad Integral y otras áreas relacionadas. ', NULL, NULL),
(7, 'Especialista de Calidad IT Canales Electrónicos', 'Diseñar, coordinar y ejecutar las pruebas de software y hardware, con la finalidad de mantener los niveles de calidad necesarios a los productos técnológicos creados por el resto de las áreas que conforman la V.P. de Tecnología, para garantizar la correcta operatividad y continuidad de la institución bancaria y sus empresas filiales, cumpliendo los lineamientos de la VP de Tecnología y la VP de Seguridad Integral y otras áreas relacionadas. ', NULL, NULL),
(8, 'Analista de Calidad IT Canales Electrónicos', 'Diseñar, coordinar y ejecutar las pruebas de software y hardware, con la finalidad de mantener los niveles de calidad necesarios a los productos técnológicos creados por el resto de las áreas que conforman la V.P. de Tecnología, para garantizar la correcta operatividad y continuidad de la institución bancaria y sus empresas filiales, cumpliendo los lineamientos de la VP de Tecnología y la VP de Seguridad Integral y otras áreas relacionadas. ', NULL, NULL),
(9, 'VP Adjunto Planificación, Calidad y Servicios IT', 'No esta definido', '2014-01-23 09:58:01', '2014-01-23 09:58:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_classes`
--

CREATE TABLE IF NOT EXISTS `project_classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT 'Clases de Proyectos',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Clases de Proyectos' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `project_classes`
--

INSERT INTO `project_classes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Negocio', NULL, NULL),
(2, 'Mandatorio', NULL, NULL),
(3, 'Tecnológico', NULL, NULL),
(4, 'Auditoria', NULL, NULL),
(5, 'Por Validar', NULL, NULL),
(6, 'Contingencia', '2014-01-23 09:29:33', '2014-01-23 09:29:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_managers`
--

CREATE TABLE IF NOT EXISTS `project_managers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL COMMENT 'Nombre y Apellido del Gerente de Desarrollo',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Gerente de Proyectos' AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `project_managers`
--

INSERT INTO `project_managers` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Freddy Uzcategui', NULL, NULL),
(2, 'Marisol De Lima', NULL, NULL),
(3, 'Tamelvin Angulo', NULL, NULL),
(4, 'Alba Yanes', NULL, NULL),
(5, 'Zulay Torres', NULL, NULL),
(6, 'Carlos Peña', NULL, NULL),
(7, 'Raquel León', NULL, NULL),
(8, 'Yisheng León', NULL, NULL),
(9, 'Gerardo Caldera', NULL, NULL),
(10, 'Oscar Andara', NULL, NULL),
(11, 'Luis Requena', NULL, NULL),
(12, 'Jackson Jimenez', NULL, NULL),
(13, 'Wendy Mora', NULL, NULL),
(14, 'No Aplica', '2014-01-23 09:15:14', '2014-01-23 09:15:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quality_managers`
--

CREATE TABLE IF NOT EXISTS `quality_managers` (
  `employee_id` int(10) unsigned NOT NULL,
  `management_id` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `management_id` (`management_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabla que define los responsables de la gerencia' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respondents`
--

CREATE TABLE IF NOT EXISTS `respondents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Áreas Responsables de un Rollback',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Área Imputada por el RollBack' AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `respondents`
--

INSERT INTO `respondents` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Calidad IT', NULL, NULL),
(2, 'IBM WIN', NULL, NULL),
(3, 'IBM UNIX', NULL, NULL),
(4, 'IBM BD', NULL, NULL),
(5, 'IBM Planificación', NULL, NULL),
(6, 'Planificación IT', NULL, NULL),
(7, 'Producción IT', NULL, NULL),
(8, 'Seguridad Lógica', NULL, NULL),
(9, 'OLTP', NULL, NULL),
(10, 'No Aplica', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unsatisfactory_productions`
--

CREATE TABLE IF NOT EXISTS `unsatisfactory_productions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Razones de No Satisfactorio en Producción',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Insatisfactorio Producción' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `unsatisfactory_productions`
--

INSERT INTO `unsatisfactory_productions` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Falta de Pruebas', NULL, NULL),
(2, 'Problema de Documentación', NULL, NULL),
(3, 'Ventana de Tiempo Excedida', NULL, NULL),
(4, 'Error en Ejecución de Cambio', NULL, NULL),
(5, 'Inclumplimiento de Estándar / Acuerdo', NULL, NULL),
(6, 'Aplicado en Horario Diferente al Planificado', NULL, NULL),
(7, 'RollBack', NULL, NULL),
(8, 'No Aplica', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unsatisfactory_qualities`
--

CREATE TABLE IF NOT EXISTS `unsatisfactory_qualities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Razones de No Satisfactorio por Calidad',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='No satisfactorio calidad' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `unsatisfactory_qualities`
--

INSERT INTO `unsatisfactory_qualities` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Problemas en Documentación', NULL, NULL),
(2, 'Falta Certificación Funcional', NULL, NULL),
(3, 'Falta Certificación Administrador', NULL, NULL),
(4, 'Falta Certificación Seguridad', NULL, NULL),
(5, 'Problema de Paquete de Distribución', NULL, NULL),
(6, 'Versión de Componente Incorrecta', NULL, NULL),
(7, 'Incumplimiento de Acuerdo con Seguridad', NULL, NULL),
(8, 'No Aplica', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(100) NOT NULL COMMENT 'Modelo del Vehiculo',
  `color` varchar(100) NOT NULL DEFAULT '' COMMENT 'Color del Vehículo',
  `plate` varchar(50) NOT NULL COMMENT 'Placa del vehiculo',
  `employee_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Dueño del Vehículo',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `plate` (`plate`),
  KEY `worker_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Vehiculos' AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `model`, `color`, `plate`, `employee_id`, `created`, `modified`) VALUES
(1, 'Optra', 'Azul', 'VCG-41K', 16, NULL, '2014-01-20 20:02:21'),
(2, 'Jeep Cherokee', 'Gris', 'AD589DM', 1, NULL, NULL),
(3, 'Ford Fiesta Move', 'Gris', 'AB765ZK', 15, NULL, '2013-12-20 11:16:48'),
(4, 'Chevrolet Silverado', 'Gris', 'A46AH7K', 18, NULL, NULL),
(5, 'Fiat Palio', 'Verde', 'KBR-47M', 18, NULL, NULL),
(6, 'Chevrolet Aveo', 'Azul', 'AA391BU', 19, NULL, NULL),
(7, 'Mazda 3', 'Azul', 'AB455UA', 17, NULL, NULL),
(8, 'Daewoo Tacuma', 'Azul', 'AEA-39P', 2, NULL, NULL),
(9, 'Volkswagen Fox', 'Gris', 'AFL-03S', 6, NULL, NULL),
(10, 'Montero', 'Beige', 'AA243ND', 10, NULL, NULL),
(11, 'Aveo', 'Beige', 'AC989ES', 13, NULL, NULL),
(12, 'Centauro', 'Gris', 'ACC0SINC', 14, NULL, '2013-12-16 17:01:31');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_employees_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `absences_absence_types_fk` FOREIGN KEY (`absence_type_id`) REFERENCES `absence_types` (`Id`);

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_managements_fk` FOREIGN KEY (`management_id`) REFERENCES `managements` (`id`);

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_managements_fk` FOREIGN KEY (`management_id`) REFERENCES `managements` (`id`),
  ADD CONSTRAINT `employees_positions_fk` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Filtros para la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_employees_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Filtros para la tabla `quality_managers`
--
ALTER TABLE `quality_managers`
  ADD CONSTRAINT `managments_quality_managers_fk` FOREIGN KEY (`management_id`) REFERENCES `managements` (`id`),
  ADD CONSTRAINT `employees_quality_managers_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `cars_employees_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
SET FOREIGN_KEY_CHECKS=1;

-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-01-2014 a las 13:49:18
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.22

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- TABLAS TRANSACCIONALES

--
-- Base de datos: `db_sigcalidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=205 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histories`
--

CREATE TABLE IF NOT EXISTS `histories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `number_package` int(11) DEFAULT NULL,
  `stage_name` varchar(128) DEFAULT NULL,
  `change_date` datetime DEFAULT NULL,
  `bc` varchar(128) DEFAULT NULL,
  `action` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1644 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_package` int(11) DEFAULT NULL COMMENT 'Número de Paquete',
  `module_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Modulo al que pertenece',
  `employee_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Especialista o Análista del Calidad',
  `package_status_id` int(10) unsigned DEFAULT NULL COMMENT 'ID del Estatus del Paquete',
  `rfc_id` int(11) DEFAULT NULL COMMENT 'ID del Proyecto o Requerimiento al que pertenece',
  `entry_date` datetime DEFAULT NULL COMMENT 'Fecha de Entrada',
  `management_entry_date` date DEFAULT NULL COMMENT 'Fecha Entrada Según Gerente de Área',
  `type` varchar(150) DEFAULT NULL COMMENT 'Tipo (Normal o Emergencia)',
  `analyst` varchar(150) DEFAULT NULL COMMENT 'Analista de Desarrollo Según Service Desk',
  `applicant` varchar(150) DEFAULT NULL COMMENT 'Usuario Solicitante',
  `complexity_id` int(10) unsigned DEFAULT NULL COMMENT 'ID de la Complejidad Según Service Desk',
  `project_class_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID de la Clase de Proyecto',
  `package_class_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID de la Clase de Paquete',
  `components` varchar(255) DEFAULT NULL COMMENT 'Tipos de Componentes en el Paquete',
  `components_amount` int(11) DEFAULT NULL COMMENT 'Cantidad de Componentes',
  `start_date` date DEFAULT NULL COMMENT 'Fecha de Inicio',
  `end_date` date DEFAULT NULL COMMENT 'Fecha Fin',
  `replanning_date` date DEFAULT NULL COMMENT 'Fecha Replanificacion',
  `certified_date` datetime DEFAULT NULL COMMENT 'Fecha de Certificación',
  `observations` text COMMENT 'Observaciones',
  `overfulfillment effectiveness` int(3) DEFAULT NULL COMMENT 'Sobrecumplimiento en Efectividad',
  `deviation_effectiveness` int(3) DEFAULT NULL COMMENT 'Desviación de Efectividad',
  `overfulfillment_quality` int(3) DEFAULT NULL COMMENT 'Sobrecumplimiento en Calidad',
  `deviation_quality` int(3) DEFAULT NULL COMMENT 'Desviación en Calidad',
  `weighting` decimal(10,2) DEFAULT NULL COMMENT 'Ponderación',
  `effectiveness_evaluation` int(3) DEFAULT NULL COMMENT 'Evaluación de efectividad',
  `quality_assessment` int(3) DEFAULT NULL COMMENT 'Evaluación de Calidad',
  `replanning` char(1) DEFAULT NULL COMMENT 'Replanificación',
  `replanning_days` int(3) DEFAULT NULL COMMENT 'Días de Replanificación',
  `trial_days` int(4) DEFAULT NULL COMMENT 'Días para Inicio de Atención',
  `certification_days` int(4) DEFAULT NULL COMMENT 'Días de Certificación',
  `ttc` int(3) DEFAULT NULL COMMENT 'Tiempo Total',
  `ttp` int(3) DEFAULT NULL COMMENT 'Tiempo Total Planificado',
  `max_returns` int(3) DEFAULT NULL COMMENT 'Máxima Desviaciones Permitidas',
  `postimplantation` char(1) DEFAULT NULL COMMENT 'Post-Implantación S/N',
  `manager` varchar(50) DEFAULT NULL COMMENT 'Gerente',
  `week_eva_effec` varchar(20) DEFAULT NULL COMMENT 'Semana Evaluación Efectividad',
  `week_eva_qual` varchar(20) DEFAULT NULL COMMENT 'Semana Evaluación Calidad',
  `unsatisfactory_quality_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID de la Causa de No Satisfactorio por Calidad IT',
  `unsatisfactory_production_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID de la Causa de No Satisfactorio en Producción',
  `respondent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID del Área Responsable en Caso de Rollback',
  `evaluation_state_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID del Estado de la Evaluación',
  `current_stage` varchar(255) DEFAULT NULL COMMENT 'Estado del Paquete',
  `final_status_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID del Estatus Final del Paquete',
  `management_id` int(10) unsigned DEFAULT NULL COMMENT 'ID de la Gerencia',
  `packages_postimplantation` int(11) DEFAULT NULL COMMENT 'Número de Paquete de PostImplantación',
  `created` datetime DEFAULT NULL COMMENT 'Fecha de Creación',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha de Modificación',
  PRIMARY KEY (`id`),
  KEY `complexity_id` (`complexity_id`),
  KEY `package_status_id` (`package_status_id`),
  KEY `worker_id` (`employee_id`),
  KEY `module_id` (`module_id`),
  KEY `unsatisfactory_quality_id` (`unsatisfactory_quality_id`),
  KEY `unsatisfactory_production_id` (`unsatisfactory_production_id`),
  KEY `project_class_id` (`project_class_id`),
  KEY `package_class_id` (`package_class_id`),
  KEY `respondent_id` (`respondent_id`),
  KEY `final_status_id` (`final_status_id`),
  KEY `evaluation_state_id` (`evaluation_state_id`),
  KEY `rfc_id` (`rfc_id`),
  KEY `management_id` (`management_id`),
  KEY `date_income` (`entry_date`,`management_entry_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Paquetes' AUTO_INCREMENT=272 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_complexities_fk` FOREIGN KEY (`complexity_id`) REFERENCES `complexities` (`id`),
  ADD CONSTRAINT `packages_employees_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `packages_evaluation_states_fk` FOREIGN KEY (`evaluation_state_id`) REFERENCES `evaluation_states` (`id`),
  ADD CONSTRAINT `packages_final_statuses_fk` FOREIGN KEY (`final_status_id`) REFERENCES `final_statuses` (`id`),
  ADD CONSTRAINT `packages_managements_fk` FOREIGN KEY (`management_id`) REFERENCES `managements` (`id`),
  ADD CONSTRAINT `packages_modules_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `packages_package_classes_fk` FOREIGN KEY (`package_class_id`) REFERENCES `package_classes` (`id`),
  ADD CONSTRAINT `packages_package_statuses_fk` FOREIGN KEY (`package_status_id`) REFERENCES `package_statuses` (`id`),
  ADD CONSTRAINT `packages_project_classess_fk` FOREIGN KEY (`project_class_id`) REFERENCES `project_classes` (`id`),
  ADD CONSTRAINT `packages_respondents_fk` FOREIGN KEY (`respondent_id`) REFERENCES `respondents` (`id`),
  ADD CONSTRAINT `packages_rfcs_fk` FOREIGN KEY (`rfc_id`) REFERENCES `rfcs` (`Id`),
  ADD CONSTRAINT `packages_unsatisfactory_productions_fk` FOREIGN KEY (`unsatisfactory_production_id`) REFERENCES `unsatisfactory_productions` (`id`),
  ADD CONSTRAINT `packages_unsatisfactory_qualities_fk` FOREIGN KEY (`unsatisfactory_quality_id`) REFERENCES `unsatisfactory_qualities` (`id`);
SET FOREIGN_KEY_CHECKS=1;
