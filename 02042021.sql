-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para fileshare
DROP DATABASE IF EXISTS `fileshare`;
CREATE DATABASE IF NOT EXISTS `fileshare` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fileshare`;

-- Volcando estructura para tabla fileshare.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`),
  KEY `file_id` (`file_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`),
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.comment: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `comment`, `user_id`, `file_id`, `comment_id`, `created_at`) VALUES
	(1, 'Listo para aprobar', 2, 44, NULL, '2021-03-31 15:01:05'),
	(2, 'hola', 2, 44, NULL, '2021-03-31 15:05:16'),
	(3, 'hola prueba 2', 2, 44, NULL, '2021-04-01 07:51:52'),
	(4, 'mandar a calidad', 3, 44, NULL, '2021-04-01 11:53:26'),
	(5, 'enviar a sistemas, para rectificar formato', 2, 45, NULL, '2021-04-01 15:10:57'),
	(6, 'Se realizo las correcciones del caso', 3, 45, NULL, '2021-04-01 15:56:28'),
	(7, 'No cumple con los formatos', 2, 48, NULL, '2021-04-01 16:15:32'),
	(8, 'Se subio una nueva version revisar', 3, 48, NULL, '2021-04-01 16:17:16'),
	(9, 'hola', 3, 50, NULL, '2021-04-04 19:51:48'),
	(10, 'calidad', 2, 50, NULL, '2021-04-04 19:52:04'),
	(11, 'hola sistemas corregir', 2, 52, NULL, '2021-04-04 20:12:21'),
	(12, 'hola', 3, 57, NULL, '2021-04-04 20:44:33'),
	(13, 'hola', 3, 58, NULL, '2021-04-04 20:46:06');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.configuration
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_base` varchar(250) NOT NULL,
  `email_admin` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.configuration: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id`, `url_base`, `email_admin`) VALUES
	(1, 'http://localhost:82/doc-iso/', 'sistemas@bateriasecuador.com');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.file
DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `download` int(11) NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_folder` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  `folder_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `code_last` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folder_id` (`folder_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `file_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.file: ~47 rows (aproximadamente)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `code`, `filename`, `description`, `download`, `is_public`, `is_folder`, `is_deleted`, `user_id`, `status`, `folder_id`, `created_at`, `code_last`) VALUES
	(12, 'd6aJQi5i2MZW', 'SISTEMA DE GESTIÃ“N', 'DocumentaciÃ³n vigente ', 0, 1, 1, 0, 2, 1, NULL, '2021-03-30 15:05:39', NULL),
	(13, '7Z3PSRNGMToL', '03. SOPÂ´S', '', 0, 1, 1, 0, 2, 1, 12, '2021-03-30 15:05:53', NULL),
	(14, 'qnt-W5fTEu1q', 'SOP-08 GestiÃ³n de IT', '', 0, 1, 1, 0, 2, 1, 13, '2021-03-30 15:06:54', NULL),
	(15, 'pHewz9_n1IfI', 'FORMATOS', '', 0, 1, 1, 0, 2, 1, 14, '2021-03-30 15:07:10', NULL),
	(16, 'A6dfFxufF_bb', 'SOP-08-FR-02_Registro_de_Incidencias.xls', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:08:00', NULL),
	(17, 'kofk7HabRbal', 'SOP-08-FR-04_Chek_List_Mantenimiento_Rev.4.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:08:14', NULL),
	(18, 'S2GVGgRCNfsW', 'SOP-08-FR-05_Requerimiento_IT.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:08:56', NULL),
	(19, 'EPlTGOOw7LOR', 'SOP-08-FR-06_Solicitud_de_creacion_o_modificacion_de_credenciales.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:09:03', NULL),
	(20, 'viujpMu8has8', 'SOP-08-FR-07_Registro_de_respaldos_de_sistemas_informaticos.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:09:12', NULL),
	(21, 'ZvzU_dbP-Gd9', 'SOP-08-FR-08_Registro_de_Incidencias_IT2.xls', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:09:30', NULL),
	(22, 'ViGV6nkTBFBC', 'SOP-08-FR-09_Seguimiento_de_solicitudes_de_requerimientos_IT.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:10:30', NULL),
	(23, '_8QKgUKw4D78', 'SOP-08-FR-10_Solicitud_de_apertura_de_perifericos_almacenamiento.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:10:47', NULL),
	(24, 'm6gMHnocIik_', 'SOP-08-FR-11_Registro_paz_y_salvo_IT.xlsx', '', 0, 1, 0, 0, 2, 1, 15, '2021-03-30 15:11:00', NULL),
	(25, 'lvoCV3eB9qwl', 'INSTRUCTIVOS', '', 0, 1, 1, 0, 2, 1, 14, '2021-03-30 15:12:57', NULL),
	(26, 'oQqIKRH4Czx-', 'SOP-08-IT-01_Instructivo_de_Mantenimiento.docx', '', 1, 1, 0, 0, 2, 1, 25, '2021-03-30 15:13:12', NULL),
	(27, 'zGqjYkGBidhg', 'SOP-08-IT-02_Instructivo_de_creacion_de_credenciales_informaticas.docx', '', 0, 1, 0, 0, 2, 1, 25, '2021-03-30 15:13:20', NULL),
	(28, 'y6kO6ldEY3VQ', 'SOP-08-IT-03_Instructivo_de_respaldos_informaticos.docx', '', 0, 1, 0, 0, 2, 1, 25, '2021-03-30 15:13:29', NULL),
	(29, 'aQ7x2chTC7Nw', 'SOP-08-IT-04_Instructivo_de_localizacion_de_respaldos_informaticos.docx', '', 0, 1, 0, 0, 2, 1, 25, '2021-03-30 15:25:27', NULL),
	(30, 'NtaQ7_iqNAw5', 'OTROS', '', 0, 1, 1, 0, 2, 1, 14, '2021-03-30 15:28:35', NULL),
	(31, '_DOfRDC_0rVk', 'SOP-08-OTR_Inventario_Equipo_Baterias_Ecuador.xlsx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:28:55', NULL),
	(32, 'pbUNmpr0D35U', 'SOP-08-OTR-08_Licencias_de_Software_Inventario_Documentos_Fabribat.xls', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:29:02', NULL),
	(33, '3jQ7QlaqtJCu', 'SOP-08-OTR-09_Diagrama_de_red.docx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:29:11', NULL),
	(34, 'xn8zpbBsogQ3', 'SOP-08-OTR-10__Cronograma_Mantenimiento_2018.xlsx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:29:19', NULL),
	(35, 'jaKDAqAALZ44', 'SOP-08-OTR-11_Politicas_de_seguridad_de_la_informacion.docx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:29:30', NULL),
	(36, '-AgBIv_o7lB_', 'SOP-08-OTR-12__Listado_de_Repuestos_Criticos.xlsx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:30:59', NULL),
	(37, '5dyc98R-sOLi', 'SOP-08-OTR-12_REGISTRO_SOFTWARE_DE_GESTION.xlsx', '', 0, 1, 0, 0, 2, 1, 30, '2021-03-30 15:31:07', NULL),
	(38, 'y0ma4aETGBCM', 'PLAN', '', 0, 1, 1, 0, 2, 1, 14, '2021-03-30 15:31:47', NULL),
	(39, 'QSk5nYoqCiU0', 'SOP-08-PLAN-01_PLAN_DE_CONTINGENCIA.docx', '', 0, 1, 0, 0, 2, 1, 38, '2021-03-30 15:32:00', NULL),
	(40, 'oiLy0gqv5rA6', 'ARCHIVOS POR CORREGIR', 'Almacenar archivos a ser corregidos por los lideres de proceso', 0, 0, 1, 1, 2, 1, NULL, '2021-03-31 11:50:53', NULL),
	(41, 'o96_3iqTWkoR', '03. SOPÂ´S', 'Directorio  por evaluar', 0, 0, 1, 0, 3, 1, NULL, '2021-03-31 12:42:18', NULL),
	(42, 'ojmQlM0p2OGs', 'SOP-08 GestiÃ³n de IT', '', 0, 0, 1, 0, 3, 1, 41, '2021-03-31 12:42:44', NULL),
	(43, 'DibS7PxhKZEW', 'FORMATOS', '', 0, 0, 1, 0, 3, 1, 42, '2021-03-31 12:43:08', NULL),
	(44, 'Rw_807e5lDyk', 'SOP-08-OTR-12_REGISTRO_SOFTWARE_DE_GESTION.xlsx', 'Nuevo formato por evaluar  y aprobar', 6, 0, 0, 1, 3, 1, 43, '2021-03-31 12:43:50', NULL),
	(45, 'ukUIUeg6VvBV', 'Politicas_de_seguridad_de_la_informacion.pptx', 'para revision', 3, 0, 0, 0, 3, 1, 43, '2021-04-01 13:47:51', NULL),
	(46, 'MzeUMWdx9Rrc', 'Politicas_de_seguridad_de_la_informacion_1.pptx', 'ofi90c\'Â¿ial', 0, 1, 0, 1, 2, 1, 30, '2021-04-01 13:50:12', NULL),
	(47, 'T_xlG1NokzrO', 'Politicas_de_seguridad_de_la_informacion_2.pptx', 'Vigente', 1, 1, 0, 0, 2, 1, 30, '2021-04-01 15:14:02', NULL),
	(48, 'GjsbyPBUORKy', '1002-38-2406-1-10-20201215.pdf', '', 3, 0, 0, 0, 3, 1, 43, '2021-04-01 16:11:53', NULL),
	(49, 'J3tVIBh3GPIa', '1002-38-2406-1-10-20201215_1.pdf', 'versiÃ³n final', 0, 1, 0, 0, 2, 1, 15, '2021-04-01 16:13:42', NULL),
	(50, 'zvrrHw6EzdoP', 'Datos.xlsx', 'prueba 2', 0, 0, 0, 0, 3, 1, 43, '2021-04-04 18:17:47', '9fWaVw8S5vHb'),
	(51, 'Jh0YggwzUxVZ', 'Datos_-_copia.xlsx', 'prueba 4', 1, 0, 0, 0, 3, 0, 43, '2021-04-04 19:42:31', 'fqdiMFZciHwL'),
	(52, 'fqdiMFZciHwL', 'new_documento.xlsx', 'prueba 4', 0, 0, 0, 1, 3, 1, 43, '2021-04-04 19:48:13', 'hudfyAoFrrNg'),
	(53, '6wOPqkfGEJUj', 'Datos_-_copia_1.xlsx', 'prueba 4', 0, 0, 0, 1, 3, 1, 43, '2021-04-04 19:50:57', NULL),
	(54, 'vKpzbnYHMAru', 'Cronograma_de_actividades.xlsx', 'prueba 4', 0, 0, 0, 1, 3, 1, 43, '2021-04-04 20:13:01', NULL),
	(55, 'UxVZjtNfLT83', 'Datos_-_copia_2.xlsx', 'prueba 4', 0, 0, 0, 1, 3, 1, 43, '2021-04-04 20:14:19', NULL),
	(56, 'hudfyAoFrrNg', 'new_documento_1.xlsx', 'prueba 4', 0, 0, 0, 1, 3, 1, 43, '2021-04-04 20:30:57', NULL),
	(57, 'vp0SqoA2SVql', 'prueba2.xlsx', 'prueba 2', 0, 0, 0, 0, 3, 1, 43, '2021-04-04 20:35:25', NULL),
	(58, '9fWaVw8S5vHb', 'new_documento_2.xlsx', 'prueba 2', 0, 0, 0, 0, 3, 1, 43, '2021-04-04 20:41:53', NULL);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.notification
DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.notification: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` (`id`, `from_id`, `to_id`, `file_id`, `kind`, `created_at`, `is_readed`) VALUES
	(14, 3, 2, 45, 1, '2021-04-01 15:08:50', 1),
	(15, 2, 3, 45, 1, '2021-04-01 15:11:05', 1),
	(16, 3, 2, 45, 1, '2021-04-01 15:13:10', 1),
	(17, 3, 2, 45, 1, '2021-04-01 15:56:33', 1),
	(18, 3, 2, 48, 1, '2021-04-01 16:12:14', 1),
	(19, 2, 3, 48, 1, '2021-04-01 16:15:39', 1),
	(20, 3, 2, 48, 1, '2021-04-01 16:17:22', 1),
	(21, 3, 2, 50, 1, '2021-04-04 18:18:19', 1),
	(22, 3, 2, 51, 1, '2021-04-04 19:44:29', 1),
	(23, 3, 2, 52, 1, '2021-04-04 20:11:53', 1),
	(24, 2, 3, 52, 1, '2021-04-04 20:12:30', 1);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.permision
DROP TABLE IF EXISTS `permision`;
CREATE TABLE IF NOT EXISTS `permision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `permision_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`),
  CONSTRAINT `permision_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.permision: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `permision` DISABLE KEYS */;
INSERT INTO `permision` (`id`, `p_id`, `user_id`, `file_id`, `created_at`) VALUES
	(3, 1, 3, 39, '2021-03-31 15:13:57'),
	(4, 1, 2, 43, '2021-04-01 08:04:28'),
	(13, 1, 2, 45, '2021-04-01 15:08:50'),
	(14, 1, 3, 45, '2021-04-01 15:11:05'),
	(15, 1, 2, 45, '2021-04-01 15:13:10'),
	(16, 1, 2, 45, '2021-04-01 15:56:33'),
	(17, 1, 2, 48, '2021-04-01 16:12:14'),
	(18, 1, 3, 48, '2021-04-01 16:15:38'),
	(19, 1, 2, 48, '2021-04-01 16:17:21'),
	(20, 1, 2, 50, '2021-04-04 18:18:19'),
	(21, 1, 2, 51, '2021-04-04 19:44:29'),
	(22, 1, 2, 52, '2021-04-04 20:11:53'),
	(23, 1, 3, 52, '2021-04-04 20:12:30');
/*!40000 ALTER TABLE `permision` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_evaluator` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.user: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `image`, `is_active`, `is_admin`, `is_public`, `is_evaluator`, `created_at`) VALUES
	(1, 'Administrador', 'sistemas@bateriasecuador.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'ecu.jpg', 1, 1, 0, 0, '2017-12-01 09:55:12'),
	(2, 'Calidad', 'enavarrete@bateriasecuador.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'logo.png', 1, 0, 0, 1, '2021-03-17 16:28:56'),
	(3, 'Sistemas', 'soporte@bateriasecuador.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 0, 0, 0, '2021-03-17 16:35:12'),
	(4, 'PUBLICO', 'publico@bateriasecuador.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 1, 1, 0, '2021-03-18 12:58:14');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
