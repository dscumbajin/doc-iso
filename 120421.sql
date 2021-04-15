-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para fileshare
CREATE DATABASE IF NOT EXISTS `fileshare` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fileshare`;

-- Volcando estructura para tabla fileshare.comment
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.comment: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.configuration
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

-- Volcando estructura para tabla fileshare.descargas
CREATE TABLE IF NOT EXISTS `descargas` (
  `id_descarga` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_file` int(11) NOT NULL DEFAULT '0',
  `contador` int(11) NOT NULL DEFAULT '0',
  `download_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_descarga`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fileshare.descargas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `descargas` DISABLE KEYS */;
INSERT INTO `descargas` (`id_descarga`, `id_user`, `id_file`, `contador`, `download_at`) VALUES
	(1, 4, 33, 1, '2021-04-12 08:28:49'),
	(2, 4, 52, 1, '2021-04-12 08:41:41');
/*!40000 ALTER TABLE `descargas` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.file
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
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.file: ~143 rows (aproximadamente)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `code`, `filename`, `description`, `download`, `is_public`, `is_folder`, `is_deleted`, `user_id`, `status`, `folder_id`, `created_at`, `code_last`) VALUES
	(1, 'DwHzA79TRbNf', 'SISTEMA DE GESTIÃ“N', 'Sistema de gestiÃ³n vigente', 0, 1, 1, 0, 2, 1, NULL, '2021-04-12 07:51:03', NULL),
	(2, 'UgoURoMoY7gL', '01. PG\'S', '', 0, 1, 1, 0, 2, 1, 1, '2021-04-12 07:51:37', NULL),
	(3, '-baJJWeYhLs1', 'PG-01 PlanificaciÃ³n', '', 0, 1, 1, 0, 2, 1, 2, '2021-04-12 07:51:59', NULL),
	(4, 'uNYckvprPGLG', 'PG-02 RevisiÃ³n', '', 0, 1, 1, 0, 2, 1, 2, '2021-04-12 07:52:16', NULL),
	(5, 'YHMArudYBj4z', 'ESTRUCTURA POR PROCESO', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:53:43', NULL),
	(6, '5wOqJyKnyHfq', 'FORMATOS', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:54:02', NULL),
	(7, 'E305jV3sNSFp', 'INSTRUCTIVOS', 'PG-01 PlanificaciÃ³n ', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:54:20', NULL),
	(8, 'diMFZciHwLiB', 'MANUAL DE CALIDAD', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:55:08', NULL),
	(9, 'oOOwG64mKogQ', 'MATRIZ DE RIESGOS PRIORIZADOS', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:55:22', NULL),
	(10, '7NJ2mG6YCeg6', 'ORGANIGRAMA GENERAL FABRIBAT', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:55:37', NULL),
	(11, 'pO8F5KC7uaqM', 'PlaneaciÃ³n estratÃ©gica 2018', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:56:05', NULL),
	(12, 'wOPqkfGEJUjP', 'PlaneaciÃ³n estratÃ©gica 2019', 'PG-01 PlanificaciÃ³n ', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:56:24', NULL),
	(13, '7zC2EVNryE4l', 'PROCEDIMIENTOS', 'PG-01 PlanificaciÃ³n', 0, 1, 1, 0, 2, 1, 3, '2021-04-12 07:56:44', NULL),
	(14, 'kjV3RvD-IWf-', 'FORMATOS', 'PG-02 RevisiÃ³n', 0, 1, 1, 0, 2, 1, 4, '2021-04-12 07:58:15', NULL),
	(15, 'mwGmAVk2L-4o', 'Estructura_por_Procesos_2020-1.xlsx', '', 0, 1, 0, 0, 2, 1, 5, '2021-04-12 08:00:15', NULL),
	(16, 'W_2NutNlvodd', 'Nueva carpeta ', 'PG-01 PlanificaciÃ³n/ESTRUCTURA POR PROCESO', 0, 1, 1, 0, 2, 1, 5, '2021-04-12 08:01:25', NULL),
	(17, 'eKi3nSsOaBFb', 'Estructura_por_Procesos.xlsx', '', 0, 1, 0, 0, 2, 1, 16, '2021-04-12 08:03:11', NULL),
	(18, 'jGj-RBH3Oh-S', 'Estructura_por_Procesos_2020.xlsx', '', 0, 1, 0, 0, 2, 1, 16, '2021-04-12 08:03:42', NULL),
	(19, 'B7bqLS1a1f0S', 'Estructura_por_Procesos_1.xlsx', '', 0, 1, 0, 0, 2, 1, 16, '2021-04-12 08:03:53', NULL),
	(20, 'AHjmQKtUUjUJ', 'formato_analisis_Situacional_y_Plan_Estrategico.xlsx', '', 0, 1, 0, 0, 2, 1, 6, '2021-04-12 08:04:49', NULL),
	(21, 'Ybv3qHej1E01', 'PG-01-IT-01_Instructivo_de_priorizacion__de_riesgos.docx', '', 0, 1, 0, 0, 2, 1, 7, '2021-04-12 08:16:30', NULL),
	(22, 'sptQaTcgMnr_', 'MATRIZ_DE_CORRELACION__REQUISITOS_ISO_9001_2015_VS_PROCESOS.xlsx', '', 0, 1, 0, 0, 2, 1, 8, '2021-04-12 08:17:48', NULL),
	(23, 'Nyv-jkQtWPre', 'MC-01_Manual_de_Calidad.docx', '', 0, 1, 0, 0, 2, 1, 8, '2021-04-12 08:18:00', NULL),
	(24, 'Si4TOSY-u0Bo', 'PG-01-OTR-01_Y_02_Matriz_de_priorizacioYn_riesgos.xlsx', '', 0, 1, 0, 0, 2, 1, 9, '2021-04-12 08:20:33', NULL),
	(25, 'x7QY7YcVckI2', 'Nueva carpeta ', 'PG-01 PlanificaciÃ³n/MATRIZ DE RIESGOS PRIORIZADOS', 0, 1, 1, 0, 2, 1, 9, '2021-04-12 08:22:12', NULL),
	(26, 'SrTV0OoCVpYn', 'PG-01-OTR-01_Y_02_Matriz_de_priorizacion_riesgos.xlsx', '', 0, 1, 0, 0, 2, 1, 25, '2021-04-12 08:22:47', NULL),
	(27, 'U9UmJvCEMw9a', 'PG-01-OTR-03_Estructura_Funcional.xlsx', '', 0, 1, 0, 0, 2, 1, 10, '2021-04-12 08:24:57', NULL),
	(28, 'PnOP01hx6DmC', 'AnaYisis_de_riesgos_estrateYgicos_-_Comercial.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:26:37', NULL),
	(29, '1FDxU-48vGMU', 'AnaYlisis_de_Partes_Interesadas_-_Comercial.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:26:46', NULL),
	(30, 'P_hDvces-DHh', 'AnaYlisis_de_Partes_Interesadas_-_Manufactura.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:26:57', NULL),
	(31, '6Py8EE-3hdit', 'Analisis_de_riesgos_Estrategicos_Manufactura.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:27:44', NULL),
	(32, '36IB16qsCnQK', 'Estrategia_y_politica_Fabribat.docx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:27:55', NULL),
	(33, '7W2kKkkdZ9SK', 'Plan_EstrateYgico_-_FABRIBAT.pdf', '', 1, 1, 0, 0, 2, 1, 11, '2021-04-12 08:28:05', NULL),
	(34, 'BGOdP-tCF19y', 'PlaneacioYn_estrateYgica_-_Comercial.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:28:20', NULL),
	(35, '_AtpLZxzN1w-', 'PlaneacioYn_estrateYgica_-_Manufactura.xlsx', '', 0, 1, 0, 0, 2, 1, 11, '2021-04-12 08:28:31', NULL),
	(36, '7vn4e7ZpVl0B', 'AnaYisis_de_riesgos_estrateYgicos_-_Comercial_1.xlsx', '', 0, 1, 0, 0, 2, 1, 12, '2021-04-12 08:31:31', NULL),
	(37, 'xWggJ-lyjLfa', 'AnaYisis_de_riesgos_estrateYgicos-_Manufactura.xlsx', '', 0, 1, 0, 0, 2, 1, 12, '2021-04-12 08:31:42', NULL),
	(38, 'VzWfRxfkMKVP', 'Plan_EstrateYgico_-_FABRIBAT_1.pdf', '', 0, 1, 0, 0, 2, 1, 12, '2021-04-12 08:31:51', NULL),
	(39, '6pf3VQm7GZBp', 'PlaneacioYn_estrateYgica_-_Comercial_1.xlsx', '', 0, 1, 0, 0, 2, 1, 12, '2021-04-12 08:32:01', NULL),
	(40, 'oKGpc9oOpPUy', 'PlaneacioYn_estrateYgica_-_Manufactura_1.xlsx', '', 0, 1, 0, 0, 2, 1, 12, '2021-04-12 08:32:11', NULL),
	(41, 'LCsAEHAuJix_', 'DIagrama_flujo_PLanificacion_estrategica.pdf', '', 0, 1, 0, 0, 2, 1, 13, '2021-04-12 08:34:56', NULL),
	(42, 'l77gF01Auj2s', 'PG-01-PR-01_Procedimiento_planeacion.docx', '', 0, 1, 0, 0, 2, 1, 13, '2021-04-12 08:35:06', NULL),
	(43, '9fQqpoTyrw4Q', 'PG-02-PR-01Procedimiento_de_revision_por_la_DIreccion.docx', '', 0, 1, 0, 0, 2, 1, 4, '2021-04-12 08:37:43', NULL),
	(44, 'LYw8Fs5HNi1m', 'PG-02-PR-02_Procedimiento_Proyectos.docx', '', 0, 1, 0, 0, 2, 1, 4, '2021-04-12 08:37:56', NULL),
	(45, 'jhH_SqNhMnex', 'FR-05_Enunciado_del_Proyecto.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:38:58', NULL),
	(46, 'miMZjarhCh2t', 'FR-06_Valoracion_del_proyecto.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:39:07', NULL),
	(47, 'B90z84KDh7Dr', 'FR-07_Acta_de_constitucion_del_proyecto.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:39:16', NULL),
	(48, 'g-TCa_kKDGb9', 'FR-08_Definicion_del_alcance.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:39:26', NULL),
	(49, 'ZgE3KYQEd5Ea', 'FR-09_Formato_de_matriz_de_requisitos.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:40:08', NULL),
	(50, 'ncPRKYKTIVrS', 'FR-10_Matriz_de_roles_y_responsabilidades.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:40:26', NULL),
	(51, 'Rvkcsz-msye9', 'FR-11_Formulario_de_solicitud_de_cambios.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:40:35', NULL),
	(52, 'HrqAG9MoK791', 'FR-12_Informe_de_avance.doc', '', 1, 1, 0, 0, 2, 1, 14, '2021-04-12 08:40:58', NULL),
	(53, 'WUnRlzwY2pUx', 'FR-13_Aceptacion_del_Entregable.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:41:35', NULL),
	(54, 'o7KiVDmjBR2G', 'FR-14__Informe_de_cierre.doc', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:42:17', NULL),
	(55, 'VAQT5bxkgNTn', 'PG-02-FR-01_Tablero_de_Comando.xlsm', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:44:02', NULL),
	(56, 'mHTrAZRriPuK', 'PG-02-FR-02_Formato_de_planes_de_accion.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:44:18', NULL),
	(57, '2BomTTcF7s-Y', 'PG-02-FR-03_Formato_minuta.docx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:44:48', NULL),
	(58, 'c4Ru4RuqygVS', 'PG-02-FR-04_formato_de_seguimiento_a_compromisos.xlsx', '', 0, 1, 0, 0, 2, 1, 14, '2021-04-12 08:44:57', NULL),
	(59, 'y9-bSoMNERL7', '02. COP\'S', '', 0, 1, 1, 0, 2, 1, 1, '2021-04-12 08:47:29', NULL),
	(60, '4jwwhLzW-940', 'COP-01 ComercializaciÃ³n', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-12 08:48:18', NULL),
	(61, 'APA8Vaetme_i', 'PRESUPUESTOS', '02. COP\'S/COP-01 ComercializaciÃ³n', 0, 1, 1, 0, 2, 1, 60, '2021-04-12 08:49:03', NULL),
	(62, 'Zvgya7BJD2lZ', 'PROCEDIMIENTO', '02. COP\'S/COP-01 ComercializaciÃ³n', 0, 1, 1, 0, 2, 1, 60, '2021-04-12 08:49:25', NULL),
	(63, '0Qj-Wlc_3BMR', 'COP-02 DiseÃ±o y desarrollo', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-12 08:53:11', NULL),
	(64, 'll3EcWOeeJ8p', '1. ESPECIFICACIONES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:56:00', NULL),
	(65, 'PlMk2sO7fRQB', '2. ESPECIFICACIONES TROPICAL', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:56:26', NULL),
	(66, 'WR63fUsnEWun', '3. ESPECIFICACIONES VELKO', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:56:57', NULL),
	(67, 'iVk3msgU-Q8l', '4. ESPECIFICACIONES RUBIX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:57:23', NULL),
	(68, 'TTOZiZRQBUcy', '5. ESPECIFICACIONES TEMPORALES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:57:46', NULL),
	(69, 'w7sRBGpv6Eav', '6. ESPECIFICACIONES Q-PARTS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:58:44', NULL),
	(70, 'w5ldffeqxRlf', '7. ESPECIFICACIONES HELLA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:59:00', NULL),
	(71, 'CkdZvzvrrHw6', '8. ESPECIFICACIONES KOOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:59:31', NULL),
	(72, 'zHDj99zHkZ_1', '9. ESPECIFICACIONES ELEKTRA EC', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 08:59:54', NULL),
	(73, 'EzdoPw6ydp50', '11. ESPECIFICACIONES MOTOREX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:00:22', NULL),
	(74, 'wyBbZPJmfyTJ', '12. ESPECIFICACIONES SUPPLY BATTERY', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:01:03', NULL),
	(75, 'DA4TOgEV2qIr', '13. ESPECIFICACIONES HYDRAULAN', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:01:54', NULL),
	(76, '9EQxSQBHC9vF', '14. ESPECIFICACIONES ACTIVA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:03:46', NULL),
	(77, 'w-U4LK04vCDa', '15. ESPECIFICACIONES BLACK EAGLE', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:04:02', NULL),
	(78, 'zix5qLaWqlmV', '16. ESPECIFICACIONES UNIQUE', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:04:19', NULL),
	(79, 'ioz8eJN6ZJtV', 'AMEF DISEÃ‘O Y PROCESO', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:07:24', NULL),
	(80, 'WMVpEqlmwAC7', 'FORMATOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:07:39', NULL),
	(81, 'N0H_am5ESaEb', 'INSTRUCTIVOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:08:04', NULL),
	(82, '1gDO_uPfq0YZ', 'LECCIONES APRENDIDAS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:08:49', NULL),
	(83, 'jgcOKuj8dWvG', 'OTROS- DIAGRAMAS DE FLUJO', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:09:34', NULL),
	(84, 'UqFwM9vLjOFf', 'PLAN DE CONTROL', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:14:07', NULL),
	(85, 'B0CvvbJwKuIo', 'PROCEDIMIENTOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:14:31', NULL),
	(86, 'hEjuCKJDGoH-', 'REGISTROS DE CAPACITACIONES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo', 0, 1, 1, 0, 2, 1, 63, '2021-04-12 09:15:19', NULL),
	(87, 'qTD1qI5cFacF', '01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 09:25:08', NULL),
	(88, '1FqWs-EiAZy8', '02. ARTES TARJETAS DE GARANTÃAS DE TODOS LOS MODELOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 09:25:52', NULL),
	(89, '7RRI_RdbQL1r', '03. ARTES SELLOS DE GARANTÃA DE TODOS LOS CLIENTES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 09:26:27', NULL),
	(90, 'bPahvkube6sS', '04. ARTES CÃ“DIGOS DE BARRAS DE TODOS LOS MODELOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 16:04:11', NULL),
	(91, 'tE1OcdfYTsof', '05. ARTE ETIQUETA BLANCAS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 16:04:38', NULL),
	(92, 't4zKLEawdDrs', '06. FICHAS TÃ‰CNICAS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 16:05:08', NULL),
	(93, 'gFqWRRqNT7BJ', 'COP-02-ESP-49 IDENTIFICACIÃ“N CAJAS REFERENCIA BODEGA-INGENIERÃA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 16:05:48', NULL),
	(94, 'IIxfDJ2hVyOp', 'PLANOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 16:06:15', NULL),
	(95, 'VF7Rs3mmU8N0', '03. VELKO COLOMBIA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:10:23', NULL),
	(96, 'ReB4F2dbwOJ7', '03.1. VELKO VENEZUELA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:11:25', NULL),
	(97, 'VOyNiG3qbGBB', '04. RUBIX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:11:57', NULL),
	(98, '39D032Gd3e1d', '06. Q-PARTS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:12:27', NULL),
	(99, 'imLcydIn7F-H', '07. HELLA CHILE', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:13:06', NULL),
	(100, 'fe0bTcFt-WrY', '07.1. HELLA NAC', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:14:10', NULL),
	(101, '-ZsQurLRnSLL', '07.2. HELLA EXP', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:14:53', NULL),
	(102, 'AQbo_GVmjAfH', '08. KOOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:15:22', NULL),
	(103, 'qZM1KZExUyJR', '09. ELEKTRA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:22:38', NULL),
	(104, 'g4cZJMgGlbkJ', '11. MOTOREX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:23:10', NULL),
	(105, 'AOtRhwyHYtZW', '12. SUPPLY', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:23:34', NULL),
	(106, 'qdB0D9OpedDs', '13. HYDRAULAN', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTE', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:24:18', NULL),
	(107, 'pdUGbHpUyQdO', 'AYMESA 24 HP', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTE', 0, 1, 1, 0, 2, 1, 87, '2021-04-12 16:25:02', NULL),
	(108, '5kOFEr-EUTb6', 'BE 2019 E3', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-13 13:04:48', NULL),
	(109, '_VWCxdjTUCR1', 'BE 2019 E4', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-13 13:05:48', NULL),
	(110, 'tWwuZwMvBeAC', 'BE 2019 E5', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-13 13:06:17', NULL),
	(111, '7oqVESg321z1', 'BE 2019 TAXI', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES', 0, 1, 1, 0, 2, 1, 87, '2021-04-13 13:06:37', NULL),
	(112, 'K5NxcOlbemp0', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/03. VELKO COLOMBIA', 0, 1, 1, 0, 2, 1, 95, '2021-04-13 13:08:30', NULL),
	(113, 'oJtOL823u9HL', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/03.1. VELKO VENEZUELA', 0, 1, 1, 0, 2, 1, 96, '2021-04-13 13:09:43', NULL),
	(114, 'Zrx_tDghl6Sh', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/07. HELLA CHILE', 0, 1, 1, 0, 2, 1, 99, '2021-04-13 13:11:40', NULL),
	(115, 'MokM4fNU1Rd9', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/07.2. HELLA EXP', 0, 1, 1, 0, 2, 1, 101, '2021-04-13 13:12:47', NULL),
	(116, '_L-kKq7J8jal', 'CÃ“DIGOS DE BARRAS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/08. KOOR', 0, 1, 1, 0, 2, 1, 102, '2021-04-13 13:14:12', NULL),
	(117, 'WOWhtJj_qpN2', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/08. KOOR', 0, 1, 1, 0, 2, 1, 102, '2021-04-13 13:14:53', NULL),
	(118, 'TIV5aJrAgOHF', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES\\01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/09. ELEKTRA', 0, 1, 1, 0, 2, 1, 103, '2021-04-13 13:17:18', NULL),
	(119, 'lesRGqVEgZNv', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/12. SUPPLY', 0, 1, 1, 0, 2, 1, 105, '2021-04-13 13:18:49', NULL),
	(120, 'LO-2MFA9PqIl', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/13. HYDRAULAN', 0, 1, 1, 0, 2, 1, 106, '2021-04-13 13:20:12', NULL),
	(121, '-Vxjsvv8Z3Bh', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/BE 2019 E3', 0, 1, 1, 0, 2, 1, 108, '2021-04-13 13:21:21', NULL),
	(122, 'EpK6i8VbQMAK', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/BE 2019 E4', 0, 1, 1, 0, 2, 1, 109, '2021-04-13 13:23:07', NULL),
	(123, 'oNi1ZGyMo4PM', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/BE 2019 E5', 0, 1, 1, 0, 2, 1, 110, '2021-04-13 13:24:08', NULL),
	(124, 'TH9yb2RdvN4l', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/01. ARTE DE ETIQ. SUP. FRONTAL DE TODOS LOS CLIENTES/BE 2019 TAXI', 0, 1, 1, 0, 2, 1, 111, '2021-04-13 13:25:10', NULL),
	(125, 'R48ISw0TxDdE', 'ILUSTRADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/02. ARTES TARJETAS DE GARANTÃAS DE TODOS LOS MODELOS', 0, 1, 1, 0, 2, 1, 88, '2021-04-13 13:26:39', NULL),
	(126, 'mVT7vnqWRsI3', '06. Q-PARTS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/04. ARTES CÃ“DIGOS DE BARRAS DE TODOS LOS MODELOS', 0, 1, 1, 0, 2, 1, 90, '2021-04-13 13:28:28', NULL),
	(127, 'oLuHAoZNpWSF', '08. KOOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/04. ARTES CÃ“DIGOS DE BARRAS DE TODOS LOS MODELOS', 0, 1, 1, 0, 2, 1, 90, '2021-04-13 13:29:32', NULL),
	(128, 'jtp-hCiBMsLR', '12. SUPPLY', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/04. ARTES CÃ“DIGOS DE BARRAS DE TODOS LOS MODELOS', 0, 1, 1, 0, 2, 1, 90, '2021-04-13 13:30:08', NULL),
	(129, 'MzxfK7ODDyjl', '13. HYDRAULAN', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/04. ARTES CÃ“DIGOS DE BARRAS DE TODOS LOS MODELOS', 0, 1, 1, 0, 2, 1, 90, '2021-04-13 13:30:41', NULL),
	(130, 'TLKPGxu56GaN', '02. TROPICAL', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS', 0, 1, 1, 0, 2, 1, 91, '2021-04-14 16:01:29', NULL),
	(131, '-pG5wqkfhYZo', '07.2. HELLA EXP', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS', 0, 1, 1, 0, 2, 1, 91, '2021-04-14 16:02:44', NULL),
	(132, 'wREO_heOqJ-5', '09. ELEKTRA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS', 0, 1, 1, 0, 2, 1, 91, '2021-04-14 16:03:38', NULL),
	(133, 'jot_0-zmzO8m', 'IMÃGENES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS/09. ELEKTRA', 0, 1, 1, 0, 2, 1, 132, '2021-04-14 16:05:31', NULL),
	(134, 'TALYqJR8kGhl', 'RESPALDO ETIQUETAS OFF', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS/09. ELEKTRA', 0, 1, 1, 0, 2, 1, 132, '2021-04-14 16:06:10', NULL),
	(135, '8tf1HKMyPISV', '11. MOTOREX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/05. ARTE ETIQUETA BLANCAS', 0, 1, 1, 0, 2, 1, 91, '2021-04-14 16:07:00', NULL),
	(136, 'rZfr4A-YybiN', '1. FICHAS TÃ‰CNICAS ECUADOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS', 0, 1, 1, 0, 2, 1, 92, '2021-04-14 16:08:49', NULL),
	(137, 'iC1rVDFFy2AM', 'E3', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/1. FICHAS TÃ‰CNICAS ECUADOR', 0, 1, 1, 0, 2, 1, 136, '2021-04-14 16:09:23', NULL),
	(138, 'tSTPMcDmVhNg', 'E4', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/1. FICHAS TÃ‰CNICAS ECUADOR', 0, 1, 1, 0, 2, 1, 136, '2021-04-14 16:10:06', NULL),
	(139, '6FnvM095xjm_', 'E5', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/1. FICHAS TÃ‰CNICAS ECUADOR', 0, 1, 1, 0, 2, 1, 136, '2021-04-14 16:10:29', NULL),
	(140, 'SJ5T9CC6Axe_', 'TAXI', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/1. FICHAS TÃ‰CNICAS ECUADOR', 0, 1, 1, 0, 2, 1, 136, '2021-04-14 16:11:16', NULL),
	(141, 'KR2nAI_fwgyz', '3. FICHAS TÃ‰CNICAS VELKO', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS', 0, 1, 1, 0, 2, 1, 92, '2021-04-14 16:12:31', NULL),
	(142, 'HJg29knl8APn', '7. FICHAS TÃ‰CNICAS HELLA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS', 0, 1, 1, 0, 2, 1, 92, '2021-04-14 16:13:57', NULL),
	(143, 'MaCSNLjO6YwS', 'HELLA EXP', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/7. FICHAS TÃ‰CNICAS HELLA', 0, 1, 1, 0, 2, 1, 142, '2021-04-14 16:15:20', NULL),
	(144, 'NndW8nBqF0GD', 'HELLA EXP ENG', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/7. FICHAS TÃ‰CNICAS HELLA', 0, 1, 1, 0, 2, 1, 142, '2021-04-14 16:16:46', NULL),
	(145, '7TgiKEu7Md5Y', 'HELLA GC2', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/7. FICHAS TÃ‰CNICAS HELLA', 0, 1, 1, 0, 2, 1, 142, '2021-04-14 16:17:26', NULL),
	(146, 'iOtgABgvKpzb', 'HELLA NAC', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS/7. FICHAS TÃ‰CNICAS HELLA', 0, 1, 1, 0, 2, 1, 142, '2021-04-14 16:18:20', NULL),
	(147, 'eYUF1If9FKb6', '8. FICHAS TÃ‰CNICAS KOOR', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS', 0, 1, 1, 0, 2, 1, 92, '2021-04-14 16:19:45', NULL),
	(148, '9p33hVYwapZa', '12. FICHAS TÃ‰CNICAS SUPPLY BATTERY', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/06. FICHAS TÃ‰CNICAS', 0, 1, 1, 0, 2, 1, 92, '2021-04-14 16:20:15', NULL),
	(149, 'U9UZ4J0lFtsh', 'ACCUMALUX', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/COP-02-ESP-49 IDENTIFICACIÃ“N CAJAS REFERENCIA BODEGA-INGENIERÃA', 0, 1, 1, 0, 2, 1, 93, '2021-04-14 16:23:18', NULL),
	(150, 'sYKi31aGiSvD', 'AKUMSAN', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/COP-02-ESP-49 IDENTIFICACIÃ“N CAJAS REFERENCIA BODEGA-INGENIERÃA', 0, 1, 1, 0, 2, 1, 93, '2021-04-14 16:24:00', NULL),
	(151, 'p8ffkMlc5g7E', 'ETNA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/COP-02-ESP-49 IDENTIFICACIÃ“N CAJAS REFERENCIA BODEGA-INGENIERÃA', 0, 1, 1, 0, 2, 1, 93, '2021-04-14 16:24:29', NULL),
	(152, 'ypIKs2f0gq0l', 'UNIONPLASTICA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES/COP-02-ESP-49 IDENTIFICACIÃ“N CAJAS REFERENCIA BODEGA-INGENIERÃA', 0, 1, 1, 0, 2, 1, 93, '2021-04-14 16:25:05', NULL),
	(153, 'lbDtTomuz0Yg', 'COP-02-IT-13 INSTRUCTIVO DE MANEJO DE CALDERA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/INSTRUCTIVOS', 0, 1, 1, 0, 2, 1, 81, '2021-04-14 16:28:31', NULL),
	(154, 'ELjvJ1nhma9V', 'COP-02-IT-14 INSTRUCTIVO DE MANEJO Y CALIBRACIÃ“N MEZCLADORA', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/INSTRUCTIVOS', 0, 1, 1, 0, 2, 1, 81, '2021-04-14 16:29:51', NULL),
	(155, 'OyNU1eVSzyZg', 'COP-02-IT-15 OXIDADORA BETTER 12 T', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/INSTRUCTIVOS', 0, 1, 1, 0, 2, 1, 81, '2021-04-14 16:30:26', NULL),
	(156, 'qY66a4MyppNc', 'PROCEDIMIENTOS', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/PROCEDIMIENTOS', 0, 1, 1, 0, 2, 1, 85, '2021-04-14 16:33:04', NULL),
	(157, 'PQWFmB0WsLyP', 'COP-03 PlanificaciÃ³n de la ProducciÃ³n', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-14 20:54:36', NULL),
	(158, 'ja_YE-pnHzhJ', 'FORMATOS', '02. COP\'S/COP-03 PlanificaciÃ³n de la ProducciÃ³n', 0, 1, 1, 0, 2, 1, 157, '2021-04-14 20:56:09', NULL),
	(159, 'rRikrnsyDPKb', 'PLAN', '02. COP\'S/COP-03 PlanificaciÃ³n de la ProducciÃ³n', 0, 1, 1, 0, 2, 1, 157, '2021-04-14 20:57:26', NULL),
	(160, '-Kf8fyh5IjQH', 'PROCEDIMIENTO', '02. COP\'S/COP-03 PlanificaciÃ³n de la ProducciÃ³n', 0, 1, 1, 0, 2, 1, 157, '2021-04-14 20:59:08', NULL),
	(161, 'LLqZM1KZExUy', 'COP-04 RealizaciÃ³n del Producto', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-14 20:59:57', NULL),
	(162, 'LxCj3m6y0Ew1', 'FORMATO', '02. COP\'S/COP-04 RealizaciÃ³n del Producto', 0, 1, 1, 0, 2, 1, 161, '2021-04-14 21:01:58', NULL),
	(163, '2CcfzohlZwt-', 'JES.SOS.HIET', '02. COP\'S/COP-04 RealizaciÃ³n del Producto', 0, 1, 1, 0, 2, 1, 161, '2021-04-14 21:02:56', NULL),
	(164, 'D81wyHyMbrnL', 'PLAN', '02. COP\'S/COP-04 RealizaciÃ³n del Producto', 0, 1, 1, 0, 2, 1, 161, '2021-04-14 21:04:32', NULL),
	(165, 'ViidhS3My3H4', 'PROCEDIMIENTO', '02. COP\'S/COP-04 RealizaciÃ³n del Producto', 0, 1, 1, 0, 2, 1, 161, '2021-04-14 21:05:14', NULL),
	(166, 'vUbQ1bbRzS00', 'COP-05 DIstribuciÃ³n y logÃ­stica inversa', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-14 21:06:03', NULL),
	(167, 'L7bwwn9niS9x', 'FORMATOS', '02. COP\'S/COP-05 DistribuciÃ³n y logÃ­stica inversa', 0, 1, 1, 0, 2, 1, 166, '2021-04-14 21:07:06', NULL),
	(168, '7_UkjjID2YfL', 'INSTRUCTIVO', '02. COP\'S/COP-05 DistribuciÃ³n y logÃ­stica inversa', 0, 1, 1, 0, 2, 1, 166, '2021-04-14 21:07:47', NULL),
	(169, '4girHdIGqCii', 'PLAN', '02. COP\'S/COP-05 DistribuciÃ³n y logÃ­stica inversa', 0, 1, 1, 0, 2, 1, 166, '2021-04-14 21:08:44', NULL),
	(170, '4Wq53Y-NtzxR', 'PROCEDIMIENTO', '02. COP\'S/COP-05 DistribuciÃ³n y logÃ­stica inversa', 0, 1, 1, 0, 2, 1, 166, '2021-04-14 21:09:21', NULL),
	(171, 'A_Ly4vVnQ_Z7', 'COP-06 CrÃ©dito y Cobranza', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-14 21:09:59', NULL),
	(172, '9WtZ_gkyWSmm', 'COP-07 Servicio al Cliente', '02. COP\'S', 0, 1, 1, 0, 2, 1, 59, '2021-04-14 21:10:36', NULL),
	(173, 'c56ubDnwA3Mz', 'ANEXOS', '02. COP\'S/ COP-07 Servicio al Cliente', 0, 1, 1, 0, 2, 1, 172, '2021-04-14 21:14:05', NULL),
	(174, 'DBxQdpDOrQNo', 'FORMATOS', '02. COP\'S/ COP-07 Servicio al Cliente', 0, 1, 1, 0, 2, 1, 172, '2021-04-14 21:14:47', NULL),
	(175, 'fy1HKafAca4t', 'INSTRUCTIVOS', '02. COP\'S/ COP-07 Servicio al Cliente', 0, 1, 1, 0, 2, 1, 172, '2021-04-14 21:15:19', NULL),
	(176, 'B-5Hpcv8AU03', '03. SOP\'S', '', 0, 1, 1, 0, 2, 1, 1, '2021-04-14 21:17:28', NULL),
	(177, 'ov-Ch8Q4CST0', 'SOP-01 Adquisiciones y Comercio Exterior', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 21:22:39', NULL),
	(178, '0-MZ3Pu-4bsM', 'BASC', '03. SOP\'S/SOP-01 Adquisiciones y Comercio Exterior', 0, 1, 1, 0, 2, 1, 177, '2021-04-14 21:23:37', NULL),
	(179, '6F7yvL2f9F_T', 'FORMATOS', '03. SOP\'S/SOP-01 Adquisiciones y Comercio Exterior', 0, 1, 1, 0, 2, 1, 177, '2021-04-14 21:24:34', NULL),
	(180, '2sIjKJDhGVFF', 'OTROS', '03. SOP\'S/SOP-01 Adquisiciones y Comercio Exterior', 0, 1, 1, 0, 2, 1, 177, '2021-04-14 21:24:58', NULL),
	(181, 'Q1bN-OnO4Jqh', 'PROCEDIMIENTOS', '03. SOP\'S/SOP-01 Adquisiciones y Comercio Exterior', 0, 1, 1, 0, 2, 1, 177, '2021-04-14 21:25:20', NULL),
	(182, '1060OHZTxxt_', 'SOP-02 Almacenamiento', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 21:26:24', NULL),
	(183, 'QZh-Z-8PwGsK', 'FORMATOS', '03. SOP\'S/SOP-02 Almacenamiento', 0, 1, 1, 0, 2, 1, 182, '2021-04-14 21:27:41', NULL),
	(184, 'SUW3Qi5HIyse', 'INSTRUCTIVOS', '03. SOP\'S/SOP-02 Almacenamiento', 0, 1, 1, 0, 2, 1, 182, '2021-04-14 21:28:49', NULL),
	(185, 'HHlSMaCSNLjO', 'PROCEDIMIENTOS', '03. SOP\'S/SOP-02 Almacenamiento', 0, 1, 1, 0, 2, 1, 182, '2021-04-14 21:29:06', NULL),
	(186, '2N7aICHBiC15', 'SOP-03 Aseguramiento de la calidad', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 21:29:39', NULL),
	(187, 'a3FItwCJjrMm', 'Criterios de aceptaciÃ³n', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:30:48', NULL),
	(188, 'VA0e3j_qOuLw', 'Formatos', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:32:21', NULL),
	(189, 'ONjuiOtgABgv', 'JES', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:32:50', NULL),
	(190, 'KpzbnYHMArud', 'FOTOS', '03. SOP\'S/SOP-03 Aseguramiento de la calidad/JES', 0, 1, 1, 0, 2, 1, 189, '2021-04-14 21:33:40', NULL),
	(191, '-uwHSxlu1ECr', 'Otros', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:35:45', NULL),
	(192, 'tp6VOWTMYPPk', 'Planes', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:38:24', NULL),
	(193, 'Tq1GDWBWwoCI', 'Procedimientos', '03. SOP\'S/SOP-03 Aseguramiento de la calidad', 0, 1, 1, 0, 2, 1, 186, '2021-04-14 21:38:56', NULL),
	(194, 'EG-iPhLzkRTw', 'SOP-04 GestiÃ³n de Herramentales y Calibres', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 21:39:41', NULL),
	(195, 'prq11bucx3Ie', 'CRITERIOS', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres', 0, 1, 1, 0, 2, 1, 194, '2021-04-14 21:40:27', NULL),
	(196, 'iM6G1O2CNYvG', 'FORMATOS', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres', 0, 1, 1, 0, 2, 1, 194, '2021-04-14 21:41:10', NULL),
	(197, '8oJgC2R9xGr_', 'INSTRUCTIVO', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres', 0, 1, 1, 0, 2, 1, 194, '2021-04-14 21:41:34', NULL),
	(198, 'FDkV3fcpE35h', 'PLAN', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres', 0, 1, 1, 0, 2, 1, 194, '2021-04-14 21:42:13', NULL),
	(199, 'OMO_bS264-xE', 'PLANOS HERRAMENTALES', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres', 0, 1, 1, 0, 2, 1, 194, '2021-04-14 21:42:31', NULL),
	(200, 'cYjAmFzBuiNS', 'SOP-04-PL-CA', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:43:28', NULL),
	(201, 'Zm8ACN5sM5LJ', 'SOP-04-PL-EM', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:45:26', NULL),
	(202, 'aqanElOrQoHf', 'SOP-04-PL-EN', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:45:55', NULL),
	(203, 'Jay_LLDZVMC6', 'SOP-04-PL-ET', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:46:52', NULL),
	(204, 'q-gOpVgm8ZIg', 'SOP-04-PL-LA', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:47:19', NULL),
	(205, 'KWkHOUFiFvtL', 'SOP-04-PL-PC', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:47:34', NULL),
	(206, 'jgbcrgOojZ_A', 'SOP-04-PL-PYP', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:47:48', NULL),
	(207, 'kOl8Ty5pyztq', 'SOP-04-PL-REJ', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:48:22', NULL),
	(208, 'Zz2AaLrSOT-K', 'SOP-04-PL-SB', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:48:53', NULL),
	(210, 'SgjlYIAt03iD', 'SOP-04-PL-SG', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:50:32', NULL),
	(211, 'Y_1bbfhECrS9', 'Maquina_A_B_D_E', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG', 0, 1, 1, 0, 2, 1, 210, '2021-04-14 21:51:16', NULL),
	(212, 'Qq95WpQpv_pG', 'Peines', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG/Maquina_A_B_D_E', 0, 1, 1, 0, 2, 1, 211, '2021-04-14 21:52:24', NULL),
	(213, 'iNzCoY1vflAD', 'Platinas', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG/Maquina_A_B_D_E', 0, 1, 1, 0, 2, 1, 211, '2021-04-14 21:52:58', NULL),
	(214, 'EPEPYaVjvp59', 'Maquina_C_F', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG', 0, 1, 1, 0, 2, 1, 210, '2021-04-14 21:53:53', NULL),
	(215, 'VgnHgWL3--yy', 'Peines', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG/Maquina_C_F', 0, 1, 1, 0, 2, 1, 214, '2021-04-14 21:54:57', NULL),
	(216, 'hnG6lj2LmDQs', 'Platinas_Sueldas', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-SG/Maquina_C_F', 0, 1, 1, 0, 2, 1, 214, '2021-04-14 21:55:30', NULL),
	(217, 'bFuLeFsl5Lrz', 'SOP-04-PL-ST', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES', 0, 1, 1, 0, 2, 1, 199, '2021-04-14 21:56:46', NULL),
	(218, 'izLZDki9Jtd6', '1. NS40', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:01:32', NULL),
	(219, 'aJQi5i2MZW7Z', '2. N40 y 36', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:02:11', NULL),
	(220, '0ejgoNUhbbeG', '3. 42 y 55', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:02:31', NULL),
	(221, '3PSRNGMToLA5', '4. 65 y 66', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:02:59', NULL),
	(222, 'jYYA04pS053z', '5. 24 y 34', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:03:53', NULL),
	(223, 'Z5x33bz_-tps', '6. 27', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:05:05', NULL),
	(224, 'T9wSyskWwNVN', '7. 49', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:05:26', NULL),
	(225, 'eSFHzTq74rhj', '8. 30H', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:05:56', NULL),
	(226, 'bK4GURna9Izz', '9. N100 y F65', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:06:28', NULL),
	(227, '_BoFeQkga2RP', '10. 4DLT y N150', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:06:49', NULL),
	(228, 'kr1m7m3k5720', '11. N120', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:07:07', NULL),
	(229, '6wvttbEA053a', '12. N200', '03. SOP\'S/SOP-04 GestiÃ³n de Herramentales y Calibres/PLANOS HERRAMENTALES/SOP-04-PL-ST', 0, 1, 1, 0, 2, 1, 217, '2021-04-14 22:07:49', NULL),
	(230, 'lxIs3GjasTVw', 'SOP-05 GestiÃ³n de Mantenimiento', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 22:08:36', NULL),
	(231, 'Y65zJy5JvQQw', 'FORMATOS', '03. SOP\'S/SOP-05 GestiÃ³n de Mantenimiento', 0, 1, 1, 0, 2, 1, 230, '2021-04-14 22:09:15', NULL),
	(232, 'HLnQ5dzOojmQ', 'INSTRUCTIVOS', '03. SOP\'S/SOP-05 GestiÃ³n de Mantenimiento', 0, 1, 1, 0, 2, 1, 230, '2021-04-14 22:09:55', NULL),
	(233, '3vkic7hzMaeM', 'OTROS', '03. SOP\'S/SOP-05 GestiÃ³n de Mantenimiento', 0, 1, 1, 0, 2, 1, 230, '2021-04-14 22:10:10', NULL),
	(234, 'juvoVgZnbdYd', 'PLAN', '03. SOP\'S/SOP-05 GestiÃ³n de Mantenimiento', 0, 1, 1, 0, 2, 1, 230, '2021-04-14 22:10:37', NULL),
	(235, 'lM0p2OGsW0ou', 'PROCEDIMIENTO', '03. SOP\'S/SOP-05 GestiÃ³n de Mantenimiento', 0, 1, 1, 0, 2, 1, 230, '2021-04-14 22:10:51', NULL),
	(236, 'dyiRB1mMqLZW', 'SOP-06 GestiÃ³n de RRHH', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 22:11:35', NULL),
	(237, 'hztPgDIo1H50', 'FORMATOS', '03. SOP\'S/SOP-06 GestiÃ³n de RRHH', 0, 1, 1, 0, 2, 1, 236, '2021-04-14 22:12:24', NULL),
	(238, 'p5k93CAKKrA6', 'ORGANIGRAMAS', '03. SOP\'S/SOP-06 GestiÃ³n de RRHH', 0, 1, 1, 0, 2, 1, 236, '2021-04-14 22:12:56', NULL),
	(239, 'vYiZs_QpUstp', 'PROCEDIMIENTO', '03. SOP\'S/SOP-06 GestiÃ³n de RRHH', 0, 1, 1, 0, 2, 1, 236, '2021-04-14 22:13:11', NULL),
	(240, 'dfFxufF_bbYk', 'SOP-07 GestiÃ³n de SISO', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 22:14:13', NULL),
	(241, 'gI59UF7sLeS5', 'FORMATOS', '03. SOP\'S/SOP-07 GestiÃ³n de SISO', 0, 1, 1, 0, 2, 1, 240, '2021-04-14 22:14:42', NULL),
	(242, '1sJV5Y_1AT4M', 'INSTRUCTIVOS', '03. SOP\'S/SOP-07 GestiÃ³n de SISO', 0, 1, 1, 0, 2, 1, 240, '2021-04-14 22:15:06', NULL),
	(243, 'YJtw3q8W8tZe', 'OTROS', '03. SOP\'S/SOP-07 GestiÃ³n de SISO', 0, 1, 1, 0, 2, 1, 240, '2021-04-14 22:15:19', NULL),
	(244, 'O5-dua0POcwc', 'PROCEDIMIENTO', '03. SOP\'S/SOP-07 GestiÃ³n de SISO', 0, 1, 1, 0, 2, 1, 240, '2021-04-14 22:15:41', NULL),
	(245, '4QG_a1lSnRy-', 'FLUJOS', '03. SOP\'S/SOP-07 GestiÃ³n de SISO/PROCEDIMIENTO', 0, 1, 1, 0, 2, 1, 244, '2021-04-14 22:16:16', NULL),
	(246, 'dfybGUY_GeVT', 'PROCEDIMIENTOS', '03. SOP\'S/SOP-07 GestiÃ³n de SISO/PROCEDIMIENTO', 0, 1, 1, 0, 2, 1, 244, '2021-04-14 22:16:35', NULL),
	(247, '1ZncPfrJecOY', 'SOP-08 GestiÃ³n de IT', '03. SOP\'S', 0, 1, 1, 0, 2, 1, 176, '2021-04-14 22:18:07', NULL),
	(248, '8L9BIqoTY_hx', 'FORMATOS', '03. SOP\'S/SOP-08 GestiÃ³n de IT', 0, 1, 1, 0, 2, 1, 247, '2021-04-14 22:18:55', NULL),
	(249, '-oSK__KgiQ2i', 'INSTRUCTIVOS', '03. SOP\'S/SOP-08 GestiÃ³n de IT', 0, 1, 1, 0, 2, 1, 247, '2021-04-14 22:19:11', NULL),
	(250, 'QTrh3B7c468u', 'OTROS', '03. SOP\'S/SOP-08 GestiÃ³n de IT', 0, 1, 1, 0, 2, 1, 247, '2021-04-14 22:19:20', NULL),
	(251, 'queyUywgyZu_', 'PLAN', '03. SOP\'S/SOP-08 GestiÃ³n de IT', 0, 1, 1, 0, 2, 1, 247, '2021-04-14 22:19:32', NULL);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.notification: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.permision
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.permision: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permision` DISABLE KEYS */;
/*!40000 ALTER TABLE `permision` ENABLE KEYS */;

-- Volcando estructura para tabla fileshare.user
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
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
