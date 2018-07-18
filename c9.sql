-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: c9
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `GrupoInvestigacion`
--

DROP TABLE IF EXISTS `GrupoInvestigacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GrupoInvestigacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `grupo_eu` text NOT NULL,
  `grupo_es` text NOT NULL,
  `lineasInv_es` text NOT NULL,
  `lineasInv_eu` text NOT NULL,
  `desde` year(4) DEFAULT NULL,
  `hasta` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GrupoInvestigacion`
--

LOCK TABLES `GrupoInvestigacion` WRITE;
/*!40000 ALTER TABLE `GrupoInvestigacion` DISABLE KEYS */;
INSERT INTO `GrupoInvestigacion` VALUES (1,1,'Grupo de Magnetismo de Donostia-SS. Línea spintrónica','Grupo de Magnetismo de Donostia-SS. Línea spintrónica','Dinámica de imananción y spintrónica','Dinámica de imananción y spintrónica',NULL,NULL,'2018-02-14 10:14:26','2018-02-14 10:14:26',NULL),(3,4,'Materiales Magnéticos','Materiales Magnéticos + Tecnologías ( GMT)','Estudio de aleaciones metálicas amorfas y nanocristalinas ferromagnéticas\r\n(cintas, hilos y microhilos magnéticos) y metamateriales en el rango de\r\nmicroondas. Estos estudios abordan aspectos relativos a: Procesado mediante\r\ndiversas técnicas (tratamientos térmicos bajo tensión, campo magnético etc ),\r\nPropiedades Magnéticas (dinámica de movimiento de paredes, proceso de\r\nimanación biestable, fluctuaciones del campo switching, coercitividad,...),\r\nMagnetoelásticas (magnetostricción a saturación) y de Magnetotransporte\r\n(térmico o electrónico), Comportamiento electromagnético en alta frecuencia\r\nde micro-nanohilos y metamateriales (magnetoimpedancia gigante,\r\nresonancia ferromagnética) Aplicaciones como Sensores Magnéticos\r\n(codificación magnética, firma magnetoelástica…).','Estudio de aleaciones metálicas amorfas y nanocristalinas ferromagnéticas\r\n(cintas, hilos y microhilos magnéticos) y metamateriales en el rango de\r\nmicroondas. Estos estudios abordan aspectos relativos a: Procesado mediante\r\ndiversas técnicas (tratamientos térmicos bajo tensión, campo magnético etc ),\r\nPropiedades Magnéticas (dinámica de movimiento de paredes, proceso de\r\nimanación biestable, fluctuaciones del campo switching, coercitividad,...),\r\nMagnetoelásticas (magnetostricción a saturación) y de Magnetotransporte\r\n(térmico o electrónico), Comportamiento electromagnético en alta frecuencia\r\nde micro-nanohilos y metamateriales (magnetoimpedancia gigante,\r\nresonancia ferromagnética) Aplicaciones como Sensores Magnéticos\r\n(codificación magnética, firma magnetoelástica…).',2011,2018,'2018-02-22 15:04:19','2018-02-22 15:04:19',NULL);
/*!40000 ALTER TABLE `GrupoInvestigacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GrupoInvestigacionParticipantes`
--

DROP TABLE IF EXISTS `GrupoInvestigacionParticipantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GrupoInvestigacionParticipantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_grupoInvestigacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `GrupoInvestigacionParticipantes_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GrupoInvestigacionParticipantes`
--

LOCK TABLES `GrupoInvestigacionParticipantes` WRITE;
/*!40000 ALTER TABLE `GrupoInvestigacionParticipantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `GrupoInvestigacionParticipantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GrupoInvestigacionResponsables`
--

DROP TABLE IF EXISTS `GrupoInvestigacionResponsables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GrupoInvestigacionResponsables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_grupoInvestigacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `GrupoInvestigacionResponsables_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GrupoInvestigacionResponsables`
--

LOCK TABLES `GrupoInvestigacionResponsables` WRITE;
/*!40000 ALTER TABLE `GrupoInvestigacionResponsables` DISABLE KEYS */;
INSERT INTO `GrupoInvestigacionResponsables` VALUES (42,1,1);
/*!40000 ALTER TABLE `GrupoInvestigacionResponsables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto`
--

DROP TABLE IF EXISTS `adjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjunto` (
  `id_adjunto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_adjunto` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `title_adjunto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `orden_adjunto` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `fecha_adjunto` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_adjunto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto`
--

LOCK TABLES `adjunto` WRITE;
/*!40000 ALTER TABLE `adjunto` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adjunto_relacion`
--

DROP TABLE IF EXISTS `adjunto_relacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjunto_relacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_adjunto` int(11) NOT NULL DEFAULT '0',
  `id_objeto` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjunto_relacion`
--

LOCK TABLES `adjunto_relacion` WRITE;
/*!40000 ALTER TABLE `adjunto_relacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjunto_relacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `tipo` varchar(25) NOT NULL DEFAULT 'EXTERNO',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,1,'Unai','Susperregi','EHU','2018-01-26 14:17:04','2018-02-22 08:35:53');
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autores_relacion`
--

DROP TABLE IF EXISTS `autores_relacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores_relacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores_relacion`
--

LOCK TABLES `autores_relacion` WRITE;
/*!40000 ALTER TABLE `autores_relacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `autores_relacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `congresos`
--

DROP TABLE IF EXISTS `congresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `congresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `congreso_eu` text NOT NULL,
  `congreso_es` text NOT NULL,
  `conferenciaPoster` varchar(255) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `congresos`
--

LOCK TABLES `congresos` WRITE;
/*!40000 ALTER TABLE `congresos` DISABLE KEYS */;
INSERT INTO `congresos` VALUES (1,1,'IEEE PES PowerAfrica 2016','IEEE PES PowerAfrica 2016','Power Line Monitoring for the Analysis of Overhead Line Rating Forecasting Methods','Livingstone-Zambia','2016-06-30','2016-06-30','2018-02-25 14:28:56','2018-02-14 10:36:59',NULL);
/*!40000 ALTER TABLE `congresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `congresosProfesores`
--

DROP TABLE IF EXISTS `congresosProfesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `congresosProfesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_congreso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `congresosProfesores_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `congresosProfesores`
--

LOCK TABLES `congresosProfesores` WRITE;
/*!40000 ALTER TABLE `congresosProfesores` DISABLE KEYS */;
/*!40000 ALTER TABLE `congresosProfesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamientoNuevo`
--

DROP TABLE IF EXISTS `equipamientoNuevo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamientoNuevo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `departamento_eu` text NOT NULL,
  `departamento_es` text NOT NULL,
  `equipo_eu` text NOT NULL,
  `equipo_es` text NOT NULL,
  `institucion` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `data` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamientoNuevo`
--

LOCK TABLES `equipamientoNuevo` WRITE;
/*!40000 ALTER TABLE `equipamientoNuevo` DISABLE KEYS */;
INSERT INTO `equipamientoNuevo` VALUES (1,1,'epa','kljl','kjl','h','o8','y9',NULL,'2018-02-10 21:02:41','2018-02-10 21:02:41','2018-02-10'),(2,1,'Ingeniaritza Kimikoa eta Ingurunea','Ingeniaritza Kimikoa eta Ingurunea','Saiakera mekanikoak burutzeko makina unibertsala','Máquina universal de Ensayos','UPV/EHU','42.750',2017,'2018-02-25 15:50:19','2018-02-25 15:50:19',NULL);
/*!40000 ALTER TABLE `equipamientoNuevo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes` (
  `id_imagenes` int(11) NOT NULL AUTO_INCREMENT,
  `alt_imagenes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title_imagenes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nom_imagenes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tamano_imagenes` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `orden_imagenes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `posicion_imagenes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fecha_imagenes` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_imagenes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes`
--

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_relacion`
--

DROP TABLE IF EXISTS `imagenes_relacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes_relacion` (
  `id_img_rel` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagenes` int(11) DEFAULT '0',
  `id_objeto` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_img_rel`),
  KEY `id_imagenes` (`id_imagenes`),
  CONSTRAINT `imagenes_relacion_ibfk_1` FOREIGN KEY (`id_imagenes`) REFERENCES `imagenes` (`id_imagenes`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_relacion`
--

LOCK TABLES `imagenes_relacion` WRITE;
/*!40000 ALTER TABLE `imagenes_relacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagenes_relacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2017_07_19_140414_create_adjunto_table',0),('2017_07_19_140414_create_adjunto_relacion_table',0),('2017_07_19_140414_create_clientes_table',0),('2017_07_19_140414_create_clientes_banco_table',0),('2017_07_19_140414_create_clientes_consultas_table',0),('2017_07_19_140414_create_clientes_direccion_table',0),('2017_07_19_140414_create_clientes_direccion_tp_table',0),('2017_07_19_140414_create_clientes_fp_table',0),('2017_07_19_140414_create_clientes_moneda_table',0),('2017_07_19_140414_create_clientes_regimen_table',0),('2017_07_19_140414_create_clientes_tcli_table',0),('2017_07_19_140414_create_clientes_tipo_trabajo_table',0),('2017_07_19_140414_create_clientes_tp_table',0),('2017_07_19_140414_create_imagenes_table',0),('2017_07_19_140414_create_imagenes_relacion_table',0),('2017_07_19_140414_create_password_resets_table',0),('2017_07_19_140414_create_permission_role_table',0),('2017_07_19_140414_create_permissions_table',0),('2017_07_19_140414_create_role_user_table',0),('2017_07_19_140414_create_roles_table',0),('2017_07_19_140414_create_sessions_table',0),('2017_07_19_140414_create_users_table',0),('2017_07_19_140416_add_foreign_keys_to_clientes_banco_table',0),('2017_07_19_140416_add_foreign_keys_to_clientes_direccion_table',0),('2017_07_19_140416_add_foreign_keys_to_imagenes_relacion_table',0),('2017_07_19_140416_add_foreign_keys_to_permission_role_table',0),('2017_07_19_140416_add_foreign_keys_to_role_user_table',0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(12,1),(13,1),(18,1),(19,1),(12,3),(13,3),(18,3),(12,8),(18,8);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','Role Display Listing','See only Listing Of Role','2017-02-21 10:15:33','2017-10-31 14:34:28'),(2,'role-create','Roled Crear ','Create New Role','2017-02-21 10:15:33','2017-10-31 14:34:20'),(3,'role-edit','Role Edit ','Edit Role','2017-02-21 10:15:33','2017-10-31 14:34:16'),(4,'role-delete','Role Delete ','Delete Role','2017-02-21 10:15:33','2017-10-31 14:34:13'),(5,'permission-list','Permission Display  Listing','See only Listing of Permission','2017-02-23 14:41:35','2017-10-31 14:33:53'),(6,'permission-create','Permission Crear ','Create New Permission','2017-02-23 14:43:12','2017-10-31 14:33:48'),(7,'permission-edit','Permisssion Edit ','Edit Permission','2017-02-23 14:57:18','2017-10-31 14:33:44'),(8,'permission-delete','Permissiion Delete ','Delete Permission','2017-02-23 15:00:36','2017-10-31 14:33:38'),(12,'user-list','User Display  Listing','See only Listing of User','2017-02-24 09:28:54','2017-10-31 14:33:04'),(13,'user-create','User Create ','Create New User','2017-02-24 09:36:59','2017-10-31 14:32:56'),(18,'user-edit','User Edit ','Edit User','2017-02-28 14:52:19','2017-10-31 14:32:49'),(19,'user-delete','User Delete','Delete User','2017-03-02 08:42:23','2017-10-31 14:32:20');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programasDeIntercambio`
--

DROP TABLE IF EXISTS `programasDeIntercambio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programasDeIntercambio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `actividad_eu` text NOT NULL,
  `actividad_es` text NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programasDeIntercambio`
--

LOCK TABLES `programasDeIntercambio` WRITE;
/*!40000 ALTER TABLE `programasDeIntercambio` DISABLE KEYS */;
INSERT INTO `programasDeIntercambio` VALUES (7,1,'fuera','Laboratoire d’Informatique de l’UPPA (LIUPPA)','Ikerketa','actividad','2015-09-01','2015-09-01','2018-02-25 15:26:10','2018-02-25 15:26:10',NULL),(11,1,'enCasa','Facultad de Ciencias. Universidad de Buenos Aires. Argentina','Ikerketa','Ikerketa','2016-01-26','2016-01-26','2018-02-14 10:45:54','2018-02-14 10:45:54',NULL);
/*!40000 ALTER TABLE `programasDeIntercambio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programasDeIntercambiosProfesores`
--

DROP TABLE IF EXISTS `programasDeIntercambiosProfesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programasDeIntercambiosProfesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_programaIntercambio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  KEY `id_autor_2` (`id_autor`),
  CONSTRAINT `programasDeIntercambiosProfesores_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programasDeIntercambiosProfesores`
--

LOCK TABLES `programasDeIntercambiosProfesores` WRITE;
/*!40000 ALTER TABLE `programasDeIntercambiosProfesores` DISABLE KEYS */;
INSERT INTO `programasDeIntercambiosProfesores` VALUES (1,1,6),(3,1,11);
/*!40000 ALTER TABLE `programasDeIntercambiosProfesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectoInvestigacion`
--

DROP TABLE IF EXISTS `proyectoInvestigacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectoInvestigacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `proyecto_eu` text NOT NULL,
  `proyecto_es` text NOT NULL,
  `financinacion` varchar(255) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectoInvestigacion`
--

LOCK TABLES `proyectoInvestigacion` WRITE;
/*!40000 ALTER TABLE `proyectoInvestigacion` DISABLE KEYS */;
INSERT INTO `proyectoInvestigacion` VALUES (23,1,'empresa','Formación del profesorado de la Escuela Universitaria de ingeniería Dual del IMH Instituto de Máquina Herramienta en metodologías activas de enseñanza','Formación del profesorado de la Escuela Universitaria de ingeniería Dual del IMH Instituto de Máquina Herramienta en metodologías activas de enseñanza','IMH Instituto de Máquina Herramienta, 4.941€; Contrato EUSKOIKER FR60223','2016-01-01','2017-01-01','2018-02-22 10:12:10','2018-02-14 10:35:56',NULL),(26,4,'europa','Smart Plug Prototype Manufacturing','Smart Plug Prototype Manufacturing','EIFER – European Institute For Energy Research','2015-10-01','2016-12-30','2018-02-25 12:08:38','2018-02-14 10:26:10',NULL),(27,1,'erakundeak','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','','2018-02-14','2018-02-14','2018-02-22 10:12:28','2018-02-14 10:27:33',NULL),(28,1,'erakundeak','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','','2018-02-14','2018-02-14','2018-02-14 10:27:22','2018-02-14 10:27:22',NULL),(29,1,'erakundeak','aa','ss','','2018-01-30','2018-03-07','2018-02-22 09:51:39','2018-02-14 10:31:51',NULL),(30,1,'erakundeak','bb','bb','','2017-04-15','2018-02-20','2018-02-22 09:51:42','2018-02-14 10:31:53',NULL),(31,1,'erakundeak','bb','bb','','2017-04-15','2018-02-20','2018-02-22 09:51:45','2018-02-14 10:31:54',NULL),(32,1,'europa','ggsdfgsfg','sfgsfdg','','2018-02-22','2018-02-28','2018-02-25 12:13:26','2018-02-25 12:13:26','2018-02-25 12:13:26');
/*!40000 ALTER TABLE `proyectoInvestigacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectosInvestigacionDirectores`
--

DROP TABLE IF EXISTS `proyectosInvestigacionDirectores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectosInvestigacionDirectores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `proyectosInvestigacionDirectores_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectosInvestigacionDirectores`
--

LOCK TABLES `proyectosInvestigacionDirectores` WRITE;
/*!40000 ALTER TABLE `proyectosInvestigacionDirectores` DISABLE KEYS */;
INSERT INTO `proyectosInvestigacionDirectores` VALUES (2,1,20),(3,1,2);
/*!40000 ALTER TABLE `proyectosInvestigacionDirectores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectosInvestigacionInvestigadores`
--

DROP TABLE IF EXISTS `proyectosInvestigacionInvestigadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectosInvestigacionInvestigadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `proyectosInvestigacionInvestigadores_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectosInvestigacionInvestigadores`
--

LOCK TABLES `proyectosInvestigacionInvestigadores` WRITE;
/*!40000 ALTER TABLE `proyectosInvestigacionInvestigadores` DISABLE KEYS */;
INSERT INTO `proyectosInvestigacionInvestigadores` VALUES (1,1,21);
/*!40000 ALTER TABLE `proyectosInvestigacionInvestigadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `titulo_eu` text NOT NULL,
  `titulo_es` text NOT NULL,
  `editorialRevisa` varchar(255) NOT NULL,
  `capitulo` varchar(255) NOT NULL,
  `volumen` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicaciones`
--

LOCK TABLES `publicaciones` WRITE;
/*!40000 ALTER TABLE `publicaciones` DISABLE KEYS */;
INSERT INTO `publicaciones` VALUES (4,1,'libros','liburua','LIBRO','editorial','1','','2018-02-11','2018-02-14 10:38:54','2018-02-14 10:38:54','2018-02-14 10:38:54'),(5,1,'articulos','Review of dynamic line rating systems for wind power integration','Review of dynamic line rating systems for wind power integration','Renewable & Sustainable Energy Reviews','','53','2016-01-01','2018-02-14 10:39:45','2018-02-14 10:39:45',NULL),(6,4,'libros','Libro de Comunicaciones IBERCONAPPICE 2016','Libro de Comunicaciones IBERCONAPPICE 2016','APPICE, Madrid','','','2016-01-01','2018-02-25 14:55:07','2018-02-14 10:38:50',NULL);
/*!40000 ALTER TABLE `publicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacionesAutores`
--

DROP TABLE IF EXISTS `publicacionesAutores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacionesAutores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  KEY `id_autor_2` (`id_autor`),
  CONSTRAINT `publicacionesAutores_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacionesAutores`
--

LOCK TABLES `publicacionesAutores` WRITE;
/*!40000 ALTER TABLE `publicacionesAutores` DISABLE KEYS */;
INSERT INTO `publicacionesAutores` VALUES (2,1,5),(3,1,4);
/*!40000 ALTER TABLE `publicacionesAutores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(1,3),(1,4);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'owner','Project Owner','User is the owner of a given project','2017-02-21 10:35:01','2017-02-21 10:35:01'),(3,'admin','Administrator','Permiso para modificar profesorado','2017-02-21 10:36:17','2018-01-25 14:32:52'),(4,'Comercial','Profesorado','Profesorado','2017-02-21 14:16:27','2018-01-12 12:02:13'),(8,'Talde Burua','Talde Burua','Talde burua','2018-01-25 14:33:32','2018-01-25 14:33:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tesisDoctorales`
--

DROP TABLE IF EXISTS `tesisDoctorales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tesisDoctorales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `titulo_es` text NOT NULL,
  `titulo_eu` text NOT NULL,
  `departamento_es` text NOT NULL,
  `departamento_eu` text NOT NULL,
  `fechaLectura` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tesisDoctorales`
--

LOCK TABLES `tesisDoctorales` WRITE;
/*!40000 ALTER TABLE `tesisDoctorales` DISABLE KEYS */;
INSERT INTO `tesisDoctorales` VALUES (5,0,'tesisLeidas','aa','aa','aa','aa','2018-02-28','2018-02-23 10:34:11','2018-02-14 10:25:20','2018-02-14 10:25:20'),(11,0,'tesisLeidas','lkj','bbaab','lkj','lkj','2018-02-28','2018-02-14 10:25:22','2018-02-14 10:25:22','2018-02-14 10:25:22'),(12,0,'tesisLeidas','kj','dsaf','lkj','lkj','2018-02-09','2018-02-14 10:25:23','2018-02-14 10:25:23','2018-02-14 10:25:23'),(13,9,'tesisLeidas','Readability assessment and automatic text simplification. The analysis of basque complex structures','Euskarazko egitura sintaktiko konplexuen analisirako eta testuen sinplifikazio automatikorako proposamena ','Arquitectura','Arquitectura','2015-01-18','2018-02-23 14:54:40','2018-02-14 10:25:16',NULL),(15,4,'proximaLectura','Denbora errealeko monitorizazioa erabiliz, aireko línea elektrikoen portaeraren karakterizaziorako eta anpazitatearen kalkulurako metodología','Denbora errealeko monitorizazioa erabiliz, aireko línea elektrikoen portaeraren karakterizaziorako eta anpazitatearen kalkulurako metodología','Ingeniería Eléctrica','Ingeniería Eléctrica','2018-02-09','2018-02-23 10:21:25','2018-02-14 10:21:34',NULL),(17,1,'europa','asdf','asdf','adsf','adsf','2018-02-09','2018-02-09 14:50:05','2018-02-09 14:50:05',NULL);
/*!40000 ALTER TABLE `tesisDoctorales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tesisDoctoralesDirector`
--

DROP TABLE IF EXISTS `tesisDoctoralesDirector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tesisDoctoralesDirector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_tesisDoctoral` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `tesisDoctoralesDirector_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tesisDoctoralesDirector`
--

LOCK TABLES `tesisDoctoralesDirector` WRITE;
/*!40000 ALTER TABLE `tesisDoctoralesDirector` DISABLE KEYS */;
INSERT INTO `tesisDoctoralesDirector` VALUES (2,1,13),(4,1,15);
/*!40000 ALTER TABLE `tesisDoctoralesDirector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tesisDoctoralesDoctorando`
--

DROP TABLE IF EXISTS `tesisDoctoralesDoctorando`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tesisDoctoralesDoctorando` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_tesisDoctoral` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `tesisDoctoralesDoctorando_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tesisDoctoralesDoctorando`
--

LOCK TABLES `tesisDoctoralesDoctorando` WRITE;
/*!40000 ALTER TABLE `tesisDoctoralesDoctorando` DISABLE KEYS */;
/*!40000 ALTER TABLE `tesisDoctoralesDoctorando` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ldap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_autor` int(11) NOT NULL,
  `lng` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'es',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `user_id` (`ldap`),
  KEY `id_autor` (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ldap','Unai','Susperregi','unai@irunweb.com','$2y$10$.C.S2IBsEYFDAMwwCyjTVOdZZIY8V1QxoU/eQTG/MHKyzCX8G0y4a',1,1,'eu','6hZlzESP10jwmuwV30tOVbk21HIbnZ8IMBwo6hEPXw65QsoM5cyaoOMuPtMV','2016-10-28 12:07:55','2018-03-07 10:26:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-07 10:41:24
