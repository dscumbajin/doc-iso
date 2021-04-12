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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.comment: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
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

-- Volcando estructura para tabla fileshare.descargas
DROP TABLE IF EXISTS `descargas`;
CREATE TABLE IF NOT EXISTS `descargas` (
  `id_descarga` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_file` int(11) NOT NULL DEFAULT '0',
  `contador` int(11) NOT NULL DEFAULT '0',
  `download_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_descarga`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fileshare.descargas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `descargas` DISABLE KEYS */;
INSERT INTO `descargas` (`id_descarga`, `id_user`, `id_file`, `contador`, `download_at`) VALUES
	(1, 4, 33, 1, '2021-04-12 08:28:49'),
	(2, 4, 52, 1, '2021-04-12 08:41:41');
/*!40000 ALTER TABLE `descargas` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.file: ~0 rows (aproximadamente)
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
	(89, '7RRI_RdbQL1r', '03. ARTES SELLOS DE GARANTÃA DE TODOS LOS CLIENTES', '02. COP\'S/COP-02 DiseÃ±o y desarrollo/1. ESPECIFICACIONES', 0, 1, 1, 0, 2, 1, 64, '2021-04-12 09:26:27', NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.notification: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fileshare.permision: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permision` DISABLE KEYS */;
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
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
