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
INSERT INTO `GrupoInvestigacion` VALUES (1,1,'Grupo de Magnetismo de Donostia-SS. Línea spintrónica','Grupo de Magnetismo de Donostia-SS. Línea spintrónica','Dinámica de imananción y spintrónica','Dinámica de imananción y spintrónica',2011,2018,'2018-03-07 15:43:55','2018-02-14 10:14:26',NULL),(3,4,'Materiales Magnéticos','Materiales Magnéticos + Tecnologías ( GMT)','Estudio de aleaciones metálicas amorfas y nanocristalinas ferromagnéticas\r\n(cintas, hilos y microhilos magnéticos) y metamateriales en el rango de\r\nmicroondas. Estos estudios abordan aspectos relativos a: Procesado mediante\r\ndiversas técnicas (tratamientos térmicos bajo tensión, campo magnético etc ),\r\nPropiedades Magnéticas (dinámica de movimiento de paredes, proceso de\r\nimanación biestable, fluctuaciones del campo switching, coercitividad,...),\r\nMagnetoelásticas (magnetostricción a saturación) y de Magnetotransporte\r\n(térmico o electrónico), Comportamiento electromagnético en alta frecuencia\r\nde micro-nanohilos y metamateriales (magnetoimpedancia gigante,\r\nresonancia ferromagnética) Aplicaciones como Sensores Magnéticos\r\n(codificación magnética, firma magnetoelástica…).','Estudio de aleaciones metálicas amorfas y nanocristalinas ferromagnéticas\r\n(cintas, hilos y microhilos magnéticos) y metamateriales en el rango de\r\nmicroondas. Estos estudios abordan aspectos relativos a: Procesado mediante\r\ndiversas técnicas (tratamientos térmicos bajo tensión, campo magnético etc ),\r\nPropiedades Magnéticas (dinámica de movimiento de paredes, proceso de\r\nimanación biestable, fluctuaciones del campo switching, coercitividad,...),\r\nMagnetoelásticas (magnetostricción a saturación) y de Magnetotransporte\r\n(térmico o electrónico), Comportamiento electromagnético en alta frecuencia\r\nde micro-nanohilos y metamateriales (magnetoimpedancia gigante,\r\nresonancia ferromagnética) Aplicaciones como Sensores Magnéticos\r\n(codificación magnética, firma magnetoelástica…).',2011,2018,'2018-02-22 15:04:19','2018-02-22 15:04:19',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,1,'Unai','Susperregi','EHU','2018-01-26 14:17:04','2018-02-22 08:35:53'),(2,2,'Itziar','Adarraga Usabiaga','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(3,3,'Naiara','Aginako Bengoa','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(4,4,'Lore','Agirre Zipitria','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(5,5,'Lander','Agirregomezkorta Arriaga','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(6,6,'Carlos Humberto','Aguerre Telleria','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(7,7,'Pedro M','Aiestaran Matxinandiarena','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(8,8,'Amadeo','Aizpurua Requero','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(9,9,'Mikel','Alberro Astarbe','EXTERNO','2018-03-13 09:51:12','2018-03-13 09:51:12'),(10,10,'Gorka','Alberro Eguilegor','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(11,11,'Jose Ignacio','Albisu Aparicio','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(12,12,'Joaquin','Albisua Garmendia','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(13,13,'Maria Cristina','Alcalde Valverde','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(14,14,'Juan Carlos','Aldasoro Alustiza','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(15,15,'Unai','Aldasoro Marcellan','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(16,16,'Iker','Aldazabal Angulo','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(17,17,'Iñigo','Aldazabal Mensa','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(18,18,'Izaskun','Aldezabal Roteta','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(19,19,'Itxaso','Algar Petralanda','EXTERNO','2018-03-13 09:51:13','2018-03-13 09:51:13'),(20,20,'Usue','Aliende Urrutia','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(21,21,'Patxi','Alkorta Egiguren','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(22,22,'Francisco Javier','Almandoz Berrondo','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(23,23,'Jose Edmundo','Alonso Arnedo','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(24,24,'Haritz','Altzibar Manterola','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(25,25,'Patricia','Alvarez De Arcaya Pidal','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(26,26,'Irantzu','Alvarez Gonzalez','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(27,27,'Jose Miguel','Andonegi Martinez','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(28,28,'Mireia','Andonegui San Martin','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(29,29,'Maria  Angeles','Andres Sanchez','EXTERNO','2018-03-13 09:51:14','2018-03-13 09:51:14'),(30,30,'Olatz','Ansa Osteriz','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(31,31,'Mikel','Antoñana Otaño','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(32,32,'Estibaliz','Apiñaniz Fernandez De Larrinoa','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(33,33,'Jone','Apraiz Iza','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(34,34,'Maria Purisima','Aragoneses Errasti','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(35,35,'Maria Guadalupe','Aragoneses Errasti','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(36,36,'Edurne','Arakistain Jauregi','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(37,37,'Ainhoa','Arambarri Andueza','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(38,38,'Ioseba','Aramburu Ayerbe','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(39,39,'Joseba','Aramburu Barrenechea','EXTERNO','2018-03-13 09:51:15','2018-03-13 09:51:15'),(40,40,'German','Arana Landin','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(41,41,'Maria Pilar','Arana Perez','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(42,42,'Endika','Arandia Aldalur','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(43,43,'Aitzpea','Aranguren Izqueaga','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(44,44,'Alejandro','Aranjuelo Michelena','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(45,45,'Joseba','Aranzabal Iraeta','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(46,46,'Oier','Aranzabal Uriarte','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(47,47,'Maria Jesus','Aranzabe Urruzola','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(48,48,'Aitor','Arbelaiz Garmendia','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(49,49,'Iñaki','Arrambide García','EXTERNO','2018-03-13 09:51:16','2018-03-13 09:51:16'),(50,50,'Jon','Arrate Basabe','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(51,51,'Ainhoa','Arrese Arratibel','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(52,52,'Iera','Arrieta Cortajarena','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(53,53,'Asier','Arrizabalaga Echeverria','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(54,54,'Rosa','Arruabarrena Santos','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(55,55,'Maria Puy','Arruti Martinez','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(56,56,'Oihana','Arruti Ruiz','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(57,57,'Maite','Artetxe Uria','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(58,58,'Ion','Artola Mendiola','EXTERNO','2018-03-13 09:51:17','2018-03-13 09:51:17'),(59,59,'Eider','Artutxa Bengoetxea','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(60,60,'Izaskun','Aseguinolaza Braga','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(61,61,'Francisco Javier','Asensio De Miguel','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(62,62,'Iñigo','Azcarate Mutiloa','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(63,63,'Leire','Azcona Uribe','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(64,64,'Xabier','Azkorra Apraiz','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(65,65,'Mikel','Azkuna Mendiola','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(66,66,'Oier','Azula Aurrekoetxea','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(67,67,'Olatz','Azurza Zubizarreta','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(68,68,'Luis Maria','Bandres Unanue','EXTERNO','2018-03-13 09:51:18','2018-03-13 09:51:18'),(69,69,'Irati','Barandiaran Olaetxea','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(70,70,'Izaskun','Baro Yubero','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(71,71,'Jose Ignacio','Barragues Fuentes','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(72,72,'Jose Enrique','Barranco Riveros','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(73,73,'Mariano','Barron Ruiz','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(74,74,'Javier','Barroso Lazaro','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(75,75,'Nora','Barroso Moreno','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(76,76,'Xabier','Barrutieta Basurko','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(77,77,'Aitor','Basañez Llantada','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(78,78,'Maria','Basterrechea Lozano','EXTERNO','2018-03-13 09:51:19','2018-03-13 09:51:19'),(79,79,'Sylvain','Baudoin -','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(80,80,'Oskar','Bell Fernandez','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(81,81,'Aitor','Beranoagirre Imaz','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(82,82,'Eneka','Bernal Corta','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(83,83,'Ander','Berridi Aguirre','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(84,84,'Juan Maria','Blanco Aranguren','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(85,85,'Angel','Blanco Menor','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(86,86,'Miren','Blanco Miguel','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(87,87,'Estibaliz','Briz Blanco','EXTERNO','2018-03-13 09:51:20','2018-03-13 09:51:20'),(88,88,'David','Buenestado Simon','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(89,89,'Ane Miren','Bueno Berridi','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(90,90,'Maria Cinta','Caballer Vives','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(91,91,'Jon Mikel','Cabezas Escaño','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(92,92,'Sara','Cabezudo Maeso','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(93,93,'Tamara','Calvo Correas','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(94,94,'Pilar Maria','Calvo Salomon','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(95,95,'Aritza','Camblong Ruiz','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(96,96,'Laida','Cano Gonzalez','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(97,97,'Maria Asunción','Cantera Lopez De Silanes','EXTERNO','2018-03-13 09:51:21','2018-03-13 09:51:21'),(98,98,'Maria Luisa','Cantonnet Jordi','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(99,99,'Jose Ignacio','Cantonnet Mendia','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(100,100,'Neftali','Carbajal De La Red','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(101,101,'Agustin','Carbajal Garcia','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(102,102,'Tamara','Carballo Blanco','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(103,103,'Daniel','Carballo Ostolaza','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(104,104,'Jose Eugenio','Caro Calzada','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(105,105,'Sheyla','Carrasco Hernandez','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(106,106,'Beatriz Margarita Maria Pilar','Cartón Garcia','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(107,107,'Francisco Javier','Cendoya Sainz','EXTERNO','2018-03-13 09:51:22','2018-03-13 09:51:22'),(108,108,'Oleksandr','Chyzhyk','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(109,109,'Rafael','Ciriza El Cid','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(110,110,'Maria Angeles','Corcuera Maeso','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(111,111,'Paula','Corte Leon','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(112,112,'Maite','Crespo De Antonio','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(113,113,'Carlos','Cuadrado Viana','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(114,114,'Alvaro','Cuesta Cejudo','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(115,115,'Izaskun','Davila Rodriguez','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(116,116,'Juan','De Gracia Ingelmo','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(117,117,'Pedro Luis','De Hoyos Martinez','EXTERNO','2018-03-13 09:51:23','2018-03-13 09:51:23'),(118,118,'Maria Coro','De La Caba Ciriza','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(119,119,'Gemma','De La Flor Martin','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(120,120,'Mikel','Diaz De Ilarraza Aramberri','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(121,121,'Iñigo','Diez Garcia','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(122,122,'Marta','Diez Garcia','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(123,123,'Belén','Díez Gorrochategui','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(124,124,'Aritz','Diez Oronoz','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(125,125,'Maria Lourdes','Dominguez Carrascoso','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(126,126,'Victoriano','Dominguez Carrascoso','EXTERNO','2018-03-13 09:51:24','2018-03-13 09:51:24'),(127,127,'Maria Del Carmen','Dovale Carrion','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(128,128,'Maria Aranzazu','Eceiza Mendiguren','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(129,129,'Jose Luis','Echarri Sabatie','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(130,130,'Goretti','Echegaray Lopez','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(131,131,'Ricardo','Echepare Zugasti','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(132,132,'Itziar','Egües Artola','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(133,133,'Arritokieta','Eizaguirre Iribar','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(134,134,'Mikel','Enparantza Agirre','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(135,135,'Xabier','Erdocia Iriarte','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(136,136,'Ion','Errea Lope','EXTERNO','2018-03-13 09:51:25','2018-03-13 09:51:25'),(137,137,'Ganix','Esnaola Aldanondo','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(138,138,'David','Esteban Rodriguez','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(139,139,'Julian','Estevez Sanz','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(140,140,'Ion','Etxabe Gutierrez','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(141,141,'Alaitz','Etxabide Etxeberria','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(142,142,'Jaione','Etxebarria Elezgarai','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(143,143,'Haritz','Etxeberria Altuna','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(144,144,'Aitor','Etxeberria Urkia','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(145,145,'Aitzol','Ezeiza Ramos','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(146,146,'Antxon','Fernandez Cobe','EXTERNO','2018-03-13 09:51:26','2018-03-13 09:51:26'),(147,147,'Borja','Fernandez D\'arlas Bidegain','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(148,148,'Unai','Fernandez De Beto','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(149,149,'Elsa','Fernandez Gomez De Segura','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(150,150,'Xabier','Fernandez Llanderas','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(151,151,'Rut','Fernandez Marin','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(152,152,'Florencio','Fernandez Marzo','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(153,153,'Raquel','Fernandez Salvador','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(154,154,'Pilar','Fernandez Sanchez','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(155,155,'Olga','Fernandez Vicente','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(156,156,'Maria Montserrat','Ferreira Sanchez','EXTERNO','2018-03-13 09:51:27','2018-03-13 09:51:27'),(157,157,'Raquel','Fuente Dacal','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(158,158,'Nagore','Gabilondo Lopez','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(159,159,'Joseba','Gainza Barrencua','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(160,160,'Roberto','Galarraga Astibia','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(161,161,'Gorka','Garate Zubiaurre','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(162,162,'Guillermo Luis','García Anduaga','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(163,163,'Clara Maria','García Astrain','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(164,164,'Maria Angeles','García Bahillo','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(165,165,'Arkaitz','Garcia Larra','EXTERNO','2018-03-13 09:51:28','2018-03-13 09:51:28'),(166,166,'Araceli','García Nuñez','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(167,167,'Pedro Maria','García Sanchez','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(168,168,'Xabier','Garicano Osinaga','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(169,169,'Ugutz','Garitaonaindia Antsoategi','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(170,170,'Maddi','Garmendia Antin','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(171,171,'Ignacio','Garmendia Azurmendi','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(172,172,'Asier','Garmendia Mujica','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(173,173,'Mikel','Garmendia Mujika','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(174,174,'Tania','Garrido Diaz','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(175,175,'Vicente','Gascon Gascon','EXTERNO','2018-03-13 09:51:29','2018-03-13 09:51:29'),(176,176,'Belen','Gaspar García','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(177,177,'Estibaliz','Goikoetxea Miranda','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(178,178,'Ignacio Santiago','Gomez Arriaran','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(179,179,'Sandra','Gomez Fernandez','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(180,180,'Maria','Gonzalez Alriols','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(181,181,'Madalen','Gonzalez Bereziartua','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(182,182,'Miren Itziar','Gonzalez Gurruchaga','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(183,183,'Lorena','Gonzalez Legarreta','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(184,184,'Kizkitza','Gonzalez Munduate','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(185,185,'Oihana','Gordobil Go','EXTERNO','2018-03-13 09:51:30','2018-03-13 09:51:30'),(186,186,'Eugenio','Gorrotxategui San Martin','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(187,187,'Maria Del Carmen','Gratal Perez','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(188,188,'Olatz','Grijalba Aseguinolaza','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(189,189,'Olatz','Guaresti Larrea','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(190,190,'Pedro Manuel','Guerrero Manso','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(191,191,'Genaro','Guisasola Aranzabal','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(192,192,'Patricia','Gullon Estevez','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(193,193,'Jose Maria','Gurruchaga Vazquez','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(194,194,'Itziar','Gurrutxaga Gurrutxaga','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(195,195,'Juncal','Gutierrez Cáceres','EXTERNO','2018-03-13 09:51:31','2018-03-13 09:51:31'),(196,196,'Jose Lorenzo','Gutierrez De Rozas Salterain','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(197,197,'Alfonso','Hernandez Lasa','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(198,198,'Fabio','Hernandez Ramos','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(199,199,'Rene Alexander','Herrera Diaz','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(200,200,'Juan Maria','Hidalgo Betanzos','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(201,201,'Ignacio','Ibarrondo Martinez-iturralde','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(202,202,'Maria','Iceta Echave','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(203,203,'Aimar','Insausti Bello','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(204,204,'Nagore','Insausti Irastorza','EXTERNO','2018-03-13 09:51:32','2018-03-13 09:51:32'),(205,205,'Usoa','Iñurrieta Urmeneta','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(206,206,'Jon','Iradi Arteaga','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(207,207,'Edurne','Irisarri Alli','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(208,208,'Miren','Isasa Gabilondo','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(209,209,'Leire','Iturriaga Oñarte-echevarria','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(210,210,'Jon','Iturrioz Sanchez','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(211,211,'Ane','Izagirre Korta','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(212,212,'Mikel','Jauregi Odriozola','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(213,213,'Jose Luis','Jodra Luque','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(214,214,'Galder','Kortaberria Altzerreka','EXTERNO','2018-03-13 09:51:33','2018-03-13 09:51:33'),(215,215,'Mikel','Labayen Esnaola','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(216,216,'Jalel','Labidi Bouchrika','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(217,217,'Jokin','Lamuedra Graña','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(218,218,'Celia','Lana Ranz','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(219,219,'Izaskun','Larraza Arocena','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(220,220,'Ainara','Larrea Unzain','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(221,221,'Iker','Laskurain Iturbe','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(222,222,'Itsaso','Leceta Lasa','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(223,223,'Iñigo','Leon Cascante','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(224,224,'Ion','Lizuain Lilly','EXTERNO','2018-03-13 09:51:34','2018-03-13 09:51:34'),(225,225,'Rodrigo Manuel','Llano-ponte Alvarez','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(226,226,'Karmele','Lopez De Ipiña Peña','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(227,227,'Fernando','Lopez Jimenez','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(228,228,'Francisco','Lopez Ruiz','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(229,229,'Francisco Javier','Lorenz Muro','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(230,230,'Maria','Lozano Chico','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(231,231,'Daniel','Luengas Carreño','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(232,232,'Miguel Angel','Maiza Galparsoro','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(233,233,'Maria Juncal','Manterola Zabala','EXTERNO','2018-03-13 09:51:35','2018-03-13 09:51:35'),(234,234,'Maria Cristina','Marieta Gorriti','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(235,235,'Alexander','Martin Garin','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(236,236,'Miren Itsaso','Martinez Aguirre','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(237,237,'Ainara','Martinez De Albeniz Ausin','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(238,238,'Unai','Martinez De Lizarduy St','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(239,239,'Asier','Martinez Salaberria','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(240,240,'Aingeru','Mayor Martinez','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(241,241,'Josu Mirena','Mayora Oria','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(242,242,'Jose Antonio','Millan Garcia','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(243,243,'Oihana','Mitxelena Hoyos','EXTERNO','2018-03-13 09:51:36','2018-03-13 09:51:36'),(244,244,'Julian Jose','Molina Altuna','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(245,245,'Elena','Monasterio Iruretagoyena','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(246,246,'Iñaki','Mondragon Egaña','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(247,247,'Gurutz','Mondragon Otamendi','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(248,248,'Maria Belen','Mongelos Oquiñena','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(249,249,'Jon','Montalban Sanchez','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(250,250,'Fermin','Montejo Ubillos','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(251,251,'Fernando','Mora Martin','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(252,252,'Adolfo','Morais Ezquerro','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(253,253,'Amaia','Morales Matias','EXTERNO','2018-03-13 09:51:37','2018-03-13 09:51:37'),(254,254,'Oihana','Moreno Arotzena','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(255,255,'Vicente','Moreno Bañeza','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(256,256,'Abdelmalik','Moujahid Moujahid','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(257,257,'Beñat','Muguruza Aseguinolaza','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(258,258,'Faustino','Mujika Garitano','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(259,259,'Arritxu','Muxika Carrion','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(260,260,'Pedro','Nieto Larrondo','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(261,261,'Jose David','Nuñez Gonzalez','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(262,262,'Carlos','Ochoa Laburu','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(263,263,'Oier','Ochoantesana Berriozabalgoitia','EXTERNO','2018-03-13 09:51:38','2018-03-13 09:51:38'),(264,264,'Moises','Odriozola Maritorena','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(265,265,'Iñigo','Odriozola Urbieta','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(266,266,'Andoni','Olano Zugasti','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(267,267,'Arantxa','Olasagasti Aguado','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(268,268,'Jose Antonio','Oriozabala Brit','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(269,269,'Ander','Orue Mendizabal','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(270,270,'Juan Luis','Osa Amilibia','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(271,271,'Usue','Oses Orbegozo','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(272,272,'Joseba Xabier','Ostolaza Zamora','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(273,273,'Juan Pedro','Otaduy Zubizarreta','EXTERNO','2018-03-13 09:51:39','2018-03-13 09:51:39'),(274,274,'Irati','Otamendi Irizar','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(275,275,'Maria Luisa','Otaño Echaniz','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(276,276,'Elisa','Pardo Ruiz','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(277,277,'Idoya','Pellejero Salaberria','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(278,278,'Cristina','Peña Rodriguez','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(279,279,'Miriam Victoria','Peñalba Otaduy','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(280,280,'Tomas A.','Perez Fernandez','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(281,281,'Angel','Perez Manso','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(282,282,'Jose Javier','Perez Martinez','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(283,283,'Juan Manuel','Pikatza Atxa','EXTERNO','2018-03-13 09:51:40','2018-03-13 09:51:40'),(284,284,'Imanol','Pildain Sainz','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(285,285,'Maria','Porcel Valenzuela','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(286,286,'Marina','Quijada Van Den Berghe','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(287,287,'Jon','Rementeria Rodriguez','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(288,288,'Aloña','Retegui Miner','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(289,289,'Jose Eduardo','Robles Barrios','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(290,290,'Alvaro','Rodriguez Aguirrebengoa','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(291,291,'Javier','Rodriguez Aseguinolaza','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(292,292,'Angel Agustin','Rodriguez Pierna','EXTERNO','2018-03-13 09:51:41','2018-03-13 09:51:41'),(293,293,'Jesus Maria','Romera Aguayo','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(294,294,'Montserrat','Ruiz Fabre','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(295,295,'Juan Antonio','Sadaba Fernandez','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(296,296,'Maialen','Sagarna Aramburu','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(297,297,'Angel','Salaverria Garnacho','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(298,298,'Jose Luis','Salazar Salazar','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(299,299,'Miren','Salegi Gorrotxategi','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(300,300,'Aitor','San Francisco Lasa','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(301,301,'Cristina','Sanchez Agra','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(302,302,'Maialen','Sanchez Guereño','EXTERNO','2018-03-13 09:51:42','2018-03-13 09:51:42'),(303,303,'Jose Manuel','Sanchez Losada','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(304,304,'Montserrat','Sanfeliu Parera','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(305,305,'Arantzazu','Santamaria Echart','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(306,306,'Roman','Santos Ciriquiain','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(307,307,'Ainara','Saralegi Otamendi','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(308,308,'Ane','Sarasola Iñiguez','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(309,309,'Paulo','Sarriugarte Onaindia','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(310,310,'Isabel','Sellens Fernandez','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(311,311,'Maria','Senderos Laka','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(312,312,'Joel','Sepulveda Irastorza','EXTERNO','2018-03-13 09:51:43','2018-03-13 09:51:43'),(313,313,'Ane','Sequeiros Echeverria','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(314,314,'Leyre','Sillero Ortigosa','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(315,315,'Eneko','Solaberrieta Mendez','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(316,316,'Kepa','Solozabal Bergara','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(317,317,'Agnieszka','Stepien .','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(318,318,'Ana','Susperregui Burguete','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(319,319,'Ahmed','Talaat Farag Ibrahim','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(320,320,'Gerardo','Tapia Otaegui','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(321,321,'Maria Aranzazu','Tapia Otaegui','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(322,322,'Ana','Telleria Imaz','EXTERNO','2018-03-13 09:51:44','2018-03-13 09:51:44'),(323,323,'Agnieszka','Tercjak Sliwinska','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(324,324,'Iñaki','Tolaretxipi Tejería','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(325,325,'Lorena','Ugarte Soraluce','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(326,326,'Juan Jose','Ugartemendia De La Iglesia','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(327,327,'Jone','Uranga Gama','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(328,328,'Gorka','Urbicain Pelayo','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(329,329,'Leire','Urbina Moreno','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(330,330,'Marta','Urdanpilleta Landaribar','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(331,331,'Maider','Uriarte Idiazabal','EXTERNO','2018-03-13 09:51:45','2018-03-13 09:51:45'),(332,332,'Miren Josune','Urien Crespo','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(333,333,'Nagore','Urrutia Del Campo','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(334,334,'Javier','Urruzola Moreno','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(335,335,'Aitor','Urtasun Gonzalez','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(336,336,'Jose Agustin','Vaquero Marino','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(337,337,'Gustavo Adolfo','Vargas Silva','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(338,338,'Carlos','Yusta San Vicente','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(339,339,'Miren Josune','Zabala Galarza','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(340,340,'Nerea','Zaldua Carazo','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(341,341,'Iratxe','Zarandona Rodriguez','EXTERNO','2018-03-13 09:51:46','2018-03-13 09:51:46'),(342,342,'Maria Arantzazu','Zatarain Gordoa','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(343,343,'Arkady Pavlovich','Zhukov Egorova','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(344,344,'Valentina','Zhukova Zhukova','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(345,345,'Svetlana','Zimnukhova .','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(346,346,'Itziar','Zubia Olaskoaga','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(347,347,'Maria Manuela','Zubitur Soroa','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(348,348,'Mikel','Zubizarreta Irure','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(349,349,'Iraitz','Zugasti Alcorta','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(350,350,'Kristina','Zuza Elosegi','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47'),(351,351,'Rafael','Zuza Elosegui','EXTERNO','2018-03-13 09:51:47','2018-03-13 09:51:47');
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
INSERT INTO `congresos` VALUES (1,1,'IEEE PES PowerAfrica 2016','IEEE PES PowerAfrica 2016','Power Line Monitoring for the Analysis of Overhead Line Rating Forecasting Methods','Livingstone-Zambia','2017-12-30','2017-12-31','2018-03-08 13:44:33','2018-03-08 13:44:33',NULL);
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
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(12,1),(13,1),(18,1),(19,1),(12,3),(13,3),(18,3);
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
-- Table structure for table `politekniko1`
--

DROP TABLE IF EXISTS `politekniko1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `politekniko1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) DEFAULT NULL,
  `apellidos` varchar(37) DEFAULT NULL,
  `nombre` varchar(29) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `politekniko1`
--

LOCK TABLES `politekniko1` WRITE;
/*!40000 ALTER TABLE `politekniko1` DISABLE KEYS */;
INSERT INTO `politekniko1` VALUES (2,'MIADARRAGA-263','ADARRAGA USABIAGA','MARIA ICIAR'),(3,'NAGINAKO-263','AGINAKO BENGOA','NAIARA'),(4,'LAGIRREGOMEZ-263','AGIRREGOMEZKORTA ARRIAGA','LANDER'),(5,'LAGIRREGOMEZKORTA-26','AGIRREGOMEZKORTA ARRIAGA','LANDER'),(6,'MBAGOTE-263','AGOTE BERGANZO','MARIA BLANCA'),(7,'CHAGUERRE-263','AGUERRE TELLERIA','CARLOS HUMBERTO'),(8,'PMAIESTARAN-263','AIESTARAN MATXINANDIARENA','PEDRO MARIA'),(9,'MALBERRO-263','ALBERRO ASTARBE','MIKEL'),(10,'GALBERRO-263','ALBERRO EGUILEGOR','GORKA'),(11,'IJALBISU-263','ALBISU APARICIO','IGNACIO JOSE'),(12,'MCALCALDE-263','ALCALDE VALVERDE','MARIA CRISTINA'),(13,'JCALDASORO-263','ALDASORO ALUSTIZA','JUAN CARLOS'),(14,'UALDASORO-263','ALDASORO MARCELLAN','UNAI'),(15,'IALDEZABALROTETA-263','ALDEZABAL ROTETA','IZASKUN'),(16,'IALGAR-263','ALGAR PETRALANDA','ITXASO'),(17,'FJALMANDOZ-263','ALMANDOZ BERRONDO','FRANCISCO JAVIER'),(18,'MDANDRES-263','ANDRES SANCHEZ','MARIA DE LOS ANGELES'),(19,'OANSA-263','ANSA OSTERIZ','OLATZ'),(20,'JAPRAIZ-263','APRAIZ IZA','JONE'),(21,'MPARAGONESES-263','ARAGONESES ERRASTI','MARIA PURISIMA'),(22,'MGARAGONESES-263','ARAGONESES ERRASTI','MARIA GUADALUPE'),(23,'AARAMBARRI-263','ARAMBARRI ANDUEZA','AINHOA'),(24,'GARANA-263','ARANA LANDIN','GERMAN'),(25,'MPARANA-263','ARANA PEREZ','MARIA PILAR'),(26,'EARANDIA-263','ARANDIA ALDALUR','ENDIKA'),(27,'AARANJUELO-263','ARANJUELO MICHELENA','ALEJANDRO'),(28,'JARANZABAL-263','ARANZABAL IRAETA','JOSEBA'),(29,'MEARAQUISTAIN-263','ARAQUISTAIN JAUREGUI','MIREN EDURNE'),(30,'AARBELAIZ-263','ARBELAIZ GARMENDIA','AITOR'),(31,'IARRAMBIDE-263','ARRAMBIDE GARCIA','I'),(32,'AARRESE-263','ARRESE ARRATIBEL','AINHOA'),(33,'RMARRUABARRENA-263','ARRUABARRENA SANTOS','ROSA MARIA'),(34,'MDARRUTI-263','ARRUTI MARTINEZ','MARIA DEL PUY'),(35,'MARTETXE-263','ARTETXE URIA','MAITE'),(36,'EARTUTXA-263','ARTUTXA BENGOETXEA','EIDER'),(37,'IASEGUINOLAZA-263','ASEGUINOLAZA BRAGA','IZASKUN'),(38,'PMASTRAIN-263','ASTRAIN ANSO','PEDRO MANUEL'),(39,'IAZCARATE-263','AZCARATE MUTILOA','I'),(40,'LAZCONA-263','AZCONA URIBE','LEIRE'),(41,'XAZKORRA-263','AZKORRA APRAIZ','XABIER'),(42,'OAZULA-263','AZULA AURREKOETXEA','OIER'),(43,'OAZURZA-263','AZURZA ZUBIZARRETA','OLATZ'),(44,'IBARANDIARAN-263','BARANDIARAN OLAETXEA','IRATI'),(45,'IBARO-263','BARO YUBERO','IZASKUN'),(46,'JIBARRAGUES-263','BARRAGUES FUENTES','JOSE IGNACIO'),(47,'JBARRALLO-263','BARRALLO CALONGE','JAVIER'),(48,'NBARROSO-263','BARROSO MORENO','NORA'),(49,'OBELL-263','BELL FERNANDEZ','OSCAR'),(50,'MIBENITO-263','BENITO BUTRON','MARIA ISABEL'),(51,'ABERANOAGIRRE-263','BERANOAGIRRE IMAZ','AITOR'),(52,'ABILBAO-263','BILBAO ERA','AINARA'),(53,'JMBLANCO-263','BLANCO ARANGUREN','JUAN MARIA'),(54,'ABLANCO-263','BLANCO MENOR','ANGEL'),(55,'DBUENESTADO-263','BUENESTADO SIMON','DAVID'),(56,'SCABEZUDO-263','CABEZUDO MAESO','SARA'),(57,'TCALVO-263','CALVO CORREAS','TAMARA'),(58,'PMCALVO-263','CALVO SALOMON','PILAR MARIA'),(59,'ACAMBLONG-263','CAMBLONG RUIZ','ARITZA'),(60,'LCANO-263','CANO GONZALEZ','LAIDA'),(61,'MACANTERA-263','CANTERA LOPEZ DE SILANES','MARIA ASUNCION'),(62,'MLCANTONNET-263','CANTONNET JORDI','MARIA LUISA'),(63,'NCARBAJAL-263','CARBAJAL DE LA RED','NEFTALI'),(64,'TCARBALLO-263','CARBALLO BLANCO','TAMARA'),(65,'DCARBALLO-263','CARBALLO OSTOLAZA','DANIEL'),(66,'JECARO-263','CARO CALZADA','JOSE EUGENIO'),(67,'SCARRASCO-263','CARRASCO HERNANDEZ','SHEYLA'),(68,'BMCARTON-263','CARTON GARCIA','BEATRIZ MARGARITA MARIA PILAR'),(69,'FJCENDOYA-263','CENDOYA SAINZ','FRANCISCO JAVIER'),(70,'MACORCUERA-263','CORCUERA MAESO','MARIA ANGELES'),(71,'CCUADRADO-263','CUADRADO VIANA','CARLOS'),(72,'ACUESTA-263','CUESTA CEJUDO','ALVARO'),(73,'JDEGRACIA-263','DE GRACIA IGELMO','JUAN'),(74,'PLDEHOYOS-263','DE HOYOS MARTINEZ','PEDRO LUIS'),(75,'MCDELACABA-263','DE LA CABA CIRIZA','MARIA CORO'),(76,'GDELAFLOR-263','DE LA FLOR MARTIN','GEMMA'),(77,'FDELOSFRAILES-263','DE LOS FRAILES BAZ','FRANCISCO'),(78,'SDEMATOS-263','DE MATOS FERNANDES','SUSANA'),(79,'MDIAZDEILARRAZA-263','DIAZ DE ILARRAZA ARAMBERRI','MIKEL'),(80,'MLDOMINGUEZ-263','DOMINGUEZ CARRASCOSO','MARIA LOURDES'),(81,'VDOMINGUEZ-263','DOMINGUEZ CARRASCOSO','VICTORIANO'),(82,'MDDOVALE-263','DOVALE CARRION','MARIA DEL CARMEN'),(83,'IDUQUE-263','DUQUE INGUNZA','ITXASO'),(84,'MAECEIZA-263','ECEIZA MENDIGUREN','MARIA ARANZAZU'),(85,'GECHEGARAY-263','ECHEGARAY LOPEZ','GORETTI'),(86,'RECHEPARE-263','ECHEPARE ZUGASTI','RICARDO'),(87,'IEG','EG','ITZIAR'),(88,'MAELORZA-263','ELORZA AMOROS','MARIA ARANTZA'),(89,'JELSO-263','ELSO TORRALBA','JORGE'),(90,'MENPARANTZA-263','ENPARANTZA AGIRRE','MIKEL'),(91,'XERDOCIA-263','ERDOCIA IRIARTE','XABIER'),(92,'GESNAOLA-263','ESNAOLA ALDANONDO','GANIX'),(93,'BESTALAYO-263','ESTALAYO GARCIA','BEATRIZ'),(94,'DESTEBAN-263','ESTEBAN RODRIGUEZ','DAVID'),(95,'JESTEVEZ-263','ESTEVEZ SANZ','JULIAN'),(96,'IETXABE-263','ETXABE GUTIERREZ','ION'),(97,'AETXABIDE-263','ETXABIDE ETXEBERRIA','ALAITZ'),(98,'HECHEVERRIA-263','ETXEBERRIA ALTUNA','HARITZ'),(99,'HETXEBERRIA-263','ETXEBERRIA ALTUNA','HARITZ'),(100,'AETXEBERRIAURKIA-263','ETXEBERRIA URKIA','AITOR'),(101,'AEZEIZA-263','EZEIZA RAMOS','AITZOL'),(102,'JAEZQUERRA-263','EZQUERRA VENTOSA','JOSE ANGEL'),(103,'AFERNANDEZ-263','FERNANDEZ COBE','ANTXON'),(104,'AFERNANDEZCORDERO-26','FERNANDEZ CORDERO','ANGEL'),(105,'MEFERNANDEZ-263','FERNANDEZ CRESPO','M EBELIA'),(106,'BFERNANDEZD\'ARLAS-26','FERNANDEZ D\' ARLAS BIDEGAIN','BORJA'),(107,'UFDZDEBETO','FDEZ DE BETO','UNAI'),(108,'UFDEZDEBETO','FDZ DE BETO','UNAI'),(109,'FFERNANDEZ-263','FERNANDEZ MARZO','FLORENCIO'),(110,'JFERNANDEZ-263','FERNANDEZ RODRIGUEZ','JAVIER'),(111,'RFERNANDEZ-263','FERNANDEZ SALVADOR','RAQUEL'),(112,'PFERNANDEZ-263','FERNANDEZ SANCHEZ','PILAR'),(113,'MMFERREIRA-263','FERREIRA SANCHEZ','MARIA MONTSERRAT'),(114,'AMFERRERO-263','FERRERO RODRIGUEZ','ANA MARIA'),(115,'RFUENTE-263','FUENTE DACAL','RAQUEL'),(116,'NGABILONDO-263','GABILONDO LOPEZ','NAGORE'),(117,'JIGALARRAGA-263','GALARRAGA ALDANONDO','JOSE IGNACIO'),(118,'RGALARRAGA-263','GALARRAGA ASTIBIA','ROBERTO'),(119,'GGARATE-263','GARATE ZUBIAURRE','GORKA'),(120,'GLGARCIA-263','GARCIA ANDUAGA','GUILLERMO LUIS'),(121,'CMGARCIA-263','GARCIA ASTRAIN','CLARA MARIA'),(122,'MAGARCIA-263','GARCIA BAHILLO','MARIA ANGELES'),(123,'AGARCIALARRA','GARCIA LARRA','ARKAITZ'),(124,'AGARCIA-263','GARCIA NU','ARACELI'),(125,'PMGARCIA-263','GARCIA SANCHEZ','PEDRO MARIA'),(126,'XGARICANO-263','GARICANO OSINAGA','XABIER'),(127,'UGARITAONAINDIA-263','GARITAONAINDIA ANTSOATEGI','UGUTZ'),(128,'MGARMENDIAANTIN-263','GARMENDIA ANTIN','MADDI'),(129,'IGARMENDIA-263','GARMENDIA AZURMENDI','IGNACIO'),(130,'AGARMENDIA-263','GARMENDIA MUJICA','ASIER'),(131,'MGARMENDIA-263','GARMENDIA MUJIKA','MIKEL'),(132,'TGARRIDO-263','GARRIDO DIAZ','TANIA'),(133,'VGASCON-263','GASCON GASCON','VICENTE'),(134,'BGASPAR-263','GASPAR GARCIA','BELEN'),(135,'ISGOMEZ-263','GOMEZ ARRIARAN','IGNACIO SANTIAGO'),(136,'SGOMEZ-263','GOMEZ FERNANDEZ','SANDRA'),(137,'MEGOMEZ-263','GOMEZ GENUA','MARIA ENCARNACION'),(138,'MGONZALEZ-263','GONZALEZ ALRIOLS','MARIA'),(139,'MGONZALEZBEREZIARTUA','GONZALEZ BEREZIARTUA','MADALEN'),(140,'MIGONZALEZ-263','GONZALEZ GURRUCHAGA','MIREN ITZIAR'),(141,'KGONZALEZ-263','GONZALEZ MUNDUATE','KIZKITZA'),(142,'AGONZALEZ-263','GONZALEZ SARMIENTO','ALBERTO'),(143,'OGORDOBIL-263','GORDOBIL GO','OIHANA'),(144,'EGORROCHATEGUI-263','GORROCHATEGUI SAN MARTIN','EUGENIO'),(145,'MDGRATAL-263','GRATAL PEREZ','MARIA DEL CARMEN'),(146,'OGUARESTI-263','GUARESTI LARREA','OLATZ'),(147,'PMGUERRERO-263','GUERRERO MANSO','PEDRO MANUEL'),(148,'GGUISASOLA-263','GUISASOLA ARANZABAL','GENARO'),(149,'PGULLON-263','GULLON ESTEVEZ','PATRICIA'),(150,'IGURRUCHAGA-263','GURRUTXAGA GURRUTXAGA','ITZIAR'),(151,'JGUTIERREZ-263','GUTIERREZ CACERES','JUNCAL'),(152,'AHERNANDEZ-263','HERNANDEZ LASA','ALFONSO'),(153,'RAHERRERA-263','HERRERA DIAZ','RENE ALEXANDER'),(154,'JMHIDALGO-263','HIDALGO BETANZOS','JUAN MARIA'),(155,'MICETA-263','ICETA ECHAVE','MARIA'),(156,'AINSAUSTI-263','INSAUSTI BELLO','AIMAR'),(157,'NINSAUSTI-263','INSAUSTI IRASTORZA','NAGORE'),(158,'JIRADI-263','IRADI ARTEAGA','JON'),(159,'MAIRASTORZA-263','IRASTORZA GO','MARIA ARANZAZU'),(160,'EIRISARRI-263','IRISARRI ALLI','EDURNE'),(161,'LITURRIAGA-263','ITURRIAGA O','LEIRE'),(162,'MJAUREGI-263','JAUREGI ODRIOZOLA','MIKEL'),(163,'RJIMENEZ-263','JIMENEZ REDAL','RUBEN'),(164,'J JODRA-263','JODRA LUQUE','JOSE  LUIS'),(165,'GCORTABERRIA-263','KORTABERRIA ALTZERREKA','GALDER'),(166,'JLABIDI-263','LABIDI BOUCHRIKA','JALEL'),(167,'CLANA-263','LANA RANZ','CELIA'),(168,'ALARREA-263','LARREA UNZAIN','AINARA'),(169,'ILASKURAIN-263','LASKURAIN ITURBE','IKER'),(170,'ALAURENZ-263','LAURENZ SENOSIAIN','ANGELA'),(171,'ILECETA-263','LECETA LASA','ITSASO'),(172,'ALENIZ-263','LENIZ ERE','ANE'),(173,'ILEON-263','LEON CASCANTE','I'),(174,'ILIZUAIN-263','LIZUAIN LILLY','ION'),(175,'RMLLANO-PONTE-263','LLANO-PONTE ALVAREZ','RODRIGO MANUEL'),(176,'MKLOPEZDEIPI','LOPEZ DE IPI','MIREN KARMELE'),(177,'MFLOPEZ-263','LOPEZ LIQUETE','MARIA FELISA'),(178,'MCLOPEZ-263','LOPEZ LIZARRALDE','MARIA CARMEN'),(179,'FL','LOPEZ RUIZ','FRANCISCO'),(180,'MLOZANO-263','LOZANO CHICO','MARIA'),(181,'MJMANTEROLA-263','MANTEROLA ZABALA','MARIA JUNCAL'),(182,'MCMARIETA-263','MARIETA GORRITI','MARIA CRISTINA'),(183,'JMAROTO-263','MAROTO PE','JOSU'),(184,'MDMARTIN-263','MARTIN ALBERDI','LOLI'),(185,'AMARTINEZDEALBENIZ-2','MARTINEZ DE ALBENIZ AUSIN','AINARA'),(186,'UMARTINEZDELIZARDUY-','MARTINEZ DE LIZARDUY STURTZE','UNAI'),(187,'AMARTINEZ-263','MARTINEZ SALABERRIA','ASIER'),(188,'AMARTIN-263','MARTIN GARIN','ALEXANDER'),(189,'JMMAYORA-263','MAYORA ORIA','JOSU MIRENA'),(190,'AMAYOR-263','MAYOR MARTINEZ','AINGERU'),(191,'PIMENDIZABAL-263','MENDIZABAL MIGUELEZ','PEDRO IGNACIO'),(192,'DMERIDA-263','MERIDA SANZ','DAVID'),(193,'JAMILLAN-263','MILLAN GARCIA','JOSE ANTONIO'),(194,'OMICHELENA-263','MITXELENA HOYOS','OIHANA'),(195,'JJMOLINA-263','MOLINA ALTUNA','JULIAN JOSE'),(196,'IMOLINERO-263','MOLINERO AGUIRRE','ITXASO'),(197,'EMONASTERIO-263','MONASTERIO IRURETAGOYENA','ELENA'),(198,'GMONDRAGON-263','MONDRAGON OTAMENDI','GURUTZ'),(199,'AMORAIS-263','MORAIS EZQUERRO','ADOLFO'),(200,'FMORA-263','MORA MARTIN','FERNANDO'),(201,'OMORENO-263','MORENO AROTZENA','OIHANA'),(202,'VMORENO-263','MORENO BA','VICENTE'),(203,'FMUJIKA-263','MUJIKA GARITANO','FAUSTINO'),(204,'PNIETO-263','NIETO LARRONDO','PEDRO'),(205,'MCOCARIZ-263','OCARIZ SANZ','MARIA CARMEN'),(206,'COCHOA-263','OCHOA LABURU','CARLOS'),(207,'OOCHOANTESANA-263','OCHOANTESANA BERRIOZABALGOITIA','OIER'),(208,'EOCINA-263','OCINA FUERTES','ESTIBALIZ'),(209,'MODRIOZOLA-263','ODRIOZOLA MARITORENA','MOISES'),(210,'IODRIOZOLA-263','ODRIOZOLA URBIETA','I'),(211,'AOLASAGASTI-263','OLASAGASTI AGUADO','ARANTXA'),(212,'JAORIOZABALA-263','ORIOZABALA BRIT','JOSE ANTONIO'),(213,'AORUE-263','ORUE MENDIZABAL','ANDER'),(214,'UOSES-263','OSES ORBEGOZO','USUE'),(215,'JXOSTOLAZA-263','OSTOLAZA ZAMORA','JOSEBA XABIER'),(216,'JPOTADUY-263','OTADUY ZUBIZARRETA','JUAN PEDRO'),(217,'IOTAMENDI-263','OTAMENDI IRIZAR','IRATI'),(218,'IPELLEJERO-263','PELLEJERO SALABERRIA','IDOYA'),(219,'MVPE','PE','MIRIAM VICTORIA'),(220,'CPE','PE','CRISTINA'),(221,'APEREZ-263','PEREZ MANSO','ANGEL'),(222,'JJPEREZ-263','PEREZ MARTINEZ','JOSE JAVIER'),(223,'IPILDAIN-263','PILDAIN SAINZ','IMANOL'),(224,'RPRADO-263','PRADO GARCIA','RAQUEL'),(225,'MQUIJADA-263','QUIJADA VAN DEN BERGHE','MARINA'),(226,'ARETEGUI-263','RETEGUI MINER','ALO'),(227,'AARODRIGUEZ-263','RODRIGUEZ PIERNA','ANGEL AGUSTIN'),(228,'JMROMERA-263','ROMERA AGUAYO','JESUS MARIA'),(229,'MMRUIZ-263','RUIZ FABRE','MARIA MONSERRAT'),(230,'NRUIZ-263','RUIZ JIMENEZ','NOELIA'),(231,'MBSAENZ-263','SAENZ MARIN','MARIA BELEN'),(232,'MSAGARNA-263','SAGARNA ARANBURU','MAIALEN'),(233,'FJSALAZAR-263','SALAZAR RUCKAUER','FRANCISCO JAVIER'),(234,'JLSALAZAR-263','SALAZAR SALAZAR','JOSE LUIS'),(235,'CSANCHEZ-263','SANCHEZ AGRA','CRISTINA'),(236,'JMSANCHEZ-263','SANCHEZ LOSADA','JOSE MANUEL'),(237,'MSANFELIU-263','SANFELIU PARERA','MONTSERRAT'),(238,'ASANTAMARIA-263','SANTAMARIA ECHART','ARANTZAZU'),(239,'RSANTOS-263','SANTOS CIRIQUIAIN','ROMAN'),(240,'ASARALEGUI-263','SARALEGI OTAMENDI','AINARA'),(241,'ASARASOLA-263','SARASOLA I','ANE'),(242,'JSEPULVEDA-263','SEPULVEDA IRASTORZA','JOEL'),(243,'LSERRANO-263','SERRANO CANTADOR','LUIS'),(244,'A STEPIEN-263','STEPIEN','AGNIESZKA  URSZULA'),(245,'ASUSPERREGUI-263','SUSPERREGUI BURGUETE','ANA'),(246,'GTAPIA-263','TAPIA OTAEGUI','GERARDO'),(247,'MATAPIA-263','TAPIA OTAEGUI','MARIA ARANZAZU'),(248,'ATERCJAK-263','TERCJAK SLIWINSKA','AGNIESZKA'),(249,'ITOLARETXIPI-263','TOLARETXIPI TEJERIA','I'),(250,'ATOLEDANO-263','TOLEDANO ZABALETA','ANA'),(251,'JJUGARTEMENDIA-263','UGARTEMENDIA DE LA IGLESIA','JUAN JOSE'),(252,'LUGARTE-263','UGARTE SORALUCE','LORENA'),(253,'JURANGA-263','URANGA GAMA','JONE'),(254,'LURBINA-263','URBINA MORENO','LEIRE'),(255,'MURDANPILLETA-263','URDANPILLETA LANDARIBAR','MARTA'),(256,'MURGOITI-263','URGOITI AGUIRRE','MERCEDES'),(257,'MURIARTE-263','URIARTE IDIAZABAL','MAIDER'),(258,'IURRUZOLA-263','URRUZOLA IRAZUSTA','I'),(259,'JURRUZOLA-263','URRUZOLA MORENO','JAVIER'),(260,'JAVAQUERO-263','VAQUERO MARINO','JOSE AGUSTIN'),(261,'GAVARGAS-263','VARGAS SILVA','GUSTAVO ADOLFO'),(262,'AVELASCO-263','VELASCO ZARZUELO','AITOR'),(263,'MJZABALA-263','ZABALA GALARZA','MIREN JOSUNE'),(264,'NZALDUA-263','ZALDUA CARAZO','NEREA'),(265,'BZAPIRAIN-263','ZAPIRAIN SIERRA','BE'),(266,'MAZATARAIN-263','ZATARAIN GORDOA','MARIA ARANTZAZU'),(267,'IZUBIA-263','ZUBIA OLASKOAGA','ITZIAR'),(268,'MMZUBITUR-263','ZUBITUR SOROA','MARIA MANUELA'),(269,'KZUZA-263','ZUZA ELOSEGI','KRISTINA'),(270,'RZUZA-263','ZUZA ELOSEGUI','RAFAEL'),(271,'UFERNANDEZDEBETO','FERNANDEZ DE BETO','UNAI'),(272,'PLDEHOYOSMARTINEZ-26','DE HOYOS MARTINEZ','PEDRO LUIS'),(273,'IARAMBURU-263','ARAMBURU AYERBE','IOSEBA'),(274,'MISASA-263','ISASA GABILONDO','MIREN'),(275,'NURRUTIA-263','URRUTIA DEL CAMPO','NAGORE'),(276,'IDIEZ-263','DIEZ GARCIA','I'),(277,'JARAMBURU-263','ARAMBURU BARRENECHEA','JOSEBA'),(278,'OGRIJALBA-263','GRIJALBA ASEGUINOLAZA','OLATZ'),(279,'JETXEBARRIA-263','ETXEBARRIA ELEZGARAI','JAIONE'),(280,'AIZAGIRRE-263','IZAGIRRE KORTA','ANE'),(281,'IALDAZABAL-263','ALDAZABAL ANGULO','IKER'),(282,'FCABALLERO-263','CABALLERO CASTRESANA','FELIX'),(283,'JLOSA-263','OSA AMILIBIA','JUAN LUIS'),(284,'AURTASUN-263','URTASUN GONZALEZ','AITOR'),(285,'PSARRIUGARTE-263','SARRIUGARTE ONANDIA','PAULO'),(286,'MAMAIZA-263','MAIZA GALPARSORO','MIGUEL ANGEL'),(287,'AMOUJAHID-263','MOUJAHID MOUJAHID','ABDELMALIK'),(288,'EFERNANDEZ-263','FERNANDEZ GOMEZ DE SEGURA','ELSA'),(289,'LPURQUIZU-263','URQUIZU ITURRARTE','LUIS PABLO'),(290,'JLCHARTERINA-263','CHARTERINA LOPEZ DE GUERE','JOSEBA LAURENTZI'),(291,'ISELLENS-263','SELLENS FERNANDEZ','ISABEL'),(292,'MANDONEGUI-263','ANDONEGUI SAN MARTIN','MIREIA'),(293,'ESOLABERRIETA-263','SOLABERRIETA MENDEZ','ENEKO'),(294,'MSENDEROS-263','SENDEROS LACA','MARIA'),(295,'ILARRAZA-263','LARRAZA AROCENA','IZASKUN'),(296,'JMONTALBAN-263','MONTALBAN SANCHEZ','JON'),(297,'XBARRUTIETA-263','BARRUTIETA BASURKO','XABIER'),(298,'GURBICAIN-263','URBICAIN PELAYO','GORKA'),(299,'ADIEZ-263','DIEZ ORONOZ','ARITZ'),(300,'JEROBLES-263','ROBLES BARRIOS','JOSE EDUARDO'),(301,'JGAINZA-263','GAINZA BARRENCUA','JOSEBA'),(302,'FHERNANDEZ-263','HERNANDEZ RAMOS','FABIO'),(303,'IDAVILA-263','DAVILA RODRIGUEZ','IZASKUN'),(304,'JRIZKEAGA-263','IZKEAGA ZINKUNEGI','JOSE RAMON'),(305,'XFERNANDEZ-263','FERNANDEZ LLANDERAS','XABIER'),(306,'AMORALES-263','MORALES MAT','AMAIA'),(307,'AMUXIKA-263','MUXIKA CARRION','ARRITXU'),(308,'LSILLERO-263','SILLERO ORTIGOSA','LEYRE'),(309,'JFERNANDEZUGALDE-263','FERNANDEZ UGALDE','JON'),(310,'MJURIEN-263','URIEN CRESPO','MIREN JOSUNE'),(311,'DLUENGAS-263','LUENGAS CARRE','DANIEL'),(312,'OFERNANDEZ-263','FERNANDEZ VICENTE','OLGA'),(313,'JMCABEZAS-263','CABEZAS ESCA','JON MIKEL'),(314,'MCRESPO-263','CRESPO DE ANTONIO','MAITE'),(315,'ASANFRANCISCO-263','SAN FRANCISCO LASA','AITOR'),(316,'SBAUDOIN-263','BAUDOIN','SYLVAIN'),(317,'MZUBIZARRETA-263','ZUBIZARRETA IRURE','MIKEL'),(318,'MJURIENCRESPO-263','URIEN CRESPO','MIREN JOSUNE'),(319,'DLUENGASCARRE','LUENGAS CARRE','DANIEL'),(320,'MCRESPODEANTONIO-263','CRESPO DE ANTONIO','MAITE'),(321,'RFERNANDEZMARIN-263','FERNANDEZ MARIN','RUT'),(322,'IREMENTERIA-263','REMENTERIA RODRIGUEZ','ION'),(323,'BALEMAN-263','ALEMAN ASTIZ','BEATRIZ'),(324,'MSALEGI-263','SALEGI GORROTXATEGI','MIREN'),(325,'OFERNANDEZVICENTE-26','FERNANDEZ VICENTE','OLGA'),(326,'TAPEREZ-263','PEREZ FERNANDEZ','TOMAS ANTONIO'),(327,'GJTORRE-263','TORRE HERNANDEZ','GORGONIO JOSE LUIS'),(328,'AJARRUARTE-263','ARRUARTE LASA','ANA JESUS'),(329,'JMPIKATZA-263','PIKATZA ATXA',''),(330,'JIITURRIOZ','ITURRIOZ SANCHEZ',''),(331,'JMCABEZASESCA','CABEZAS ESCA','JON MIKEL'),(332,'IZUGASTI-263','ZUGASTI ALCORTA','IRAITZ'),(333,'MIMARTINEZ-263','MARTINEZ AGUIRRE','MIREN ITSASO'),(334,'ASEQUEIROS-263','SEQUEIROS ECHEVERRIA','ANE'),(335,'AETXEBERRIA-263','ETXEBERRIA URKIA','AITOR'),(336,'AARRIZABALAGA-263','ARRIZABALAGA ECHEVERRIA','ASIER'),(337,'MLABAYEN-263','LABAYEN ESNAOLA','MIKEL'),(338,'BMUGURUZA-263','MUGURUZA ASEGUINOLAZA','BE'),(339,'JGOMEZ-263','GOMEZ HERMOSO DE MENDOZA','JOSEBA'),(340,'MAZCUNA-263','AZCUNA MENDIOLA','MIKEL'),(341,'KSOLOZABAL-263','SOLOZABAL BERGARA','KEPA'),(342,'AIGARCIA-263','GARCIA ECHARRI','AITZOL IMANOL'),(343,'MPORCEL-263','PORCEL VALENZUELA','MARIA'),(344,'MANTO','ANTO','MIKEL'),(345,'UI','I','USOA'),(346,'IERREA-263','ERREA LOPE','ION'),(347,'JRODRIGUEZ-263','RODRIGUEZ ASEGUINOLAZA','JAVIER'),(348,'SZIMNUKHOVA-263','ZIMNUKHOVA','SVETLANA'),(349,'AEIZAGUIRRE-263','EIZAGUIRRE IRIBAR','ARRITOKIETA'),(350,'JASADABA-263','SADABA FERNANDEZ','JUAN ANTONIO');
/*!40000 ALTER TABLE `politekniko1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `politekniko2`
--

DROP TABLE IF EXISTS `politekniko2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `politekniko2` (
  `id` int(3) NOT NULL DEFAULT '0',
  `apellidos` varchar(38) DEFAULT NULL,
  `nombre` varchar(29) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `politekniko2`
--

LOCK TABLES `politekniko2` WRITE;
/*!40000 ALTER TABLE `politekniko2` DISABLE KEYS */;
INSERT INTO `politekniko2` VALUES (1,'ADARRAGA USABIAGA','ITZIAR','itziar.adarraga@ehu.eus'),(2,'AGINAKO BENGOA','NAIARA','naiara.aginako@ehu.eus'),(3,'AGIRRE ZIPITRIA','LORE','lore.agirre@ehu.es'),(4,'AGIRREGOMEZKORTA ARRIAGA','LANDER','lander.agirregomezkorta@ehu.es'),(5,'AGUERRE TELLERIA','CARLOS HUMBERTO','carloshumberto.aguerre@ehu.es'),(6,'AIESTARAN MATXINANDIARENA','PEDRO M','pedromaria.aiestaran@ehu.eus'),(7,'AIZPURUA REQUERO','AMADEO','amadeo.aizpurua@ehu.es'),(8,'ALBERRO ASTARBE','MIKEL','mikel.alberro@ehu.eus'),(9,'ALBERRO EGUILEGOR','GORKA','gorka.alberro@ehu.eus'),(10,'ALBISU APARICIO','JOSE IGNACIO*','inaki.albisu@ehu.eus'),(11,'ALBISUA GARMENDIA','JOAQUIN','joaquin.albisua@ehu.eus'),(12,'ALCALDE VALVERDE','MARIA CRISTINA','c.alcalde@ehu.eus'),(13,'ALDASORO ALUSTIZA','JUAN CARLOS','juancarlos.aldasoro@ehu.eus'),(14,'ALDASORO MARCELLAN','UNAI','unai.aldasoro@ehu.es'),(15,'ALDAZABAL ANGULO','IKER','iker.aldazabal@ehu.eus'),(16,'ALDAZABAL MENSA','IÑIGO','ialdazabal@ehu.es'),(17,'ALDEZABAL ROTETA','IZASKUN','izaskun.aldezabal@ehu.eus'),(18,'ALGAR PETRALANDA','ITXASO','itxaso.algar@ehu.es'),(19,'ALIENDE URRUTIA','USUE','usue.aliende@ehu.es'),(20,'ALKORTA EGIGUREN','PATXI','patxi.alkorta@ehu.es'),(21,'ALMANDOZ BERRONDO','FRANCISCO JAVIER','jabier.almandoz@ehu.eus'),(22,'ALONSO ARNEDO','JOSE EDMUNDO','joseedmundo.alonso@ehu.es'),(23,'ALTZIBAR MANTEROLA','HARITZ','haritz.altzibar@ehu.es'),(24,'ALVAREZ DE ARCAYA PIDAL','PATRICIA','patricia.alvarez@ehu.es'),(25,'ALVAREZ GONZALEZ','IRANTZU','irantzu.alvarez@ehu.es'),(26,'ANDONEGI MARTINEZ','JOSE MIGUEL','jm.andonegi@ehu.es'),(27,'ANDONEGUI SAN MARTIN','MIREIA','mireia.andonegui@ehu.eus'),(28,'ANDRES SANCHEZ','MARIA  ANGELES','marian.andres@ehu.eus'),(29,'ANSA OSTERIZ','OLATZ','olatz.ansa@ehu.eus'),(30,'ANTOÑANA OTAÑO','MIKEL*','mikel.antonana@ehu.eus'),(31,'APIÑANIZ FERNANDEZ DE LARRINOA','ESTIBALIZ','estibaliz.apinaniz@ehu.es'),(32,'APRAIZ IZA','JONE','jone.apraiz@ehu..es'),(33,'ARAGONESES ERRASTI','MARIA GUADALUPE','mariaguadalupe.aragoneses@ehu.eus'),(34,'ARAGONESES ERRASTI','MARIA PURISIMA','mariapurisima.aragoneses@ehu.eus'),(35,'ARAKISTAIN JAUREGI','EDURNE','edurne.arakistain@ehu.es'),(36,'ARAMBARRI ANDUEZA','AINHOA','ainhoa.arambarri@ehu.eus'),(37,'ARAMBURU AYERBE','IOSEBA','ioseba.aranburu@ehu.eus'),(38,'ARAMBURU BARRENECHEA','JOSEBA','joseba.aramburu@ehu.eus'),(39,'ARANA LANDIN','GERMAN','g.arana@ehu.eus'),(40,'ARANA PEREZ','MARIA PILAR','pilar.arana@ehu.eus'),(41,'ARANDIA ALDALUR','ENDIKA','endika.arandia@ehu.eus'),(42,'ARANGUREN IZQUEAGA','AITZPEA','aitzpea.aranguren@ehu.es'),(43,'ARANJUELO MICHELENA','ALEJANDRO','alejandro.aranjuelo@ehu.eus'),(44,'ARANZABAL IRAETA','JOSEBA','joseba.aranzabal@ehu.eus'),(45,'ARANZABAL URIARTE','OIER','oier.aranzabal@ehu.es'),(46,'ARANZABE URRUZOLA','MARIA JESUS','maxux.aranzabe@ehu.es'),(47,'ARBELAIZ GARMENDIA','AITOR','aitor.arbelaiz@ehu.eus'),(48,'ARRAMBIDE GARCÍA','IÑAKI','inaki.arrambide@ehu.eus'),(49,'ARRATE BASABE','JON','jon.arrate@ehu.es'),(50,'ARRESE ARRATIBEL','AINHOA','ainhoa.arrese@ehu.eus'),(51,'ARRIETA CORTAJARENA','IERA','iera.arrieta@ehu.es'),(52,'ARRIZABALAGA ECHEVERRIA','ASIER','asier.arrizabalaga@ehu.eus'),(53,'ARRUABARRENA SANTOS','ROSA*','rosa.arruabarrena@ehu.es'),(54,'ARRUTI MARTINEZ','MARIA PUY','puy.arruti@ehu.eus'),(55,'ARRUTI RUIZ','OIHANA','oihana.arruti@ehu.es'),(56,'ARTETXE URIA','MAITE','maite.artetxe@ehu.es'),(57,'ARTOLA MENDIOLA','ION','ion.artola@ehu.es'),(58,'ARTUTXA BENGOETXEA','EIDER','eider.artutxa@ehu.es'),(59,'ASEGUINOLAZA BRAGA','IZASKUN','izaskun.aseguinolaza@ehu.es'),(60,'ASENSIO DE MIGUEL','FRANCISCO JAVIER','franciscojavier.asensio@ehu.es'),(61,'AZCARATE MUTILOA','IÑIGO','inigo.azcarate@ehu.eus'),(62,'AZCONA URIBE','LEIRE*','leire.azcona@ehu.es'),(63,'AZKORRA APRAIZ','XABIER','xabier.azkorra@ehu.es'),(64,'AZKUNA MENDIOLA','MIKEL','mikel.azkuna@ehu.es'),(65,'AZULA AURREKOETXEA','OIER','oier.azula@ehu.es'),(66,'AZULA AURREKOETXEA','OIER','oier.azula@ehu.es'),(67,'AZURZA ZUBIZARRETA','OLATZ','olatz.azurza@ehu.eus'),(68,'BANDRES UNANUE','LUIS MARIA','luismaria.bandres@ehu.es'),(69,'BARANDIARAN OLAETXEA','IRATI','irati.barandiaran@ehu.es'),(70,'BARO YUBERO','IZASKUN','izaskun.baro@ehu.eus'),(71,'BARRAGUES FUENTES','JOSE IGNACIO','joseignacio.barragues@ehu.eus'),(72,'BARRANCO RIVEROS','JOSE ENRIQUE','joseenrique.barranco@ehu.es'),(73,'BARRON RUIZ','MARIANO','mariano.barron@ehu.es'),(74,'BARROSO LAZARO','JAVIER','javier.barroso@ehu.es'),(75,'BARROSO MORENO','NORA','nora.barroso@ehu.eus'),(76,'BARRUTIETA BASURKO','XABIER*','xabier.barrutieta@ehu.eus'),(77,'BASAÑEZ LLANTADA','AITOR','aitor.basanez@ehu.es'),(78,'BASTERRECHEA LOZANO','MARIA','maria.basterrechea@ehu.es'),(79,'BAUDOIN -','SYLVAIN','sylvain.baudoin@ehu.eus'),(80,'BELL FERNANDEZ','OSKAR','oskar.bell@ehu.eus'),(81,'BERANOAGIRRE IMAZ','AITOR','aitor.beranoagirre@ehu.eus'),(82,'BERNAL CORTA','ENEKA','eneka.bernal@ehu.es'),(83,'BERRIDI AGUIRRE','ANDER','ander.berridi@ehu.es'),(84,'BLANCO ARANGUREN','JUAN MARIA','juanmaria.blanco@ehu.eus'),(85,'BLANCO MENOR','ANGEL','angel.blanco@ehu.eus'),(86,'BLANCO MIGUEL','MIREN','miren.blanco@ehu.es'),(87,'BRIZ BLANCO','ESTIBALIZ','estibaliz.briz@ehu.es'),(88,'BUENESTADO SIMON','DAVID*','david.buenestado@ehu.eus'),(89,'BUENO BERRIDI','ANE MIREN','anemiren.bueno@ehu.es'),(90,'CABALLER VIVES','MARIA CINTA','mariacinta.caballer@ehu.es'),(91,'CABEZAS ESCAÑO','JON MIKEL','jonmikel.cabezas@ehu.eus'),(92,'CABEZUDO MAESO','SARA','sara.cabezudo@ehu.eus'),(93,'CALVO CORREAS','TAMARA','tamara.calvo@ehu.eus'),(94,'CALVO SALOMON','PILAR MARIA','pilarmaria.calvo@ehu.eus'),(95,'CAMBLONG RUIZ','ARITZA','aritza.camblong@ehu.eus'),(96,'CANO GONZALEZ','LAIDA','laida.cano@ehu.eus'),(97,'CANTERA LOPEZ DE SILANES','MARIA ASUNCIÓN','asun.cantera@ehu.eus'),(98,'CANTONNET JORDI','MARIA LUISA','marialuisa.cantonnet@ehu.eus'),(99,'CANTONNET MENDIA','JOSE IGNACIO','cantonnet@infonegocio.com'),(100,'CARBAJAL DE LA RED','NEFTALI','neftali.carbajal@ehu.eus'),(101,'CARBAJAL GARCIA','AGUSTIN','agustin.carbajal@ehu.es'),(102,'CARBALLO BLANCO','TAMARA','tamara.carballo@ehu.es'),(103,'CARBALLO OSTOLAZA','DANIEL*','daniel.carballo@ehu.eus'),(104,'CARO CALZADA','JOSE EUGENIO*','joseeugenio.caro@ehu.eus'),(105,'CARRASCO HERNANDEZ','SHEYLA','sheyla.carrasco@ehu.eus'),(106,'CARTÓN GARCIA','BEATRIZ MARGARITA MARIA PILAR','beatriz.carton@ehu.eus'),(107,'CENDOYA SAINZ','FRANCISCO JAVIER','franciscojavier.cendoya@ehu.eus'),(108,'CHYZHYK ','OLEKSANDR','oleksandr.chyzhyk@ehu.eus'),(109,'CIRIZA EL CID','RAFAEL','rafael.ciriza@ehu.es'),(110,'CORCUERA MAESO','MARIA ANGELES','marian.corcuera@ehu.eus'),(111,'CORTE LEON','PAULA','paula.corte@ehu.eus'),(112,'CRESPO DE ANTONIO','MAITE','maite.crespo@ehu.eus'),(113,'CUADRADO VIANA','CARLOS','carlos.cuadrado@ehu.eus'),(114,'CUESTA CEJUDO','ALVARO','alvaro.cuesta@ehu.eus'),(115,'DAVILA RODRIGUEZ','IZASKUN','izaskun.davila@ehu.eus'),(116,'DE GRACIA INGELMO','JUAN','juan.degracia@ehu.es'),(117,'DE HOYOS MARTINEZ','PEDRO LUIS','pedroluis.dehoyos@ehu.eus'),(118,'DE LA CABA CIRIZA','MARIA CORO','koro.delacaba@ehu.eus'),(119,'DE LA FLOR MARTIN','GEMMA','gemma.delaflor@ehu.eus'),(120,'DE LOS FRAILES BAZ','FRANCISCO',''),(121,'DIAZ DE ILARRAZA ARAMBERRI','MIKEL*','mikel.diazdeilarraza@ehu.eus'),(122,'DIEZ GARCIA','IÑIGO','inigo.diez@ehu.eus'),(123,'DIEZ GARCIA','MARTA','marta.diezg@ehu.eus'),(124,'DÍEZ GORROCHATEGUI','BELÉN','belen.diez@ehu.eus'),(125,'DIEZ ORONOZ','ARITZ*','aritz.diez@ehu.eus'),(126,'DOMINGUEZ CARRASCOSO','MARIA LOURDES','marialourdes.dominguez@ehu.eus'),(127,'DOMINGUEZ CARRASCOSO','VICTORIANO','v.dominguez@ehu.eus'),(128,'DOVALE CARRION','MARIA DEL CARMEN','mariadelcarmen.dovale@ehu.eus'),(129,'ECEIZA MENDIGUREN','MARIA ARANZAZU','arantxa.eceiza@ehu.eus'),(130,'ECHARRI SABATIE','JOSE LUIS','joseluis.echarri@ehu.es'),(131,'ECHEGARAY LOPEZ','GORETTI*','goretti.echegaray@ehu.eus'),(132,'ECHEPARE ZUGASTI','RICARDO','ricardo.echepare@ehu.es'),(133,'EGÜES ARTOLA','ITZIAR','itziar.egues@ehu.eus'),(134,'EIZAGUIRRE IRIBAR','ARRITOKIETA','arritokieta.eizaguirre@ehu.eus'),(135,'ENPARANTZA AGIRRE','MIKEL','mikel.enparantza@ehu.es'),(136,'ERDOCIA IRIARTE','XABIER*','xabier.erdocia@ehu.eus'),(137,'ERREA LOPE','ION*','ion.errea@ehu.eus'),(138,'ESNAOLA ALDANONDO','GANIX','ganix.esnaola@ehu.eus'),(139,'ESPINOSA ','JUAN PABLO',''),(140,'ESTEBAN RODRIGUEZ','DAVID','david.esteban@ehu.eus'),(141,'ESTEVEZ SANZ','JULIAN','julian.estevez@ehu.eus'),(142,'ETXABE GUTIERREZ','ION','ion.etxabe@ehu.es'),(143,'ETXABIDE ETXEBERRIA','ALAITZ','alaitz.etxabide@ehu.eus'),(144,'ETXEBARRIA ELEZGARAI','JAIONE','jaione.etxebarria@ehu.eus'),(145,'ETXEBERRIA ALTUNA','HARITZ*','haritz.echeverria@ehu.eus'),(146,'ETXEBERRIA URKIA','AITOR','aitor.etxeberria@ehu.es'),(147,'EZEIZA RAMOS','AITZOL','aitzol.ezeiza@ehu.eus'),(148,'FERNANDEZ COBE','ANTXON','antxon.fernandez@ehu.eus'),(149,'FERNANDEZ D\'ARLAS BIDEGAIN','BORJA','borja.fernandezdarlas@ehu.es'),(150,'FERNANDEZ DE BETO','UNAI*','unai.fernandezdebetono@ehu.es'),(151,'FERNANDEZ GOMEZ DE SEGURA','ELSA','elsa.fernandez@ehu.eus'),(152,'FERNANDEZ LLANDERAS','XABIER','xabifernandez92@gmail.com'),(153,'FERNANDEZ MARIN','RUT','rut.fernandez@ehu.eus'),(154,'FERNANDEZ MARZO','FLORENCIO','florencio.fernandez@ehu.eus'),(155,'FERNANDEZ SALVADOR','RAQUEL','raquel.fernandez@ehu.eus'),(156,'FERNANDEZ SANCHEZ','PILAR','pilar.fernandez@ehu.eus'),(157,'FERNANDEZ VICENTE','OLGA*','olga.fernandez@ehu.eus'),(158,'FERREIRA SANCHEZ','MARIA MONTSERRAT','montse.ferreira@ehu.eus'),(159,'FUENTE DACAL','RAQUEL','raquel.fuente@ehu.eus'),(160,'GABILONDO LOPEZ','NAGORE','nagore.gabilondo@ehu.eus'),(161,'GAINZA BARRENCUA','JOSEBA*','joseba.gainza@ehu.eus'),(162,'GALARRAGA ASTIBIA','ROBERTO','roberto.galarraga@ehu.eus'),(163,'GARATE ZUBIAURRE','GORKA','gorka.garate@ehu.eus'),(164,'GARCÍA ANDUAGA','GUILLERMO LUIS','g.garcia@ehu.eus'),(165,'GARCÍA ASTRAIN','CLARA MARIA','clara.garcia@ehu.eus'),(166,'GARCÍA BAHILLO','MARIA ANGELES','mariaangeles.garciab@ehu.eus'),(167,'GARCIA LARRA','ARKAITZ','arkaitz.garcia@ehu.eus'),(168,'GARCÍA NUÑEZ','ARACELI','araceli.garcia@ehu.eus'),(169,'GARCÍA SANCHEZ','PEDRO MARIA','pedromaria.garcia@ehu.eus'),(170,'GARICANO OSINAGA','XABIER','xabier.garikano@ehu.eus'),(171,'GARITAONAINDIA ANTSOATEGI','UGUTZ','ugutz.garitaonaindia@ehu.eus'),(172,'GARMENDIA ANTIN','MADDI','maddi.garmendiaa@ehu.eus'),(173,'GARMENDIA AZURMENDI','IGNACIO','inaki.garmendia@ehu.eus'),(174,'GARMENDIA MUJICA','ASIER','asier.garmendia@ehu.eus'),(175,'GARMENDIA MUJIKA','MIKEL','mikel.garmendia@ehu.eus'),(176,'GARRIDO DIAZ','TANIA','tania.garrido@ehu.eus'),(177,'GASCON GASCON','VICENTE','vicente.gascon@ehu.eus'),(178,'GASPAR GARCÍA','BELEN','belen.gaspar@ehu.eus'),(179,'GOIKOETXEA MIRANDA','ESTIBALIZ','estibalitz.goikoetxea@ehu.eus'),(180,'GOMEZ ARRIARAN','IGNACIO SANTIAGO','gomez.arriaran@ehu.eus'),(181,'GOMEZ FERNANDEZ','SANDRA','sandra.gomez@ehu.eus'),(182,'GÓMEZ HERMOSO DE MENDOZA','JOSEBA',''),(183,'GONZALEZ ALRIOLS','MARIA','maria.gonzalez@ehu.eus'),(184,'GONZALEZ BEREZIARTUA','MADALEN','madalen.gbereziartua@ehu.eus'),(185,'GONZALEZ GURRUCHAGA','MIREN ITZIAR','itziar.gonzalez@ehu.eus'),(186,'GONZALEZ LEGARRETA','LORENA','lorena.gonzalez@ehu.eus'),(187,'GONZALEZ MUNDUATE','KIZKITZA','kizkitza.gonzalez@ehu.eus'),(188,'GORDOBIL GO','OIHANA','oihana.gordobil@ehu.eus'),(189,'GORROTXATEGUI SAN MARTIN','EUGENIO','eugenio.gorrochategui@ehu.eus'),(190,'GRATAL PEREZ','MARIA DEL CARMEN','mariacarmen.gratal@ehu.eus'),(191,'GRIJALBA ASEGUINOLAZA','OLATZ*','olatz.grijalba@ehu.eus'),(192,'GUARESTI LARREA','OLATZ','olatz.guaresti@ehu.eus'),(193,'GUERRERO MANSO','PEDRO MANUEL','pedromanuel.guerrero@ehu.eus'),(194,'GUISASOLA ARANZABAL','GENARO','jenaro.guisasola@ehu.eus'),(195,'GULLON ESTEVEZ','PATRICIA','patricia.gullon@ehu.eus'),(196,'GURRUCHAGA VAZQUEZ','JOSE MARIA','josemari.gurruchaga@ehu.es'),(197,'GURRUTXAGA GURRUTXAGA','ITZIAR','itziar.gurruchaga@ehu.eus'),(198,'GUTIERREZ CÁCERES\n','JUNCAL','juncal.gutierrez@ehu.eus'),(199,'GUTIERREZ DE ROZAS SALTERAIN','JOSE LORENZO','joselorenzo.gutierrezderozas@ehu.es'),(200,'HERNANDEZ LASA','ALFONSO','alfonso.hernandez@ehu.es'),(201,'HERNANDEZ RAMOS','FABIO','fabio.hernandez@ehu.eus'),(202,'HERRERA DIAZ','RENE ALEXANDER','renealexander.herrera@ehu.eus'),(203,'HIDALGO BETANZOS','JUAN MARIA','juanmaria.hidalgo@ehu.eus'),(204,'IBARRONDO MARTINEZ-ITURRALDE','IGNACIO','ignacio.ibarrondo@ehu.es'),(205,'ICETA ECHAVE','MARIA','maria.iceta@ehu.eus'),(206,'INSAUSTI BELLO','AIMAR','aimar.insausti@ehu.eus'),(207,'INSAUSTI IRASTORZA','NAGORE','nagore.insausti@ehu.eus'),(208,'IÑURRIETA URMENETA\n','USOA','usoa.inurrieta@ehu.eus'),(209,'IRADI ARTEAGA','JON','jon.iradi@ehu.eus'),(210,'IRISARRI ALLI','EDURNE','edurne.irisarri@ehu.eus'),(211,'ISASA GABILONDO','MIREN','miren.isasa@ehu.eus'),(212,'ITURRIAGA OÑARTE-ECHEVARRIA','LEIRE','leire.iturriaga@ehu.eus'),(213,'ITURRIOZ SANCHEZ','JON*','jon.iturrioz@ehu.eus'),(214,'IZAGIRRE KORTA','ANE','ane.izagirre@ehu.eus'),(215,'JAUREGI ODRIOZOLA','MIKEL','mikel.jauregi@ehu.eus'),(216,'JIMENEZ REDAL','RUBEN',''),(217,'JODRA LUQUE','JOSE LUIS','joseluis.jodra@ehu.eus'),(218,'KORTABERRIA ALTZERREKA','GALDER','galder.cortaberria@ehu.eus'),(219,'LABAYEN ESNAOLA','MIKEL','mikel.labayen@ehu.es'),(220,'LABIDI BOUCHRIKA','JALEL','jalel.labidi@ehu.eus'),(221,'LAMUEDRA GRAÑA','JOKIN','jokin.lamuedra@ehu.eus'),(222,'LANA RANZ','CELIA*','celia.lana@ehu.eus'),(223,'LARRAZA AROCENA','IZASKUN','izaskun.larraza@ehu.eus'),(224,'LARREA UNZAIN','AINARA','ainara.larrea@ehu.eus'),(225,'LASKURAIN ITURBE','IKER','iker.laskurain@ehu.eus'),(226,'LECETA LASA','ITSASO','itsaso.leceta@ehu.eus'),(227,'LEON CASCANTE','IÑIGO','inigo.leon@ehu.eus'),(228,'LIZUAIN LILLY','ION','ion.lizuain@ehu.eus'),(229,'LLANO-PONTE ALVAREZ','RODRIGO MANUEL','rodrigo.llano-ponte@ehu.eus'),(230,'LOPEZ DE IPIÑA PEÑA\n','KARMELE','karmele.ipina@ehu.eus'),(231,'LOPEZ JIMENEZ','FERNANDO','fernando.lopezj@ehu.es'),(232,'LOPEZ RUIZ','FRANCISCO','francisco.lopez@ehu.eus'),(233,'LORENZ MURO','FRANCISCO JAVIER','franciscojavier.lorenz@ehu.es'),(234,'LOZANO CHICO','MARIA','maria.lozano@ehu.eus'),(235,'LUENGAS CARREÑO\n','DANIEL*','daniel.luengas@ehu.eus'),(236,'MAIZA GALPARSORO','MIGUEL ANGEL','miguelangel.maiza@ehu.eus'),(237,'MANTEROLA ZABALA','MARIA JUNCAL','mariajuncal.manterola@ehu.eus'),(238,'MARIETA GORRITI','MARIA CRISTINA','cristina.marieta@ehu.eus'),(239,'MARTIN GARIN','ALEXANDER','alexander.martin@ehu.eus'),(240,'MARTINEZ AGIRREZABALAGA','EDITH',''),(241,'MARTINEZ AGUIRRE','MIREN ITSASO','mirenitsaso.martinez@ehu.eus'),(242,'MARTINEZ DE ALBENIZ AUSIN','AINARA','ainara.martinezdealbeniz@ehu.eus'),(243,'MARTINEZ DE LIZARDUY ST','UNAI','unai.martinezdelizarduy@ehu.eus'),(244,'MARTINEZ SALABERRIA','ASIER','asier.martinez@ehu.eus'),(245,'MAYOR MARTINEZ','AINGERU','aingeru.mayor@ehu.eus'),(246,'MAYORA ORIA','JOSU MIRENA','j.maiora@ehu.eus'),(247,'MILLAN GARCIA','JOSE ANTONIO','j.millan@ehu.eus'),(248,'MITXELENA HOYOS','OIHANA','oihana.mitxelena@ehu.eus'),(249,'MOLINA ALTUNA','JULIAN JOSE','julian.molina@ehu.eus'),(250,'MONASTERIO IRURETAGOYENA','ELENA','elena.monasterio@ehu.eus'),(251,'MONDRAGON EGAÑA','IÑAKI','inaki.mondragon@ehu.es'),(252,'MONDRAGON OTAMENDI','GURUTZ','gurutz.mondragon@ehu.eus'),(253,'MONGELOS OQUIÑENA','MARIA BELEN','belen.mongelos@ehu.es'),(254,'MONTALBAN SANCHEZ','JON','jon.montalban@ehu.eus'),(255,'MONTEJO UBILLOS','FERMIN','fermin.montejo@ehu.es'),(256,'MORA MARTIN','FERNANDO','fernando.mora@ehu.eus'),(257,'MORAIS EZQUERRO','ADOLFO','a.morais@ehu.eus'),(258,'MORALES MATIAS','AMAIA','amaia.morales@ehu.eus'),(259,'MORENO AROTZENA','OIHANA*','oihana.moreno@ehu.eus'),(260,'MORENO BAÑEZA','VICENTE','vicente.moreno@ehu.eus'),(261,'MOUJAHID MOUJAHID','ABDELMALIK','abdelmalik.moujahid@ehu.eus'),(262,'MUGURUZA ASEGUINOLAZA','BEÑAT','benat.muguruza@ehu.eus'),(263,'MUJIKA GARITANO','FAUSTINO','faustino.mujika@ehu.eus'),(264,'MUXIKA CARRION','ARRITXU','arritxu.muxika@ehu.eus'),(265,'NIETO LARRONDO','PEDRO','p.nieto@ehu.es'),(266,'NUÑEZ GONZALEZ','JOSE DAVID','josedavid.nunez@ehu.eus'),(267,'OCHOA LABURU','CARLOS','carlos.ochoa-laburu@ehu.eus'),(268,'OCHOANTESANA BERRIOZABALGOITIA','OIER','oier.otxoantesana@ehu.eus'),(269,'ODRIOZOLA MARITORENA','MOISES','moises.odriozola@ehu.eus'),(270,'ODRIOZOLA URBIETA','IÑIGO','inigo.odriozola@ehu.es'),(271,'OLANO ZUGASTI','ANDONI','andoni.olano@ehu.es'),(272,'OLASAGASTI AGUADO','ARANTXA','arantxa.olasagasti@ehu.eus'),(273,'ORIOZABALA BRIT','JOSE ANTONIO','joseantonio.oriozabala@ehu.eus'),(274,'ORUE MENDIZABAL','ANDER','ander.orue@ehu.eus'),(275,'OSA AMILIBIA','JUAN LUIS','j.osa@ehu.eus'),(276,'OSES ORBEGOZO','USUE','usue.oses@ehu.eus'),(277,'OSTOLAZA ZAMORA','JOSEBA XABIER','xabier.ostolaza@ehu.eus'),(278,'OTADUY ZUBIZARRETA','JUAN PEDRO','juanpedro.otaduy@ehu.eus'),(279,'OTAMENDI IRIZAR','IRATI','irati.otamendi@ehu.es'),(280,'OTAÑO ECHANIZ\n','MARIA LUISA','marialuisa.otano@ehu.es'),(281,'PARDO RUIZ','ELISA','elisa.pardo@ehu.es'),(282,'PELLEJERO SALABERRIA','IDOYA','idoya.pellejero@ehu.eus'),(283,'PEÑA RODRIGUEZ\n','CRISTINA','cristina.pr@ehu.eus'),(284,'PEÑALBA OTADUY\n','MIRIAM VICTORIA','miriam.penalba@ehu.eus'),(285,'PEREZ FERNANDEZ','TOMAS A.*','tomas.perez@ehu.eus'),(286,'PEREZ MANSO','ANGEL','angel.perez@ehu.eus'),(287,'PEREZ MARTINEZ','JOSE JAVIER*','josejavier.perez@ehu.eus'),(288,'PIKATZA ATXA','JUAN MANUEL*','jm.pikatza@ehu.eus'),(289,'PILDAIN SAINZ','IMANOL','imanol.pildain@ehu.eus'),(290,'PORCEL VALENZUELA','MARIA','maria.porcel@ehu.eus'),(291,'QUIJADA VAN DEN BERGHE','MARINA','marina.quijada@ehu.eus'),(292,'REMENTERIA RODRIGUEZ','JON','ion.rementeria@ehu.eus'),(293,'RETEGUI MINER','ALOÑA','alona.retegui@ehu.eus'),(294,'ROBLES BARRIOS','JOSE EDUARDO','joseeduardo.robles@ehu.eus'),(295,'RODRIGUEZ AGUIRREBENGOA','ALVARO','alvaro.rodriguez@ehu.es'),(296,'RODRIGUEZ ASEGUINOLAZA','JAVIER*','javier.rodriguezas@ehu.eus'),(297,'RODRIGUEZ PIERNA','ANGEL AGUSTIN','angelagustin.rodriguez@ehu.eus'),(298,'ROMERA AGUAYO','JESUS MARIA','jesusmaria.romera@ehu.es'),(299,'RUIZ FABRE','MONTSERRAT','mariamonserrat.ruiz@ehu.eus'),(300,'SADABA FERNANDEZ','JUAN ANTONIO*','juanantonio.sadaba@ehu.eus'),(301,'SAGARNA ARAMBURU','MAIALEN','maialen.sagarna@ehu.eus'),(302,'SALAVERRIA GARNACHO','ANGEL','angel.salaverria@ehu.es'),(303,'SALAZAR SALAZAR','JOSE LUIS','joseluis.salazar@ehu.es'),(304,'SALEGI GORROTXATEGI','MIREN','miren.salegi@ehu.eus'),(305,'SAN FRANCISCO LASA','AITOR','aitor.sanfrancisco@ehu.eus'),(306,'SANCHEZ AGRA','CRISTINA','cristina.sancheza@ehu.es'),(307,'SANCHEZ GUEREÑO\n','MAIALEN','maialen.sanchez@ehu.eus'),(308,'SANCHEZ LOSADA','JOSE MANUEL','josemanuel.sanchez@ehu.eus'),(309,'SANFELIU PARERA','MONTSERRAT','montserrat.sanfeliu@ehu.es'),(310,'SANTAMARIA ECHART','ARANTZAZU','arantzazu.santamaria@ehu.eus'),(311,'SANTOS CIRIQUIAIN','ROMAN','roman.santos@ehu.eus'),(312,'SARALEGI OTAMENDI','AINARA','ainara.saralegui@ehu.eus'),(313,'SARASOLA IÑIGUEZ','ANE','ane.sarasola@ehu.eus'),(314,'SARRIUGARTE ONAINDIA','PAULO','paulo.sarriugarte@ehu.eus'),(315,'SELLENS FERNANDEZ','ISABEL','isabel.sellens@ehu.eus'),(316,'SENDEROS LAKA','MARIA*','maria.senderos@ehu.eus'),(317,'SEPULVEDA IRASTORZA','JOEL','joel.sepulveda@ehu.es'),(318,'SEQUEIROS ECHEVERRIA','ANE','ane.sequeiros@ehu.eus'),(319,'SILLERO ORTIGOSA','LEYRE','leyre.sillero@ehu.eus'),(320,'SOLABERRIETA MENDEZ','ENEKO','eneko.solaberrieta@ehu.eus'),(321,'SOLOZABAL BERGARA','KEPA','kepa.solozabal@ehu.eus'),(322,'STEPIEN .','AGNIESZKA','agnieszkaurszula@ehu.es'),(323,'SUSPERREGUI BURGUETE','ANA','ana.susperregui@ehu.eus'),(324,'TALAAT FARAG IBRAHIM','AHMED','ahmed.talaatfarag@ehu.eus'),(325,'TAPIA OTAEGUI','GERARDO','gerardo.tapia@ehu.eus'),(326,'TAPIA OTAEGUI','MARIA ARANZAZU','arantxa.tapia@ehu.eus'),(327,'TELLERIA IMAZ','ANA','ana.telleria@ehu.es'),(328,'TERCJAK SLIWINSKA','AGNIESZKA','agnieszka.tercjaks@ehu.eus'),(329,'TOLARETXIPI TEJERÍA\n','IÑAKI','inaki.tolaretxipi@ehu.eus'),(330,'UGARTE SORALUCE','LORENA*','lorena.ugarte@ehu.eus'),(331,'UGARTEMENDIA DE LA IGLESIA','JUAN JOSE','juanjo.ugartemendia@ehu.eus'),(332,'URANGA GAMA','JONE','jone.uranga@ehu.eus'),(333,'URBICAIN PELAYO','GORKA','gorka.urbikain@ehu.eus'),(334,'URBINA MORENO','LEIRE','leire.urbina@ehu.eus'),(335,'URDANPILLETA LANDARIBAR','MARTA','marta.urdanpilleta@ehu.eus'),(336,'URIARTE IDIAZABAL','MAIDER','maider.uriarte@ehu.eus'),(337,'URIEN CRESPO','MIREN JOSUNE','mirenjosune.urien@ehu.eus'),(338,'URRUTIA DEL CAMPO','NAGORE','nagore.urrutia@ehu.eus'),(339,'URRUZOLA MORENO','JAVIER','javier.urruzola@ehu.eus'),(340,'URTASUN GONZALEZ','AITOR','aitor.urtasun@ehu.eus'),(341,'VAQUERO MARINO','JOSE AGUSTIN','joseagustin.vaquero@ehu.eus'),(342,'VARGAS SILVA','GUSTAVO ADOLFO','gustavo.vargas@ehu.eus'),(343,'YUSTA SAN VICENTE','CARLOS','carlos.yusta@ehu.es'),(344,'ZABALA GALARZA','MIREN JOSUNE','mirenjosune.zabala@ehu.eus'),(345,'ZALDUA CARAZO','NEREA','nerea.zaldua@ehu.eus'),(346,'ZARANDONA RODRIGUEZ','IRATXE','iratxe.zarandona@ehu.eus'),(347,'ZATARAIN GORDOA','MARIA ARANTZAZU','a.zatarain@ehu.eus'),(348,'ZHUKOV EGOROVA','ARKADY PAVLOVICH','arkadi.joukov@ehu.eus'),(349,'ZHUKOVA ZHUKOVA','VALENTINA','valentina.zhukova@ehu.eus'),(350,'ZIMNUKHOVA .','SVETLANA*','svetlana.zimnukhova@ehu.eus'),(351,'ZUBIA OLASKOAGA','ITZIAR','itziar.zubia@ehu.eus'),(352,'ZUBITUR SOROA','MARIA MANUELA','manuela.zubitur@ehu.eus'),(353,'ZUBIZARRETA IRURE','MIKEL','m.zubizarreta@ehu.eus'),(354,'ZUGASTI ALCORTA','IRAITZ','iraitz.zugasti@ehu.eus'),(355,'ZUZA ELOSEGI','KRISTINA','kristina.zuza@ehu.eus'),(356,'ZUZA ELOSEGUI','RAFAEL*','rafa.zuza@ehu.eus');
/*!40000 ALTER TABLE `politekniko2` ENABLE KEYS */;
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
INSERT INTO `programasDeIntercambio` VALUES (7,1,'fuera','Laboratoire d’Informatique de l’UPPA (LIUPPA)','Ikerketa','actividad','2017-09-01','2018-09-01','2018-03-08 15:38:06','2018-02-25 15:26:10',NULL),(11,1,'enCasa','Facultad de Ciencias. Universidad de Buenos Aires. Argentina','Ikerketa','Ikerketa','2016-01-26','2018-01-26','2018-03-08 15:38:11','2018-02-14 10:45:54',NULL);
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
INSERT INTO `proyectoInvestigacion` VALUES (23,1,'empresa','Formación del profesorado de la Escuela Universitaria de ingeniería Dual del IMH Instituto de Máquina Herramienta en metodologías activas de enseñanza','Formación del profesorado de la Escuela Universitaria de ingeniería Dual del IMH Instituto de Máquina Herramienta en metodologías activas de enseñanza','IMH Instituto de Máquina Herramienta, 4.941€; Contrato EUSKOIKER FR60223','2016-01-01','2017-01-01','2018-02-22 10:12:10','2018-02-14 10:35:56',NULL),(26,4,'europa','Smart Plug Prototype Manufacturing','Smart Plug Prototype Manufacturing','EIFER – European Institute For Energy Research','2016-10-01','2017-12-30','2018-03-08 12:43:52','2018-02-14 10:26:10',NULL),(27,1,'erakundeak','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','','2017-02-14','2018-02-14','2018-03-08 12:43:38','2018-02-14 10:27:33',NULL),(28,1,'erakundeak','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','Predicción de la Ampacidad de la Red Eléctrica a partir de las Predicciones Meteorológicas','','2017-02-14','2018-02-14','2018-03-08 12:43:34','2018-02-14 10:27:22',NULL),(29,1,'empresa','aa','ss','','2016-01-30','2018-03-07','2018-03-08 12:55:10','2018-02-14 10:31:51',NULL),(30,1,'empresa','bb','bb','','2017-04-15','2018-02-20','2018-03-08 12:55:14','2018-02-14 10:31:53',NULL),(31,1,'erakundeak','bb','bb','','2017-04-15','2018-02-20','2018-02-22 09:51:45','2018-02-14 10:31:54',NULL),(32,1,'europa','ggsdfgsfg','sfgsfdg','','2017-02-22','2018-02-28','2018-03-08 12:43:29','2018-02-25 12:13:26',NULL);
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
INSERT INTO `publicaciones` VALUES (4,1,'libros','liburua','LIBRO','editorial','1','','2018-02-11','2018-03-08 14:08:03','2018-02-14 10:38:54',NULL),(5,1,'articulos','Review of dynamic line rating systems for wind power integration','Review of dynamic line rating systems for wind power integration','Renewable & Sustainable Energy Reviews','','53','2018-01-01','2018-03-08 14:10:24','2018-02-14 10:39:45',NULL),(6,4,'libros','Libro de Comunicaciones IBERCONAPPICE 2016','Libro de Comunicaciones IBERCONAPPICE 2016','APPICE, Madrid','','','2016-01-01','2018-02-25 14:55:07','2018-02-14 10:38:50',NULL);
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
INSERT INTO `role_user` VALUES (1,1),(1,3),(1,4),(2,4),(3,4),(4,4),(5,4),(6,4),(7,4),(8,4),(9,4),(10,4),(11,4),(12,4),(13,4),(14,4),(15,4),(16,4),(17,4),(18,4),(19,4),(20,4),(21,4),(22,4),(23,4),(24,4),(25,4),(26,4),(27,4),(28,4),(29,4),(30,4),(31,4),(32,4),(33,4),(34,4),(35,4),(36,4),(37,4),(38,4),(39,4),(40,4),(41,4),(42,4),(43,4),(44,4),(45,4),(46,4),(47,4),(48,4),(49,4),(50,4),(51,4),(52,4),(53,4),(54,4),(55,4),(56,4),(57,4),(58,4),(59,4),(60,4),(61,4),(62,4),(63,4),(64,4),(65,4),(66,4),(67,4),(68,4),(69,4),(70,4),(71,4),(72,4),(73,4),(74,4),(75,4),(76,4),(77,4),(78,4),(79,4),(80,4),(81,4),(82,4),(83,4),(84,4),(85,4),(86,4),(87,4),(88,4),(89,4),(90,4),(91,4),(92,4),(93,4),(94,4),(95,4),(96,4),(97,4),(98,4),(99,4),(100,4),(101,4),(102,4),(103,4),(104,4),(105,4),(106,4),(107,4),(108,4),(109,4),(110,4),(111,4),(112,4),(113,4),(114,4),(115,4),(116,4),(117,4),(118,4),(119,4),(120,4),(121,4),(122,4),(123,4),(124,4),(125,4),(126,4),(127,4),(128,4),(129,4),(130,4),(131,4),(132,4),(133,4),(134,4),(135,4),(136,4),(137,4),(138,4),(139,4),(140,4),(141,4),(142,4),(143,4),(144,4),(145,4),(146,4),(147,4),(148,4),(149,4),(150,4),(151,4),(152,4),(153,4),(154,4),(155,4),(156,4),(157,4),(158,4),(159,4),(160,4),(161,4),(162,4),(163,4),(164,4),(165,4),(166,4),(167,4),(168,4),(169,4),(170,4),(171,4),(172,4),(173,4),(174,4),(175,4),(176,4),(177,4),(178,4),(179,4),(180,4),(181,4),(182,4),(183,4),(184,4),(185,4),(186,4),(187,4),(188,4),(189,4),(190,4),(191,4),(192,4),(193,4),(194,4),(195,4),(196,4),(197,4),(198,4),(199,4),(200,4),(201,4),(202,4),(203,4),(204,4),(205,4),(206,4),(207,4),(208,4),(209,4),(210,4),(211,4),(212,4),(213,4),(214,4),(215,4),(216,4),(217,4),(218,4),(219,4),(220,4),(221,4),(222,4),(223,4),(224,4),(225,4),(226,4),(227,4),(228,4),(229,4),(230,4),(231,4),(232,4),(233,4),(234,4),(235,4),(236,4),(237,4),(238,4),(239,4),(240,4),(241,4),(242,4),(243,4),(244,4),(245,4),(246,4),(247,4),(248,4),(249,4),(250,4),(251,4),(252,4),(253,4),(254,4),(255,4),(256,4),(257,4),(258,4),(259,4),(260,4),(261,4),(262,4),(263,4),(264,4),(265,4),(266,4),(267,4),(268,4),(269,4),(270,4),(271,4),(272,4),(273,4),(274,4),(275,4),(276,4),(277,4),(278,4),(279,4),(280,4),(281,4),(282,4),(283,4),(284,4),(285,4),(286,4),(287,4),(288,4),(289,4),(290,4),(291,4),(292,4),(293,4),(294,4),(295,4),(296,4),(297,4),(298,4),(299,4),(300,4),(301,4),(302,4),(303,4),(304,4),(305,4),(306,4),(307,4),(308,4),(309,4),(310,4),(311,4),(312,4),(313,4),(314,4),(315,4),(316,4),(317,4),(318,4),(319,4),(320,4),(321,4),(322,4),(323,4),(324,4),(325,4),(326,4),(327,4),(328,4),(329,4),(330,4),(331,4),(332,4),(333,4),(334,4),(335,4),(336,4),(337,4),(338,4),(339,4),(340,4),(341,4),(342,4),(343,4),(344,4),(345,4),(346,4),(347,4),(348,4),(349,4),(350,4),(351,4);
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
INSERT INTO `roles` VALUES (1,'owner','Project Owner','User is the owner of a given project','2017-02-21 10:35:01','2017-02-21 10:35:01'),(3,'admin','Administrator','Permiso para modificar profesorado','2017-02-21 10:36:17','2018-01-25 14:32:52'),(4,'profesor','Profesorado','Profesorado','2017-02-21 14:16:27','2018-01-12 12:02:13');
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
  `curso` year(4) DEFAULT NULL,
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
INSERT INTO `tesisDoctorales` VALUES (5,0,'tesisLeidas','aa','aa','aa','aa','2018-02-28',NULL,'2018-02-23 10:34:11','2018-02-14 10:25:20','2018-02-14 10:25:20'),(11,0,'tesisLeidas','lkj','bbaab','lkj','lkj','2018-02-28',NULL,'2018-02-14 10:25:22','2018-02-14 10:25:22','2018-02-14 10:25:22'),(12,0,'tesisLeidas','kj','dsaf','lkj','lkj','2018-02-09',NULL,'2018-02-14 10:25:23','2018-02-14 10:25:23','2018-02-14 10:25:23'),(13,9,'tesisLeidas','Readability assessment and automatic text simplification. The analysis of basque complex structures','Euskarazko egitura sintaktiko konplexuen analisirako eta testuen sinplifikazio automatikorako proposamena ','Arquitectura','Arquitectura','2017-10-18',NULL,'2018-03-08 11:18:29','2018-03-08 11:18:29',NULL),(15,4,'proximaLectura','Denbora errealeko monitorizazioa erabiliz, aireko línea elektrikoen portaeraren karakterizaziorako eta anpazitatearen kalkulurako metodología','Denbora errealeko monitorizazioa erabiliz, aireko línea elektrikoen portaeraren karakterizaziorako eta anpazitatearen kalkulurako metodología','Ingeniería Eléctrica','Ingeniería Eléctrica','2018-02-09',2017,'2018-03-08 09:40:02','2018-03-08 09:40:02',NULL),(17,1,'europa','asdf','asdf','adsf','adsf','2018-02-09',NULL,'2018-02-09 14:50:05','2018-02-09 14:50:05',NULL);
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
  KEY `id_autor` (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ldap','Unai','Susperregi','unai@irunweb.com','$2y$10$.C.S2IBsEYFDAMwwCyjTVOdZZIY8V1QxoU/eQTG/MHKyzCX8G0y4a',1,1,'eu','TGp5CkH9pXLTvfFjQCercCQYkHqfujsBbmTlVI2w8nPxpH9Md0wThcOaICao','2016-10-28 12:07:55','2018-03-12 08:20:52'),(2,'','Itziar','Adarraga Usabiaga','itziar.adarraga@ehu.eus','$2y$10$imxFIBdHpndTGdS1Zk1UGebXpq4VQ5XgPx19cUip0YINDvBFK.rMq',1,2,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(3,'','Naiara','Aginako Bengoa','naiara.aginako@ehu.eus','$2y$10$teHA.DBNkkouURVJqFXbrOxPHm0OApfeEYAO/4tfMhableEhgkMk2',1,3,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(4,'','Lore','Agirre Zipitria','lore.agirre@ehu.es','$2y$10$.XX/evf0wK0sconS5Gr6deQQk3.bjw2QDeMQR6dqfy51GmEdLLrgi',1,4,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(5,'','Lander','Agirregomezkorta Arriaga','lander.agirregomezkorta@ehu.es','$2y$10$dH1wKck/PL..cr6nmdsEW.zgYI/eoScIZFEzTZbTkk26YLR6n/IO.',1,5,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(6,'','Carlos Humberto','Aguerre Telleria','carloshumberto.aguerre@ehu.es','$2y$10$hr5OjCVMF4Fz1jh8lhhfHu5K.vGWUDshZDpq4T8oVQwcqj.wuLo2e',1,6,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(7,'','Pedro M','Aiestaran Matxinandiarena','pedromaria.aiestaran@ehu.eus','$2y$10$EOJ4mOEPfC0oxaB7CKYmCuxPrWJZqBert.Qs38q.2LkkLNl.UIrnS',1,7,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(8,'','Amadeo','Aizpurua Requero','amadeo.aizpurua@ehu.es','$2y$10$a61adNnKkxye45vQowLKC.aLlS0NpbRNfFrAg93CwY0yAhqEiFgyG',1,8,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(9,'','Mikel','Alberro Astarbe','mikel.alberro@ehu.eus','$2y$10$mdI1TqMWaqSA4df26BhiAewaejHshFFkwtAqFGR2OMHDOEnT1lhyW',1,9,'es',NULL,'2018-03-13 09:51:12','2018-03-13 09:51:12'),(10,'','Gorka','Alberro Eguilegor','gorka.alberro@ehu.eus','$2y$10$Ry6IO29FLjAs78caJV1OHujNcLydzbHAk.3D6rE8Z196Bh8NIpoOC',1,10,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(11,'','Jose Ignacio','Albisu Aparicio','inaki.albisu@ehu.eus','$2y$10$GtMGHUMHh99ueyondaxk.uvaqmrEP4nJH1b0rbY70zhzUnxjX4evK',1,11,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(12,'','Joaquin','Albisua Garmendia','joaquin.albisua@ehu.eus','$2y$10$E7ZDRj.d068qhsFfzMHmoeBvLzChWrVBDSVjG6tjaZjuMnHlkiQ5i',1,12,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(13,'','Maria Cristina','Alcalde Valverde','c.alcalde@ehu.eus','$2y$10$l2gmeyGN5MsuZR/VDHoyfe3Wr2LQl57fxAOzqh0WCDMPqrLebm0uu',1,13,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(14,'','Juan Carlos','Aldasoro Alustiza','juancarlos.aldasoro@ehu.eus','$2y$10$FFqPjozQDIVRat/jwx/bvuNsENt30NEFww3AT60.xV4Sfa3JhkHBi',1,14,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(15,'','Unai','Aldasoro Marcellan','unai.aldasoro@ehu.es','$2y$10$n1cYb5JI/a5EH14mp3mqVu1ZsOZ0MM9Q9/zMEma5IloN.Yst.6fEa',1,15,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(16,'','Iker','Aldazabal Angulo','iker.aldazabal@ehu.eus','$2y$10$QNZNYSV.mKvimMOoup.hQeZf0KvCHs6Ul6wPxBFq.Dj4BW7Q.WYcq',1,16,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(17,'','Iñigo','Aldazabal Mensa','ialdazabal@ehu.es','$2y$10$UpsF2KQlN.KEz/GVtsp24e6mIMSvpMuoD8nDuXSuofV54HXSw0Yoa',1,17,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(18,'','Izaskun','Aldezabal Roteta','izaskun.aldezabal@ehu.eus','$2y$10$It50FG/cqvOGu/vVqKjYCemWmPBGmRtJUed8AP0fyBdnsJnn3cHI6',1,18,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(19,'','Itxaso','Algar Petralanda','itxaso.algar@ehu.es','$2y$10$kgcKxE45bhQ24T.VIiR/J.aW29nOty1b9dMJccbYGEwYhQ1IHAZca',1,19,'es',NULL,'2018-03-13 09:51:13','2018-03-13 09:51:13'),(20,'','Usue','Aliende Urrutia','usue.aliende@ehu.es','$2y$10$JMxLCdZITnDL6yEAXSiYNOlMNpqulYhx0gotQX1QIJG5UC884esZC',1,20,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(21,'','Patxi','Alkorta Egiguren','patxi.alkorta@ehu.es','$2y$10$kc.qnYSWIbsgPIZGze0FBeOzkXn9YjYlYUPpdy17PNMc4KMNK2X32',1,21,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(22,'','Francisco Javier','Almandoz Berrondo','jabier.almandoz@ehu.eus','$2y$10$GOH2haxCDplAziYuj1oAceen2nwQv/h12S2NtS6Rh8hH6NC/7TNXe',1,22,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(23,'','Jose Edmundo','Alonso Arnedo','joseedmundo.alonso@ehu.es','$2y$10$UFbFJOv1IFtVxTdjaD3u2efCT.puRWKiWtVF88cfloo9QbISkipOy',1,23,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(24,'','Haritz','Altzibar Manterola','haritz.altzibar@ehu.es','$2y$10$sJ.47I.5uJ0joDKG04cxL.Jn6h89ucd71hzcRlaSQlCz4GwCdlZuW',1,24,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(25,'','Patricia','Alvarez De Arcaya Pidal','patricia.alvarez@ehu.es','$2y$10$pSF8wnGjDhepx4sc8qEYxuhFlmhVqbeTS6PzCe0TNg07RhjMX9lr.',1,25,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(26,'','Irantzu','Alvarez Gonzalez','irantzu.alvarez@ehu.es','$2y$10$vTQ9QEhScYfaB3x3CTnwGecsw7f.o5FDtcSQgIZdin9j/FepwkPyu',1,26,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(27,'','Jose Miguel','Andonegi Martinez','jm.andonegi@ehu.es','$2y$10$25rBoosQU.17zBla2hT1be8kHAZ8owWdlcPn7X9vHE8vBV5kMTrWK',1,27,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(28,'','Mireia','Andonegui San Martin','mireia.andonegui@ehu.eus','$2y$10$F5myu6HE92ILiptR1.V8KOOfRukKmiA385n2ESKdH/SD/qhXFUGpi',1,28,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(29,'','Maria  Angeles','Andres Sanchez','marian.andres@ehu.eus','$2y$10$ae5MGJpGGY53R3mT4UPQguo1KmTkLmU/NYQB9CuWnBvd0Q6T//m72',1,29,'es',NULL,'2018-03-13 09:51:14','2018-03-13 09:51:14'),(30,'','Olatz','Ansa Osteriz','olatz.ansa@ehu.eus','$2y$10$lNe3vYW8w8DqHY/yiv2b6uRS2/XF4.RqCLN.fa6vxHEu6EbNz/yh6',1,30,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(31,'','Mikel','Antoñana Otaño','mikel.antonana@ehu.eus','$2y$10$qdekObej.lAYMRnjFoVk2OKf2JegToTviy9pUZqNNiSaLOVSMa4ZS',1,31,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(32,'','Estibaliz','Apiñaniz Fernandez De Larrinoa','estibaliz.apinaniz@ehu.es','$2y$10$0Lnmnc0rlNOh3qqa1e8ry.QIaGYVGCBmtnINW0jVSxEYJ0Vu1YYQW',1,32,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(33,'','Jone','Apraiz Iza','jone.apraiz@ehu..es','$2y$10$rIiwtoFvyfCBI1fFo/Vim.7d2yoDJDN24zbYSybLasQiVibsuk//a',1,33,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(34,'','Maria Purisima','Aragoneses Errasti','mariapurisima.aragoneses@ehu.eus','$2y$10$pqV5J1MhuRv2c2nFx8sLjuJHl1f7r87Juz8j7eMzw1BoN9WB8Wj6y',1,34,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(35,'','Maria Guadalupe','Aragoneses Errasti','mariaguadalupe.aragoneses@ehu.eus','$2y$10$DHAcrpXBldPXACd/2c7u6.P3WUSVdY692da6idhobY35.jQu/8rra',1,35,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(36,'','Edurne','Arakistain Jauregi','edurne.arakistain@ehu.es','$2y$10$o53QSlo2VJdr9YNhUoh88um6WlEAVIbKlgMr1.jFKNveFN1jTqdOu',1,36,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(37,'','Ainhoa','Arambarri Andueza','ainhoa.arambarri@ehu.eus','$2y$10$t2gIF/83rozz7idQ39QMEOdPx/Xb/tkeduNh.C0fYHAmCWQrCQz6S',1,37,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(38,'','Ioseba','Aramburu Ayerbe','ioseba.aranburu@ehu.eus','$2y$10$MZIOwpbDSmJJEqU9rzfcNeRmlBTwE6oMxpzePkE9dckwC.PBCP0hi',1,38,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(39,'','Joseba','Aramburu Barrenechea','joseba.aramburu@ehu.eus','$2y$10$5kxW9AN2wdBepNgK2HlIvOfD8lEo1G6D4RFE1KrJUEoZF2DVD96Se',1,39,'es',NULL,'2018-03-13 09:51:15','2018-03-13 09:51:15'),(40,'','German','Arana Landin','g.arana@ehu.eus','$2y$10$OU0TA9qU20BXeHDiRc7e8ugvGy30VjVuQQxDYDsazT/ivjDcveQUu',1,40,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(41,'','Maria Pilar','Arana Perez','pilar.arana@ehu.eus','$2y$10$RbweUGK9tQ5AmAcUrVlRdu6yxzABEsxOI4qANidJbx2IiSJJWo7NS',1,41,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(42,'','Endika','Arandia Aldalur','endika.arandia@ehu.eus','$2y$10$dLK6xj5aBKpNdX1D8/aIf.oglBT6WUq6KaUEjlCP7ZZO7QNqQ4giW',1,42,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(43,'','Aitzpea','Aranguren Izqueaga','aitzpea.aranguren@ehu.es','$2y$10$zNH6WvtuvslvH8gjySjfjO9b5do6HD.VbJKPkqp7G6nQWfHqrDM.O',1,43,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(44,'','Alejandro','Aranjuelo Michelena','alejandro.aranjuelo@ehu.eus','$2y$10$I7WDOn5TYq/G0XMa7wj5XuSciXacFpXz.7A56PhnWoG8v5RV14B3W',1,44,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(45,'','Joseba','Aranzabal Iraeta','joseba.aranzabal@ehu.eus','$2y$10$SafZ44o6bhdMTt6VMpYbguoRVov.OWR9QF.EObGOm7khQizkD3i2S',1,45,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(46,'','Oier','Aranzabal Uriarte','oier.aranzabal@ehu.es','$2y$10$icHvnO.K.wITqXdXq75vq.rJNyQL2/7VOj/.ZwAu6jFDh79W1yFLS',1,46,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(47,'','Maria Jesus','Aranzabe Urruzola','maxux.aranzabe@ehu.es','$2y$10$70dRiiJe/IgdikB51.YEjeBnHjfhNWqB94Ns9/jSo71QVkFR2K1Ne',1,47,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(48,'','Aitor','Arbelaiz Garmendia','aitor.arbelaiz@ehu.eus','$2y$10$ALJqO5ndEw9MCzFeHMz9BO1bqjb7AoVdQt8gQVo55iSbAzfy1RxJG',1,48,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(49,'','Iñaki','Arrambide García','inaki.arrambide@ehu.eus','$2y$10$bWHvmbuJWqMVB8ltpP6Jz.n9tXhNIScGj24ckhrlou1F6/my2fw92',1,49,'es',NULL,'2018-03-13 09:51:16','2018-03-13 09:51:16'),(50,'','Jon','Arrate Basabe','jon.arrate@ehu.es','$2y$10$IBF.q.n4P3jl2VWtiq6GaOlNSkuFZJ10ZHpc4UabZr7Uhr7c551Ei',1,50,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(51,'','Ainhoa','Arrese Arratibel','ainhoa.arrese@ehu.eus','$2y$10$mS0ZkFOoR3gbkaI49AkiEudNOszRH7BBytHUN/1yTOS7PbuRH7Oda',1,51,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(52,'','Iera','Arrieta Cortajarena','iera.arrieta@ehu.es','$2y$10$dZktasPpkoaVM524zNyZ/uAmJrploHCXhfcGwCQBRXJDuHjtLXw1K',1,52,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(53,'','Asier','Arrizabalaga Echeverria','asier.arrizabalaga@ehu.eus','$2y$10$QKa6EflSqOnNGanQUSyN/.9n2rGnszVmTDa2gngxX6MBa.duXLCU2',1,53,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(54,'','Rosa','Arruabarrena Santos','rosa.arruabarrena@ehu.es','$2y$10$h.LNRjpm.WraWXCrDS7aCO9RqU2ELLy865Yc6iB6ho8ePuv.M6rmO',1,54,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(55,'','Maria Puy','Arruti Martinez','puy.arruti@ehu.eus','$2y$10$O7QjajpDB5cePw/g/HRlz.LGwpD9UBP5RV/ZE9CgxB/3KWoSMJ3zq',1,55,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(56,'','Oihana','Arruti Ruiz','oihana.arruti@ehu.es','$2y$10$eBQlWmVCoJO.VhOkLTGZrOYlxfgW/SKTvNRYg368ONn68xDhnEt1e',1,56,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(57,'','Maite','Artetxe Uria','maite.artetxe@ehu.es','$2y$10$NInT9vse2jqZrIPgLJ67aekV5kZTpQEocBvJbOH.GudpfyI0R7GoW',1,57,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(58,'','Ion','Artola Mendiola','ion.artola@ehu.es','$2y$10$tluDB1ez.C8CWonx9X4/gur6JjOex0TipH4JvK164nMNYPE3MefFG',1,58,'es',NULL,'2018-03-13 09:51:17','2018-03-13 09:51:17'),(59,'','Eider','Artutxa Bengoetxea','eider.artutxa@ehu.es','$2y$10$8Oc0oOlZQI1daGNLhwVLg.zgS05kcYMXqkbclTxU4jCQhK5/oI0x6',1,59,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(60,'','Izaskun','Aseguinolaza Braga','izaskun.aseguinolaza@ehu.es','$2y$10$m1L3x1S5YFlB75G3MMSffebe1BV/xDogTPQIz0l9OeZoERYLtSaB2',1,60,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(61,'','Francisco Javier','Asensio De Miguel','franciscojavier.asensio@ehu.es','$2y$10$GjBAhEk62ePz3FkkxGQ2AOIxN/fYC0X1RAYS5O7teyz/WiGi.dfAq',1,61,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(62,'','Iñigo','Azcarate Mutiloa','inigo.azcarate@ehu.eus','$2y$10$3oDdqGU0sAqWMb/y.DJNn.DfDg1.88tkk4mBm.w7cnP5nzmCr8SuS',1,62,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(63,'','Leire','Azcona Uribe','leire.azcona@ehu.es','$2y$10$7W5LkiGwSSA5wc1K0N1O4OlMuVAmpO8K/JJhRbSaUN4.WFcT18wEa',1,63,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(64,'','Xabier','Azkorra Apraiz','xabier.azkorra@ehu.es','$2y$10$9M2sVQ/JtwntG1tJuQplq.SrKRfa7gLCVmI1rfyh0a7Wb1gYEpVPi',1,64,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(65,'','Mikel','Azkuna Mendiola','mikel.azkuna@ehu.es','$2y$10$IMmImVMcpTdDvJMmYXzDbuld/MJE3a2hF.bxgi/zSyn9oYj5vhhnS',1,65,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(66,'','Oier','Azula Aurrekoetxea','oier.azula@ehu.es','$2y$10$cc5Wc9FzHTYLHR3NVM983OPqWaTZ9zvXSPDVQYafPWSzBx4ju4ZOa',1,66,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(67,'','Olatz','Azurza Zubizarreta','olatz.azurza@ehu.eus','$2y$10$GmxvGKgWSy7aucU9Imj/dehGIH69dLQeVtR/FwYOIvHurTYC1uzu6',1,67,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(68,'','Luis Maria','Bandres Unanue','luismaria.bandres@ehu.es','$2y$10$SBxWRBzVbqvd/L0DconDNO6GJ1sTvskvTzWQV3Ht4hkoCdKRaD.bW',1,68,'es',NULL,'2018-03-13 09:51:18','2018-03-13 09:51:18'),(69,'','Irati','Barandiaran Olaetxea','irati.barandiaran@ehu.es','$2y$10$AwH5ZfVczBHSyo5UNfXQ5OthnuoW1WCqUr32FbcA2mxN8IZPzh9PC',1,69,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(70,'','Izaskun','Baro Yubero','izaskun.baro@ehu.eus','$2y$10$YC5sNICw2Q47TNBJoXgO8uaAgewrKwTxo761pRhbVOg0yMsb7CBdq',1,70,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(71,'','Jose Ignacio','Barragues Fuentes','joseignacio.barragues@ehu.eus','$2y$10$kdcdz.OX2wP/W616XK3nl.f5fTuk4.C8pu0rc2nBz3Z3YiEg5xuHe',1,71,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(72,'','Jose Enrique','Barranco Riveros','joseenrique.barranco@ehu.es','$2y$10$XgRzku9bEke85HDzlFCix.LfvgJZqbj5v93PeaCfFEZ/MEKeAL.4.',1,72,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(73,'','Mariano','Barron Ruiz','mariano.barron@ehu.es','$2y$10$07bt.kP174SI88MJFNRWs.8UZtIR50Q1e5T7z.QtAQOa4yYTtSHwq',1,73,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(74,'','Javier','Barroso Lazaro','javier.barroso@ehu.es','$2y$10$BGbXWLTybqrYUHzIAo5sDey84Pro41cg4A2IcwLT0CMDSGZ15hiJi',1,74,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(75,'','Nora','Barroso Moreno','nora.barroso@ehu.eus','$2y$10$BqObPEemX/Z8uJ/4lEtEyusRoNwdybyvaeCev840zVdgbU2Y7neQW',1,75,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(76,'','Xabier','Barrutieta Basurko','xabier.barrutieta@ehu.eus','$2y$10$HsGgd4Vm99xvWcC06SbBO.d7Fc1c9C6EQBdpEDspyiZV5l9ku4PYm',1,76,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(77,'','Aitor','Basañez Llantada','aitor.basanez@ehu.es','$2y$10$DTF6S.YT8y8wtxuREAydguUtJ/jRMRUDWVoTQWjoci./GRqc8xP8a',1,77,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:19'),(78,'','Maria','Basterrechea Lozano','maria.basterrechea@ehu.es','$2y$10$W/aI.BXquIJsvsXC6kOyGeNH5.R7WtqpxAc9ycDR3j6d0zAM2L0YS',1,78,'es',NULL,'2018-03-13 09:51:19','2018-03-13 09:51:20'),(79,'','Sylvain','Baudoin -','sylvain.baudoin@ehu.eus','$2y$10$0BSw47me6lGFoZxbJu5NwOdb5SraHdRpdwa4ckveYKXeSuWprtxFa',1,79,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(80,'','Oskar','Bell Fernandez','oskar.bell@ehu.eus','$2y$10$levnV/izz27yvMbGvbEaA.ukCMa5hKRm1a9g/OxGhNYqNl.8zmc6W',1,80,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(81,'','Aitor','Beranoagirre Imaz','aitor.beranoagirre@ehu.eus','$2y$10$/EqMdxS4xDgoW6MujSs2f.Y9vAi6/1KDUk7EOClJgkRKjVC2l0YAO',1,81,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(82,'','Eneka','Bernal Corta','eneka.bernal@ehu.es','$2y$10$ndv21yAxEwZgfswqTSq3Le8pLgIxyMpPN/c1fHbRZue8Fj.v5fNRu',1,82,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(83,'','Ander','Berridi Aguirre','ander.berridi@ehu.es','$2y$10$FtTLpYRl1mQMfnFHWJPC5uov25RSlXplgeU15SnC86rpxGLzh2j9a',1,83,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(84,'','Juan Maria','Blanco Aranguren','juanmaria.blanco@ehu.eus','$2y$10$5Z/OfIBmhdKgIhuSBFI9duoDsk/kHcsCfW.pMuETId7aiAfhYyxM.',1,84,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(85,'','Angel','Blanco Menor','angel.blanco@ehu.eus','$2y$10$UIu6a8fLuEx6oo7Fwhzh1.s7Vqfan6dwJ1RNJSDUqFQ9filIPfVOa',1,85,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(86,'','Miren','Blanco Miguel','miren.blanco@ehu.es','$2y$10$8FKruynSaLoQxXpRCtxqyeLn3W730EFTdpaywCO1SHFABidr7x27m',1,86,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(87,'','Estibaliz','Briz Blanco','estibaliz.briz@ehu.es','$2y$10$9FXevhqjYHqMIttPgsqSNOrKKGT6sE910eZrmK85RvwcXuB48Iizy',1,87,'es',NULL,'2018-03-13 09:51:20','2018-03-13 09:51:20'),(88,'','David','Buenestado Simon','david.buenestado@ehu.eus','$2y$10$hsMu9xzQgaCNIy6VIsKAXOE2RrMfO/cQBTHQCPfOWzI/VGwyvDWzC',1,88,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(89,'','Ane Miren','Bueno Berridi','anemiren.bueno@ehu.es','$2y$10$1Xuqhy63.hf.ubsgWUnEzuZAnSbo8r/FHfSTQYnpRoxYzlD83kvGq',1,89,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(90,'','Maria Cinta','Caballer Vives','mariacinta.caballer@ehu.es','$2y$10$tx00PAdjK.hRiR9aoVWp/.L3Rf4h2phCKmAekL4WZ.A.KwL/EEObW',1,90,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(91,'','Jon Mikel','Cabezas Escaño','jonmikel.cabezas@ehu.eus','$2y$10$IgyR0FDc8FZJ5k0xfZwAKeIo0/Eas9f7wU0nRtI4dYjUZ.xVvC5AO',1,91,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(92,'','Sara','Cabezudo Maeso','sara.cabezudo@ehu.eus','$2y$10$Rr0fgUbYp/vmcKozUyoit.GRc9bPvL.k.02ACgHK4cHHcZ7Ia/nnq',1,92,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(93,'','Tamara','Calvo Correas','tamara.calvo@ehu.eus','$2y$10$og9zx/yydXeVW9RYBKQIlO8ns.KW0v31SBuVUQeBYszYeWoeiGgqa',1,93,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(94,'','Pilar Maria','Calvo Salomon','pilarmaria.calvo@ehu.eus','$2y$10$vdOS8CiPzDOAbS2RVnc4XeVpqugme8SQs2KJUjun38ZklfT.zoq3C',1,94,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(95,'','Aritza','Camblong Ruiz','aritza.camblong@ehu.eus','$2y$10$xrUWQRyKlyimywKEDdbR2eScPJHNucebVn5KMQR9fj/4usRwvMpf.',1,95,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(96,'','Laida','Cano Gonzalez','laida.cano@ehu.eus','$2y$10$PcYhmdW7unLtHqZM9/5UtOTw.vN/rg9b.sj0mXPz4X4k2HZahqtvO',1,96,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(97,'','Maria Asunción','Cantera Lopez De Silanes','asun.cantera@ehu.eus','$2y$10$HPZiovkNFdJd3CIB/0M7COH.7/VbhDiQxnXDUJ0r3/tXJ81hQosmC',1,97,'es',NULL,'2018-03-13 09:51:21','2018-03-13 09:51:21'),(98,'','Maria Luisa','Cantonnet Jordi','marialuisa.cantonnet@ehu.eus','$2y$10$jCATqZRoMF/F4WPhdbNqDuX9/nfxSSDiabXNooZmlT.GTLy6ig0qK',1,98,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(99,'','Jose Ignacio','Cantonnet Mendia','cantonnet@infonegocio.com','$2y$10$mMFdbKfX9D9hS2tX9u.izu7MuorWE13V3ifO011rh0iVGydDlDqp.',1,99,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(100,'','Neftali','Carbajal De La Red','neftali.carbajal@ehu.eus','$2y$10$Qn8sLfm1OyBmtTHj6o7DSe8tAtycCDF.bifakQiLisZYPaWEP5c3u',1,100,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(101,'','Agustin','Carbajal Garcia','agustin.carbajal@ehu.es','$2y$10$1naMXmR/LD2odDxeNL7a4OF.x741wZqMCLoTloxVt.fYUM8p04FjG',1,101,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(102,'','Tamara','Carballo Blanco','tamara.carballo@ehu.es','$2y$10$DO6uaSQPK8f9uGXb1BvX/u1gqb4HjwywEdU1kO0/EMDKdUgO2xBo2',1,102,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(103,'','Daniel','Carballo Ostolaza','daniel.carballo@ehu.eus','$2y$10$HgRM4sMTP9ajZITQzhNVhOqEyBo/qOgsj4U52p/N0qy1jvvURJuKi',1,103,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(104,'','Jose Eugenio','Caro Calzada','joseeugenio.caro@ehu.eus','$2y$10$9./BiHAL/jwvQAcjlsLc4u73okIve0q8YnHjsAUli1JlemBms94Me',1,104,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(105,'','Sheyla','Carrasco Hernandez','sheyla.carrasco@ehu.eus','$2y$10$.uNaMBqQwa/JCbfHcmkfOu07C7.ZUn19LjG0Xed/etsQX10uHV1lq',1,105,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(106,'','Beatriz Margarita Maria Pilar','Cartón Garcia','beatriz.carton@ehu.eus','$2y$10$SRq1.sPQeK0JjgrZMCrGlOkj.835Dcy.Ga97/ykGyLNqinIfaZf16',1,106,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(107,'','Francisco Javier','Cendoya Sainz','franciscojavier.cendoya@ehu.eus','$2y$10$ycvarUm8VgU.lQCFpYRpNObd8cq9pU2iN6qyr6BG43X9Yzj/u/n/i',1,107,'es',NULL,'2018-03-13 09:51:22','2018-03-13 09:51:22'),(108,'','Oleksandr','Chyzhyk','oleksandr.chyzhyk@ehu.eus','$2y$10$aPPFD8m4bHtosMNOA3VUQu/P/VIzz81dvsqdNNYe8tzoe5C1mHErS',1,108,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(109,'','Rafael','Ciriza El Cid','rafael.ciriza@ehu.es','$2y$10$/DB9jb4kmf3BfumdO2qohuBO2MXCUliBw2/9TGP1gthRZS9kcgBmO',1,109,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(110,'','Maria Angeles','Corcuera Maeso','marian.corcuera@ehu.eus','$2y$10$yktM2ErjL5qMk3fEutv.Tej6mYtfe8bgukxnKjUWHrAs0S1hixNzi',1,110,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(111,'','Paula','Corte Leon','paula.corte@ehu.eus','$2y$10$gAx5LmOr77tXQclijvrVj.VBohPDNlx/Rkx5IEA57r5ef2fI9GHQW',1,111,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(112,'','Maite','Crespo De Antonio','maite.crespo@ehu.eus','$2y$10$8PMaANV/b4ooLDQjJ62KjuSCwKnEIwhCTJBChSg7N7HkCqIo6/nd6',1,112,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(113,'','Carlos','Cuadrado Viana','carlos.cuadrado@ehu.eus','$2y$10$MLyeubClU4ZNKdOBE4Typ.wJ.rCtltr8owbPPwBPjvRSM8IuJlhHG',1,113,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(114,'','Alvaro','Cuesta Cejudo','alvaro.cuesta@ehu.eus','$2y$10$riEpFS8RLqEyKkMcPAE5Zu9dq7EVGIic8M8/FwpZoF/LT7Yl0R.GW',1,114,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(115,'','Izaskun','Davila Rodriguez','izaskun.davila@ehu.eus','$2y$10$xhKMzFmhep5FTUZdFc16De.sD5wGY1nGx0vP52swiIWUUcUwWsanm',1,115,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(116,'','Juan','De Gracia Ingelmo','juan.degracia@ehu.es','$2y$10$SShwGsW4fJOdn6iC7zPTqeuCkzK/ilDHf3nDNZLh/E.mSj6tu1gZa',1,116,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:23'),(117,'','Pedro Luis','De Hoyos Martinez','pedroluis.dehoyos@ehu.eus','$2y$10$jZkNWjvZMbOXyQwPWy9PP.uDA3ARCvBNKh2JhEpPx7QlYwi1wgcH2',1,117,'es',NULL,'2018-03-13 09:51:23','2018-03-13 09:51:24'),(118,'','Maria Coro','De La Caba Ciriza','koro.delacaba@ehu.eus','$2y$10$RWZ1sFUKahyQ0dw373enP.d8kgEwx91qzzeDpz7D3KBBxzLAhB..O',1,118,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(119,'','Gemma','De La Flor Martin','gemma.delaflor@ehu.eus','$2y$10$l.k5xgiICYUhmJfEXjf7NuYuhXYMDTgh7h8qKVxJmi4izYCZOtKDS',1,119,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(120,'','Mikel','Diaz De Ilarraza Aramberri','mikel.diazdeilarraza@ehu.eus','$2y$10$QEsmLpa4GP8YCBsz7xBdzei.BKXr/kUK3i.Htnwu2NKPIPbgqLnD.',1,120,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(121,'','Iñigo','Diez Garcia','inigo.diez@ehu.eus','$2y$10$K97kvyxET6uhL7/nzLYXZ.I4QrUk9rv63DYEQ7DeQYRENZowu33Gi',1,121,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(122,'','Marta','Diez Garcia','marta.diezg@ehu.eus','$2y$10$o3m0dkwmmqxyc.5OH9wksOEnhtAI9KR38IK40pae6MejFccej47yq',1,122,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(123,'','Belén','Díez Gorrochategui','belen.diez@ehu.eus','$2y$10$YAcZzi6E2gKmrys7amoKDOo6cRpb66rk9We2A04zKpDUkPfdytmne',1,123,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(124,'','Aritz','Diez Oronoz','aritz.diez@ehu.eus','$2y$10$UPrmG9WdMrZcW9GmhRlYSOzfDAazxvy2KSwaJbeJov9dcPYo0LGS2',1,124,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(125,'','Maria Lourdes','Dominguez Carrascoso','marialourdes.dominguez@ehu.eus','$2y$10$bZBcOiBH03Rbl8btRqaOF.moCLVaUaIoEoPHq75miXPc/Fot.Y9uq',1,125,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(126,'','Victoriano','Dominguez Carrascoso','v.dominguez@ehu.eus','$2y$10$9QHXc8c5bqkDSS.dd2uS1e1lbz6FJ3X92C.PDEERXD.yXngWb85Ae',1,126,'es',NULL,'2018-03-13 09:51:24','2018-03-13 09:51:24'),(127,'','Maria Del Carmen','Dovale Carrion','mariadelcarmen.dovale@ehu.eus','$2y$10$lz/I02zMRCEH4UbM/D4.i.iZJqu4JwTVi1KypwRYPoioLioo6tyMm',1,127,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(128,'','Maria Aranzazu','Eceiza Mendiguren','arantxa.eceiza@ehu.eus','$2y$10$OL8VuXhNfuTpKDycrOXowurzX7H5v6Yf34PUPu6o5gxhAsYRplsV2',1,128,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(129,'','Jose Luis','Echarri Sabatie','joseluis.echarri@ehu.es','$2y$10$tUiQpMzd0lwJ.Wungi1GHu3RmxaX0yUhJI1O3k2A32nyck7GgQxBq',1,129,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(130,'','Goretti','Echegaray Lopez','goretti.echegaray@ehu.eus','$2y$10$9zr6KWXgW0u39EPfosCMSupRICL/Efcu.W3Empsq5CENwbjxVT2p2',1,130,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(131,'','Ricardo','Echepare Zugasti','ricardo.echepare@ehu.es','$2y$10$HUZlbDY.4ci6pnQWtYOJG.STHT.2bH1F6oxv8Q0YuBGShwrWMmbYm',1,131,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(132,'','Itziar','Egües Artola','itziar.egues@ehu.eus','$2y$10$NgwMBvThXbaZney0QijNHekbfjLu72WaSQq7fkU.7nat5qWDX1OJW',1,132,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(133,'','Arritokieta','Eizaguirre Iribar','arritokieta.eizaguirre@ehu.eus','$2y$10$r3QVbr6lov.QxWI4YLH1bObQyekaQFwNXMJG.ZTSCzUUKSTfhJ74W',1,133,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(134,'','Mikel','Enparantza Agirre','mikel.enparantza@ehu.es','$2y$10$xH1Th6RVOKWG.seL5KozoeeJ3eFkRKc9rN15m0trsFRZQ5SMZlpwa',1,134,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(135,'','Xabier','Erdocia Iriarte','xabier.erdocia@ehu.eus','$2y$10$hw/T4rxZhMGS0bF5rODX6.RqU92BuH2H8jncd0aCFor/tPfwJ5hdq',1,135,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(136,'','Ion','Errea Lope','ion.errea@ehu.eus','$2y$10$72ytmp29DJmC84mlUU7/Kuz4lHCK0kA76kFnp4onceEN5fDygh1.u',1,136,'es',NULL,'2018-03-13 09:51:25','2018-03-13 09:51:25'),(137,'','Ganix','Esnaola Aldanondo','ganix.esnaola@ehu.eus','$2y$10$0iTE7PZGtih7gfsm2RMv/.8d5EKb/3IG053Sciysqlx11s.B0GZxi',1,137,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(138,'','David','Esteban Rodriguez','david.esteban@ehu.eus','$2y$10$tHDpJHtcPZS1tz59AgXYfuRqajqMOWsgz/ZmvQAZLUXjwLhmqW8sG',1,138,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(139,'','Julian','Estevez Sanz','julian.estevez@ehu.eus','$2y$10$BKlZSrSUPY0At0.as5bVkukJ.aLc0lfSKjQCbkcrCxtbXMquAcY9u',1,139,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(140,'','Ion','Etxabe Gutierrez','ion.etxabe@ehu.es','$2y$10$2GfniM2rHxIfAiA.o8Dex./oNforo3i93AwsT2OzyHBaUlihj72mO',1,140,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(141,'','Alaitz','Etxabide Etxeberria','alaitz.etxabide@ehu.eus','$2y$10$.qg1OfYuXiLeRrDvgrrZ0ONvvFMGAS0N9Lr/5iV8e526.SL9hDms.',1,141,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(142,'','Jaione','Etxebarria Elezgarai','jaione.etxebarria@ehu.eus','$2y$10$WhUYMrE0wP2KY.bpI96mYOKL7Nagu8YmGGkpJGMpWL0ncTUbuEe8S',1,142,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(143,'','Haritz','Etxeberria Altuna','haritz.echeverria@ehu.eus','$2y$10$.HcrMOw1HvSH7trlbieIq.BK2xTAtHLbOEIwTt9A7mKPK2HM6FA6q',1,143,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(144,'','Aitor','Etxeberria Urkia','aitor.etxeberria@ehu.es','$2y$10$EQc6q0nFpoVd60m4a6NotO.O6F.R7wFJ22di23RBaYQfxq4cm8mmi',1,144,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(145,'','Aitzol','Ezeiza Ramos','aitzol.ezeiza@ehu.eus','$2y$10$RhkckG6KRtV6m63Gl0Ez5eFDmkZ.shakXVtGLcspRWaYUF8jCutkK',1,145,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(146,'','Antxon','Fernandez Cobe','antxon.fernandez@ehu.eus','$2y$10$UnwWYEA0Nf6ePkpu/ftIl.4h479ptanFqXLknqM9JUGJyKXXdrvL.',1,146,'es',NULL,'2018-03-13 09:51:26','2018-03-13 09:51:26'),(147,'','Borja','Fernandez D\'arlas Bidegain','borja.fernandezdarlas@ehu.es','$2y$10$YL0jQ9aS.TAWi0aufXUB1eZc7Ql8c3ahaWYFu1RQY57kBUgYKY3VC',1,147,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(148,'','Unai','Fernandez De Beto','unai.fernandezdebetono@ehu.es','$2y$10$dHNvnKb9Q2K/oVTEDkljauiS7zohKCmfdxrtnZQmPftZk.2aRlW6S',1,148,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(149,'','Elsa','Fernandez Gomez De Segura','elsa.fernandez@ehu.eus','$2y$10$gC3NUrJE3OFdpC9w2EZMfeYF6Owl95b6/YkuzGfpyqLg3OC6e.JLq',1,149,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(150,'','Xabier','Fernandez Llanderas','xabifernandez92@gmail.com','$2y$10$z/FzgAOM9lrS3Xsj5iRtSeFgVcKJPwaPH6Km9/fOEAtOR0jKiw20a',1,150,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(151,'','Rut','Fernandez Marin','rut.fernandez@ehu.eus','$2y$10$xH9diNuLkROOpnXBFpOh7Op6PnYeDTMbDhvg/rV8667Ka0.pcnQzy',1,151,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(152,'','Florencio','Fernandez Marzo','florencio.fernandez@ehu.eus','$2y$10$x0rrGvUr0xmhC5nYQp/bVeeRXG8DmQX/lPW8Ki8YEhof7hnolXbqO',1,152,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(153,'','Raquel','Fernandez Salvador','raquel.fernandez@ehu.eus','$2y$10$ORg9Dj2V/UePP.xK/bXmzumKw8DT5g0W8IRSszXCnw9wNUXBkLuqe',1,153,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(154,'','Pilar','Fernandez Sanchez','pilar.fernandez@ehu.eus','$2y$10$GOvQ0gbSJFIoD/2y4gUqTOnZtsG5xQBl7OoPe865lx1GTWkw4mlmi',1,154,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(155,'','Olga','Fernandez Vicente','olga.fernandez@ehu.eus','$2y$10$3Fx0yE6e/Rza0WmHfp.OROMldy9eLrTsSkbhVdfP4jhEfvCXTaOru',1,155,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:27'),(156,'','Maria Montserrat','Ferreira Sanchez','montse.ferreira@ehu.eus','$2y$10$rePLVQOrc75iyMIeq1WsX.j3CjHeuSb7LgZWoxuZXUnhEPmn.n0lm',1,156,'es',NULL,'2018-03-13 09:51:27','2018-03-13 09:51:28'),(157,'','Raquel','Fuente Dacal','raquel.fuente@ehu.eus','$2y$10$kpF2U51bN.qxOp47tO.hyuB1GblhcA5MmYm9qf1zomXW/5T3PS0Jq',1,157,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(158,'','Nagore','Gabilondo Lopez','nagore.gabilondo@ehu.eus','$2y$10$V4PX2zjzvlQY9.edh4n8KO/t7kOImYNkhxGZPpx4XLagAUBWXgnVu',1,158,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(159,'','Joseba','Gainza Barrencua','joseba.gainza@ehu.eus','$2y$10$tzbksdZET45B1.P.lV8mCe0ViIubFn7u.XZoseBxWusEdXD/hzFbe',1,159,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(160,'','Roberto','Galarraga Astibia','roberto.galarraga@ehu.eus','$2y$10$0XnIaPc.qAlhx5BH8oKIOOuXSM.ChHYNrEY0k9dNO2rIMqj2s0KjK',1,160,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(161,'','Gorka','Garate Zubiaurre','gorka.garate@ehu.eus','$2y$10$VTYHhm4.mL.Ge23rh5oGauJomsHAXVlRcy/c9jYduVs4vypEun3Hq',1,161,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(162,'','Guillermo Luis','García Anduaga','g.garcia@ehu.eus','$2y$10$BzfeFz30ndoYv7CcohnjBe/pTPzsdZYRQyigZl7918egfkWDmPTTG',1,162,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(163,'','Clara Maria','García Astrain','clara.garcia@ehu.eus','$2y$10$SpbiZMqtGjyDSSUZkh3fp.prJ7piCf/LvyUbPfBTDwXaLMNSy9aIS',1,163,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(164,'','Maria Angeles','García Bahillo','mariaangeles.garciab@ehu.eus','$2y$10$ucBBvw2tsbbi/UI6WLiaZ.uWlg8uvNQqWOlN8ngzxy3XU5INsuBdS',1,164,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(165,'','Arkaitz','Garcia Larra','arkaitz.garcia@ehu.eus','$2y$10$VRbXkmYLg596DeA2rxPYS.mkWOC4yMXZQBymfygw50PTDzxgLiyE6',1,165,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:28'),(166,'','Araceli','García Nuñez','araceli.garcia@ehu.eus','$2y$10$DWZvvfIwHdkThZrdvYDpneeAXyOL9rqGb48T8Q6YUdThoU2/Ihv4W',1,166,'es',NULL,'2018-03-13 09:51:28','2018-03-13 09:51:29'),(167,'','Pedro Maria','García Sanchez','pedromaria.garcia@ehu.eus','$2y$10$oErVTF1Gxg/Tzzf2JM6xReQuxDdZ9VxOF9lTd1BXiUizXgNj5FcWi',1,167,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(168,'','Xabier','Garicano Osinaga','xabier.garikano@ehu.eus','$2y$10$k3uuACJznIkW7zD0FBtxB.TPsTMnZ1pCCltQ5uahdFnIze5RW7GTG',1,168,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(169,'','Ugutz','Garitaonaindia Antsoategi','ugutz.garitaonaindia@ehu.eus','$2y$10$.NZdlt0W5cDyxjcOrcSM2u76DbU2IRrBequFiWw1EKN62c5mUfGja',1,169,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(170,'','Maddi','Garmendia Antin','maddi.garmendiaa@ehu.eus','$2y$10$mWgUD3VN5/4sgVxOHbOqKOgdT5gRye5oWZGlFeGffqCKC5e8V3S6e',1,170,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(171,'','Ignacio','Garmendia Azurmendi','inaki.garmendia@ehu.eus','$2y$10$71vYdIJqWMO/JxKYJ70vUecdbNngkSlkyQ816LGR59B.VEXpH4BbC',1,171,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(172,'','Asier','Garmendia Mujica','asier.garmendia@ehu.eus','$2y$10$O/fu8/BanUDA51EakdlmO.3L9q52.jZzRDkENiLq9aK8DnHtBPMyq',1,172,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(173,'','Mikel','Garmendia Mujika','mikel.garmendia@ehu.eus','$2y$10$IwF0p45pIwlniHhW6u7aP.AYd3QujeGLfnuLNGKUHSCiCo200XDr2',1,173,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(174,'','Tania','Garrido Diaz','tania.garrido@ehu.eus','$2y$10$upw3tRlb2ql5hsZywonlWOIXCDlMRD.kgxQRPtAMkqIkBft8pdJ3m',1,174,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(175,'','Vicente','Gascon Gascon','vicente.gascon@ehu.eus','$2y$10$7oGnmv7tS/WVHEBS35BqUOAQsP8d9oIGjJyR7mAIPw.EUewx9w69e',1,175,'es',NULL,'2018-03-13 09:51:29','2018-03-13 09:51:29'),(176,'','Belen','Gaspar García','belen.gaspar@ehu.eus','$2y$10$JbY/gXugIEnSYJsWc7f7tu.ejnLkFzBt1ZF56Py5B3fISTmccGFIS',1,176,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(177,'','Estibaliz','Goikoetxea Miranda','estibalitz.goikoetxea@ehu.eus','$2y$10$bEW3ioqfBVxBdD1dZTliRuU6.hexbbOBSN2q9qGDWipQl5ETa0I6e',1,177,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(178,'','Ignacio Santiago','Gomez Arriaran','gomez.arriaran@ehu.eus','$2y$10$4Avp4sqSyd0TbpIZeGPQceMJ0YZE7rU360Ip3kP14I/tCxl0fCWWe',1,178,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(179,'','Sandra','Gomez Fernandez','sandra.gomez@ehu.eus','$2y$10$jyNxdlEk4nhj/B/kmD6hne/Ombn6BrafNXrAwjtn6DxvIWIVy/VYm',1,179,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(180,'','Maria','Gonzalez Alriols','maria.gonzalez@ehu.eus','$2y$10$zhF.1giGAKsct/WTZj2NQuhYI1iJwGeisJmwoeYVISPS5UdBesKNm',1,180,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(181,'','Madalen','Gonzalez Bereziartua','madalen.gbereziartua@ehu.eus','$2y$10$TS/0TMhs5CB4DvHDT.sdAeO3zBiaQOyCS8UTHTWkbAwCwJx94rgAa',1,181,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(182,'','Miren Itziar','Gonzalez Gurruchaga','itziar.gonzalez@ehu.eus','$2y$10$vVGVfjMxKb5ZWGjiBjsWLe4odIuFMFjpZe8TSwKeI34ZsU0KlndX6',1,182,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(183,'','Lorena','Gonzalez Legarreta','lorena.gonzalez@ehu.eus','$2y$10$DPOIAVE.Nkf79zGG6y.yyezKnVr6i.9./Hp/tWOEAVZQjdGyCFiOS',1,183,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(184,'','Kizkitza','Gonzalez Munduate','kizkitza.gonzalez@ehu.eus','$2y$10$1LESVtGGJ51zy6iCbsAqM.rt3pmY//9iDD1wIV1ufBFELxqo/wrbC',1,184,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(185,'','Oihana','Gordobil Go','oihana.gordobil@ehu.eus','$2y$10$bXvySIpRiPXdwXVa4ahwneO.T7mm2t981CSHpXuQ4gNMFMATL08BG',1,185,'es',NULL,'2018-03-13 09:51:30','2018-03-13 09:51:30'),(186,'','Eugenio','Gorrotxategui San Martin','eugenio.gorrochategui@ehu.eus','$2y$10$iaitTAZhpo9njQNo8JRrOO8KPdpoDjwyaWxS/JKvgeI2cbHkQ2IlW',1,186,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(187,'','Maria Del Carmen','Gratal Perez','mariacarmen.gratal@ehu.eus','$2y$10$JuzoBnZ5PBQX1t3rRuUGg.NF8oaVTva32Nss0qATsEF0O1XfREb.K',1,187,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(188,'','Olatz','Grijalba Aseguinolaza','olatz.grijalba@ehu.eus','$2y$10$ftjShihq2TjO3oh5dX3X1esTetajBhVi8y2.qkJXiNjzxjl43YqeK',1,188,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(189,'','Olatz','Guaresti Larrea','olatz.guaresti@ehu.eus','$2y$10$FO.XUJgDliVLPASx/qGWeOm.BUfqkhmsHVeh0DjIxiZ89p.R7Pr16',1,189,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(190,'','Pedro Manuel','Guerrero Manso','pedromanuel.guerrero@ehu.eus','$2y$10$RfAcUeqrOFK7i3x1urwFbOr1uM0sc0NGpZ5UhuYAzIpOTe/zwmfNC',1,190,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(191,'','Genaro','Guisasola Aranzabal','jenaro.guisasola@ehu.eus','$2y$10$dll9.dkDQ/x..D///WTDMuwFM25TWiAuSQnIrxN6I94NyAzjJT2G6',1,191,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(192,'','Patricia','Gullon Estevez','patricia.gullon@ehu.eus','$2y$10$8RdRcDKoLqjx7sr0EG0nUOjh8E4vTHNsYqD/rUhE/hrCKq5vHeRu6',1,192,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(193,'','Jose Maria','Gurruchaga Vazquez','josemari.gurruchaga@ehu.es','$2y$10$VcpjWRTVKef8H.mtlFXeFu19yOyyZ5QsqwpjQx4iAFLk7hv1K97WK',1,193,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(194,'','Itziar','Gurrutxaga Gurrutxaga','itziar.gurruchaga@ehu.eus','$2y$10$08WjTSHkCE.HsegPIzF.FOHkbq.tIEy35zm1vSDRa/W462XfrAEkW',1,194,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(195,'','Juncal','Gutierrez Cáceres','juncal.gutierrez@ehu.eus','$2y$10$83a.kRPB4x9qbCOlCQ4UveSNOsxInpair9nS5QBK8Tq8PgirwYWR.',1,195,'es',NULL,'2018-03-13 09:51:31','2018-03-13 09:51:31'),(196,'','Jose Lorenzo','Gutierrez De Rozas Salterain','joselorenzo.gutierrezderozas@ehu.es','$2y$10$9D4Ef/4jZjOHNVAeMes72Ojb41CYEWW9Y9H0SoHNLhx3qtylAbeFm',1,196,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(197,'','Alfonso','Hernandez Lasa','alfonso.hernandez@ehu.es','$2y$10$6jkfqoierNlwDk9uwVRRvOQCFkNgpWxxDwhM4s0/dZO3oabcCbWJm',1,197,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(198,'','Fabio','Hernandez Ramos','fabio.hernandez@ehu.eus','$2y$10$mQ5iXCg9h7vb8TReJNDTUOr.cqZy3htRiYeD4afHQ8R1GN7Gx2CLy',1,198,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(199,'','Rene Alexander','Herrera Diaz','renealexander.herrera@ehu.eus','$2y$10$vjQZJh5ZVQUGgb2HXP0NiuV5WpDlRBOfJkaocZmG4LvaMPlbJStrW',1,199,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(200,'','Juan Maria','Hidalgo Betanzos','juanmaria.hidalgo@ehu.eus','$2y$10$6SDpgB06jRirX6jqtiuC0uIVv2NVJz5w/a8B4wLFgoNC1bYQFXKb6',1,200,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(201,'','Ignacio','Ibarrondo Martinez-iturralde','ignacio.ibarrondo@ehu.es','$2y$10$GhkHFkuAnJEZzMiC9OjqE.lP5vnSfq36FBTS6L6ngLPF0nxcZKiE.',1,201,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(202,'','Maria','Iceta Echave','maria.iceta@ehu.eus','$2y$10$omOsOnaTJ0NGhKk1egLXz.NqTzTsmqMc1vRgJlZUQWyZKdpQHtzkm',1,202,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(203,'','Aimar','Insausti Bello','aimar.insausti@ehu.eus','$2y$10$j9FRUpvwUug3FC/Sgfc6EuouQ31Lz..sdqYYF43m/0vMM2Ix2lKei',1,203,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(204,'','Nagore','Insausti Irastorza','nagore.insausti@ehu.eus','$2y$10$JZFpkz3kPCMhosQCz8E/U.cqRUXHZ4u8hf3F1UDFplwOJ9kZLGs8C',1,204,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:32'),(205,'','Usoa','Iñurrieta Urmeneta','usoa.inurrieta@ehu.eus','$2y$10$SP6obwlnj1aILuoQCRus.elEj.1abjA47WCc6Kf6yuQ9AZXAD6LjK',1,205,'es',NULL,'2018-03-13 09:51:32','2018-03-13 09:51:33'),(206,'','Jon','Iradi Arteaga','jon.iradi@ehu.eus','$2y$10$HIZTGjxXHsYnPCTzKpcLr.S11gZy4JPoBIbHwgwsXDoVhbzXJAvPm',1,206,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(207,'','Edurne','Irisarri Alli','edurne.irisarri@ehu.eus','$2y$10$V5.C9l1CbXi23vl1e4rWmucPzU4R/9qjOGND7JB4AveRocmxCyH4.',1,207,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(208,'','Miren','Isasa Gabilondo','miren.isasa@ehu.eus','$2y$10$2F9U1hA6hyTOgA.pWDrdWebSODsH2Szpll9Igo9kfsWy9Ba5ZsaTe',1,208,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(209,'','Leire','Iturriaga Oñarte-echevarria','leire.iturriaga@ehu.eus','$2y$10$ztbjG44BJrWRTGz8ORi2neNfffOyzczyi5ZPecL7G9t0pbx.TgExK',1,209,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(210,'','Jon','Iturrioz Sanchez','jon.iturrioz@ehu.eus','$2y$10$V6TEeOFKA.hCOyVWeW1tZeYCVxYCakfTbKSx0xlLwbZpUfzFlpfS6',1,210,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(211,'','Ane','Izagirre Korta','ane.izagirre@ehu.eus','$2y$10$dpdlVsElljRL5nSEPBdDveTxJzgF6gPQJXUqxIkPJbtO0fkHlO7ci',1,211,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(212,'','Mikel','Jauregi Odriozola','mikel.jauregi@ehu.eus','$2y$10$B2GaVWsDcBGeezVBRbUuaO2X0VQN1hVsFqER7bWCQmcNIbLFGXGS6',1,212,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(213,'','Jose Luis','Jodra Luque','joseluis.jodra@ehu.eus','$2y$10$.exYVFo/eSRoFWQQB7DuPOLpK5Ed1417OwVbDQkBHdSkzmqtuvKpy',1,213,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(214,'','Galder','Kortaberria Altzerreka','galder.cortaberria@ehu.eus','$2y$10$NtOOVlZWeZz3l5tzjRJk6.POY4wp6jr4FYRLGhlB4Sk1XhGaq.OAS',1,214,'es',NULL,'2018-03-13 09:51:33','2018-03-13 09:51:33'),(215,'','Mikel','Labayen Esnaola','mikel.labayen@ehu.es','$2y$10$g0QPKhTgvt4TsC4X3ejkruiB9EOLh.HLQFsUN7wUtLnGdBj6mVamS',1,215,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(216,'','Jalel','Labidi Bouchrika','jalel.labidi@ehu.eus','$2y$10$v88S96tUul49ezoG4SW3l.vEYFneoIig84BcBGVpFmn13hpmvPVta',1,216,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(217,'','Jokin','Lamuedra Graña','jokin.lamuedra@ehu.eus','$2y$10$xPU7ONRMDpgRowLitCoi7uwtAXS.k7oKUTXoaWY5HEUjqzF8GRgh2',1,217,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(218,'','Celia','Lana Ranz','celia.lana@ehu.eus','$2y$10$zF9yNP/UAJKOKkbsUKrMceXeQSKm1Zh5WgpVf94ECHg/FDpWwzVvq',1,218,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(219,'','Izaskun','Larraza Arocena','izaskun.larraza@ehu.eus','$2y$10$uVvX2GR/rtiCyOvU9WXfBeuf809KkYXNZSHf/3LeVsTgZC9jJTwiy',1,219,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(220,'','Ainara','Larrea Unzain','ainara.larrea@ehu.eus','$2y$10$J8iRGUarwTCczxQVVY6IzOyMYU8eGx13a2rTbo2bB6oer6GI8JSfC',1,220,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(221,'','Iker','Laskurain Iturbe','iker.laskurain@ehu.eus','$2y$10$/.421ptOKIOy155C1vHNjetJAu/QNxM/2wIj/enQYEGABybmQHiJC',1,221,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(222,'','Itsaso','Leceta Lasa','itsaso.leceta@ehu.eus','$2y$10$v.nBa8EQ8j3bfV0KbirlgOor2uvShuf8fb9SzA5DphWo5XcfRWt/a',1,222,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(223,'','Iñigo','Leon Cascante','inigo.leon@ehu.eus','$2y$10$Xa2wCGcBDRzYPfWClktD2.HDgoy4dxk5.k8NDAV2lj/UjOlZMUv6W',1,223,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(224,'','Ion','Lizuain Lilly','ion.lizuain@ehu.eus','$2y$10$HllXludB7c018tkf5KthBub4hxndjqGbfoxdarlSDWdjgVwv6Bl4u',1,224,'es',NULL,'2018-03-13 09:51:34','2018-03-13 09:51:34'),(225,'','Rodrigo Manuel','Llano-ponte Alvarez','rodrigo.llano-ponte@ehu.eus','$2y$10$bN2OaZ22N/Hu3X13Vl8dqu3.n7dJBp.qu0xpWEaa5GvK3wkOTHvwa',1,225,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(226,'','Karmele','Lopez De Ipiña Peña','karmele.ipina@ehu.eus','$2y$10$M4ud0gvQJu4/r1dJyKqoVuaBjN8R8/TWEOTdPsdiiWBKLWTpoeAhm',1,226,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(227,'','Fernando','Lopez Jimenez','fernando.lopezj@ehu.es','$2y$10$Dn1XUnMYAMkhBJAPTzDqnup5tYVctK3qmmpKT.de/q3SNuCRIfjKS',1,227,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(228,'','Francisco','Lopez Ruiz','francisco.lopez@ehu.eus','$2y$10$bmuzOA4TqS1TrApbqmD6w.KjycWn1XZcna309TT3II/Iy4bwDmCYK',1,228,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(229,'','Francisco Javier','Lorenz Muro','franciscojavier.lorenz@ehu.es','$2y$10$VTR/O4wKROh0tlFG40vmh.xSEon09osSqdKH7eBxyMWW1FFSCQx86',1,229,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(230,'','Maria','Lozano Chico','maria.lozano@ehu.eus','$2y$10$.IsewPfwoT3B2lM.04pKqOg/uISG9g1hO6kph.G9YkSsBS0Ipw8QS',1,230,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(231,'','Daniel','Luengas Carreño','daniel.luengas@ehu.eus','$2y$10$vV9ajiCazgg44alaJGwyHu.M/NjF25Q5ZWSULx5duLHJ0tzsqKTfi',1,231,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(232,'','Miguel Angel','Maiza Galparsoro','miguelangel.maiza@ehu.eus','$2y$10$t3dqiwvpO/c1rNxiPoMvZuXmzg3sUpFcbiDhJL.msaCjFjOWxxPu6',1,232,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(233,'','Maria Juncal','Manterola Zabala','mariajuncal.manterola@ehu.eus','$2y$10$qmUG6Dd8djVO9bjQWlFKb.EiYd0.mxegrlFFMcU1RliOGomxCKZoe',1,233,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:35'),(234,'','Maria Cristina','Marieta Gorriti','cristina.marieta@ehu.eus','$2y$10$nZaM8CWiBZI7/eD6eme4G.rhdSkfZ1ksllmcK38h6Ya6kkG0TU6QO',1,234,'es',NULL,'2018-03-13 09:51:35','2018-03-13 09:51:36'),(235,'','Alexander','Martin Garin','alexander.martin@ehu.eus','$2y$10$aqg5ubHnfQu1eSI9CccAc.MMl/u35ecE3cJhlJqE3KuPh9fS.169W',1,235,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(236,'','Miren Itsaso','Martinez Aguirre','mirenitsaso.martinez@ehu.eus','$2y$10$80NlJme7E1l3Egzs9XjNFe8CR1Q2z2C1yN/NEZVDhRXL/0db5OqF.',1,236,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(237,'','Ainara','Martinez De Albeniz Ausin','ainara.martinezdealbeniz@ehu.eus','$2y$10$Qr0zquwx2IdZZfepAhuqvu7GhZGymcyNsdra9F6AwKCUXT6rlACNK',1,237,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(238,'','Unai','Martinez De Lizarduy St','unai.martinezdelizarduy@ehu.eus','$2y$10$uLKlcOhScwnAIo7.Lj5iWOevyvxKIGOWDP3E.sHW6i9l7Hf8gPF2O',1,238,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(239,'','Asier','Martinez Salaberria','asier.martinez@ehu.eus','$2y$10$xcCbaBbXNedv3eYyT9igcet1y/JFGVvm042d9QZfZCTXl52ksP7PW',1,239,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(240,'','Aingeru','Mayor Martinez','aingeru.mayor@ehu.eus','$2y$10$Nk9uB/OBsPnNUwPWCmRmW.D4m/9wJhyGK2OEXws9KZkT9Fx4xUUIe',1,240,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(241,'','Josu Mirena','Mayora Oria','j.maiora@ehu.eus','$2y$10$hfDeQn1xLDSqR1Eh8NLLKedMkz4NUcjJQR9aCu5r84k0vwLiRo/Ba',1,241,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(242,'','Jose Antonio','Millan Garcia','j.millan@ehu.eus','$2y$10$Tc5GnYgCL7fROwwSjgE6IOmyTkOzk/8CqKry0s6Hea24h3IfJNIsK',1,242,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(243,'','Oihana','Mitxelena Hoyos','oihana.mitxelena@ehu.eus','$2y$10$YyL6PDt7kequkjs2jmNEYenELESEMPAP9KjI8YtgBYhY6qDdOkXUu',1,243,'es',NULL,'2018-03-13 09:51:36','2018-03-13 09:51:36'),(244,'','Julian Jose','Molina Altuna','julian.molina@ehu.eus','$2y$10$2Xwq2rGVEko6yvhFrjnMgeTwudRVQ822chh.mdECIMhN1RUhjNUnm',1,244,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(245,'','Elena','Monasterio Iruretagoyena','elena.monasterio@ehu.eus','$2y$10$TYs8LkhNA58kyHLS/niSDO23RrbOSq1TVMFC9CVSm2xB1WBJr3rGK',1,245,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(246,'','Iñaki','Mondragon Egaña','inaki.mondragon@ehu.es','$2y$10$.BIb0G37qvmiryR/1Nn./uY4MJZumHyV1qtTT3SGbiAiHfvl37a7i',1,246,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(247,'','Gurutz','Mondragon Otamendi','gurutz.mondragon@ehu.eus','$2y$10$4d5f4yx1C86bJYiRorCcxujbFOACMLSafFVFXbddaaSk6p6Sdqsvy',1,247,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(248,'','Maria Belen','Mongelos Oquiñena','belen.mongelos@ehu.es','$2y$10$ldaADzZ3.PYi0.Tcdq.v9e.oFyFZUHjiQyDyM977uVSKTZTAiaHqi',1,248,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(249,'','Jon','Montalban Sanchez','jon.montalban@ehu.eus','$2y$10$8yUnCcwvbKqsZBsTpcNoiOaToBVVKQiQ2u8/AOJuy4vxO9TSxtQDO',1,249,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(250,'','Fermin','Montejo Ubillos','fermin.montejo@ehu.es','$2y$10$YAWrYkpzQJ4cR7OIuQRs1eDwE/YBTJQmb2/Ru8ZntnIXaqCvpKUzq',1,250,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(251,'','Fernando','Mora Martin','fernando.mora@ehu.eus','$2y$10$qZL1cLDfcScZRmoq1zBwhuKrVv/qySgYBJ/2bDXmgjMaJ9wZcGQ96',1,251,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(252,'','Adolfo','Morais Ezquerro','a.morais@ehu.eus','$2y$10$DtYBo0MFiIg.U/8LrU3oAehFAcr92SwK7hzoMs6rFhWhMx6amBHQi',1,252,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(253,'','Amaia','Morales Matias','amaia.morales@ehu.eus','$2y$10$SZsUYGMeQljNxqsNJICUHeAOsAIGXB8koOCz5epHnHCb5TPsvxkVi',1,253,'es',NULL,'2018-03-13 09:51:37','2018-03-13 09:51:37'),(254,'','Oihana','Moreno Arotzena','oihana.moreno@ehu.eus','$2y$10$zWaZzRa98BugL9AXnFzHXO.GjUSQSo7j/ncuGoauOhr70Vad.rRdK',1,254,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(255,'','Vicente','Moreno Bañeza','vicente.moreno@ehu.eus','$2y$10$AJsCN5q5AEBVi/hrtE/RQ.jTcSMMSZ2xAgaxHST6PREMaFpKhk1IK',1,255,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(256,'','Abdelmalik','Moujahid Moujahid','abdelmalik.moujahid@ehu.eus','$2y$10$9qn3.8DqDyYESyFP4.UvNOXujhWT9QDZ/JVQmgMZvJR4R8Ows5TpG',1,256,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(257,'','Beñat','Muguruza Aseguinolaza','benat.muguruza@ehu.eus','$2y$10$eRG9jCSbMsEiMAm3GXbrdOlZfDU31mbt3LKeuhWDbA0w0UdtSMc9y',1,257,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(258,'','Faustino','Mujika Garitano','faustino.mujika@ehu.eus','$2y$10$B/C3wnWbUEQK7ke78kW8EuWo8hf53azr9nMSOoq.ohuBMNrI2bS5q',1,258,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(259,'','Arritxu','Muxika Carrion','arritxu.muxika@ehu.eus','$2y$10$fBjm6zyZceUzR/VHqNlNzeqXjSkDpXiYRcTLPpxJ1jOemz7yE0yb6',1,259,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(260,'','Pedro','Nieto Larrondo','p.nieto@ehu.es','$2y$10$rstwxvb583r7A5wYptLqIOGH7osMNneHtrzg2liKE.uvbwS56gVUq',1,260,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(261,'','Jose David','Nuñez Gonzalez','josedavid.nunez@ehu.eus','$2y$10$YtjPx0bCDWE79qGW9OxOc.rQri7wgoYO.zy7OO/hZwkfNN98WehRa',1,261,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(262,'','Carlos','Ochoa Laburu','carlos.ochoa-laburu@ehu.eus','$2y$10$ox99DptVNTS3.2oQPC8E9.PqHecqiH93K3TZL5Clh0kFV7frQNsJW',1,262,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(263,'','Oier','Ochoantesana Berriozabalgoitia','oier.otxoantesana@ehu.eus','$2y$10$RP7C.3uOaVBVueZU8M7NDuRrri8WGzyI1ty7LLSscZXj6S0scxGZm',1,263,'es',NULL,'2018-03-13 09:51:38','2018-03-13 09:51:38'),(264,'','Moises','Odriozola Maritorena','moises.odriozola@ehu.eus','$2y$10$vnoglQtteE0o/CRd8aSppeScUtY75AieiEOcczgawQhRtQf4DLcOi',1,264,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(265,'','Iñigo','Odriozola Urbieta','inigo.odriozola@ehu.es','$2y$10$ySOlX1KS1i3.6F1ggZmfmu2wCKhjcxP1WcffKIWG9g6AptqVY29Nq',1,265,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(266,'','Andoni','Olano Zugasti','andoni.olano@ehu.es','$2y$10$oBirdfzEahURvhYPldNrXONktwSMN89adRYqvkhExTniVgLTqzMcq',1,266,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(267,'','Arantxa','Olasagasti Aguado','arantxa.olasagasti@ehu.eus','$2y$10$qbGVROg1Kw7wGM/n2.iMbuoVXeXqbaPMGoU.4.37BGzripWXqy./C',1,267,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(268,'','Jose Antonio','Oriozabala Brit','joseantonio.oriozabala@ehu.eus','$2y$10$1as0aQa9P83p09eeNVUTtesYr6x5/kCqCtsYrfM4g8irQF9Svijyq',1,268,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(269,'','Ander','Orue Mendizabal','ander.orue@ehu.eus','$2y$10$7Uwc/W0.iqvpLvqp/OkbJ.VRmpJMVI9OIhVqXCnj.YPOfSLuKMZWK',1,269,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(270,'','Juan Luis','Osa Amilibia','j.osa@ehu.eus','$2y$10$wXCxZUOGdaOt1XovjxFd8ecF7CriqLaXX/znTGAO0NQ4tSWkz4mta',1,270,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(271,'','Usue','Oses Orbegozo','usue.oses@ehu.eus','$2y$10$WKAop.Nht.J2wprYVsKkMOi8oDePbByStvG6R1N.UHyN/AT5DN60e',1,271,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(272,'','Joseba Xabier','Ostolaza Zamora','xabier.ostolaza@ehu.eus','$2y$10$o5/dpqmMYGZSRWnauFSZluR5DN76ywjxa5GmEIHqY2XBzimJWwe7G',1,272,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(273,'','Juan Pedro','Otaduy Zubizarreta','juanpedro.otaduy@ehu.eus','$2y$10$Ds3RkU/eRej6jDIKEOQArupf7fv.GQrysYS.By5lNujWpY6wn13N.',1,273,'es',NULL,'2018-03-13 09:51:39','2018-03-13 09:51:39'),(274,'','Irati','Otamendi Irizar','irati.otamendi@ehu.es','$2y$10$1BEhzpyazdlFo/g5GsAx4eEU8EI1/3oRB9hYFoo7.mfXn9WNhqB0K',1,274,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(275,'','Maria Luisa','Otaño Echaniz','marialuisa.otano@ehu.es','$2y$10$DpC/.j4WYq5Xl/eV8Wq15.272e9mFoXi1rEEXdD7YHr6bMOk/OpPO',1,275,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(276,'','Elisa','Pardo Ruiz','elisa.pardo@ehu.es','$2y$10$3VanhBBKiIQGbvTC/Mj7m.TCxwIG3xJ8ok/w/JrPfs4N7K6/NBgEC',1,276,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(277,'','Idoya','Pellejero Salaberria','idoya.pellejero@ehu.eus','$2y$10$jLpVyFGoLmTDqhoPKlsL1.GzFA6eAeuCwVDujt8RAz7JL/KU296oO',1,277,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(278,'','Cristina','Peña Rodriguez','cristina.pr@ehu.eus','$2y$10$4L.U3fqnFaBb3oznvGH/S.MezwBJz.Po7hz5vr/TzP05nJXBRQZOa',1,278,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(279,'','Miriam Victoria','Peñalba Otaduy','miriam.penalba@ehu.eus','$2y$10$1zJrFv6vVFSIOvWnVW.EsugKQHJpFh4qscxGLmX2zv1wpWXq1xl66',1,279,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(280,'','Tomas A.','Perez Fernandez','tomas.perez@ehu.eus','$2y$10$2kFaZikSEtFQs5V7KX4jXejB59L8dMIb2jZtzEruhcts7eeEud6gK',1,280,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(281,'','Angel','Perez Manso','angel.perez@ehu.eus','$2y$10$2XUDkK18bdc0tvRxGLKiSupnbuskJkojIV8hbt/Tm40ZpPg8zA0Pi',1,281,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(282,'','Jose Javier','Perez Martinez','josejavier.perez@ehu.eus','$2y$10$7IIgP1zumvYbM3dyVHr7Y.NAGqAwVLAxWu1DfUaKVLWi1RjJJL.dC',1,282,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(283,'','Juan Manuel','Pikatza Atxa','jm.pikatza@ehu.eus','$2y$10$yKVCQVg4.IpIG1unwsXDKuOW9qSt9l6lWvH/B3kePtLiplGrXZ9l.',1,283,'es',NULL,'2018-03-13 09:51:40','2018-03-13 09:51:40'),(284,'','Imanol','Pildain Sainz','imanol.pildain@ehu.eus','$2y$10$/KYcmZCbOHbWxVaAFGn6i.FVTZg3whU4GZT8TEJ2Xr1FH9kv5d63q',1,284,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(285,'','Maria','Porcel Valenzuela','maria.porcel@ehu.eus','$2y$10$SyZoYb0PnPAdzMD7OzTWVelRt/ECGFkvzJiACq34gJVraf/rrS732',1,285,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(286,'','Marina','Quijada Van Den Berghe','marina.quijada@ehu.eus','$2y$10$Sp8au7.fUBP11715.W1uH.mYrAw3M3ZZSN0pVaCFba9bvsZpEojUa',1,286,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(287,'','Jon','Rementeria Rodriguez','ion.rementeria@ehu.eus','$2y$10$hxAVeUO7avXa7Ggrc9hsFe7HbOSVvdChMLS5ACwqys2CFZX1hyNQq',1,287,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(288,'','Aloña','Retegui Miner','alona.retegui@ehu.eus','$2y$10$mbx8YGYKG2oiOMuC8Fyiy.pDLkocxO4VEO2ByxRsbHVbSCvt4DvlG',1,288,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(289,'','Jose Eduardo','Robles Barrios','joseeduardo.robles@ehu.eus','$2y$10$ep0C1FYZ8QK4PHKNq61jxuruCqsEPyB8/vN25QQdsAOgYpQKeDPoi',1,289,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(290,'','Alvaro','Rodriguez Aguirrebengoa','alvaro.rodriguez@ehu.es','$2y$10$2OdjitDBiU7TdcbbPEwyZuW9HVNzLnUp7GyPZ3qqaGKo3.SluAW2S',1,290,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(291,'','Javier','Rodriguez Aseguinolaza','javier.rodriguezas@ehu.eus','$2y$10$Ojlvk0kLK6NnWxYEgmsOBuuS1q6O7qrCynQDy8FpQHuMfv/mcqfcq',1,291,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(292,'','Angel Agustin','Rodriguez Pierna','angelagustin.rodriguez@ehu.eus','$2y$10$u3Z.RKIFeW.lJD3HwQEG3uMBPpEZveSy8LvOoVceMFZSx48zo4Jc2',1,292,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:41'),(293,'','Jesus Maria','Romera Aguayo','jesusmaria.romera@ehu.es','$2y$10$.iqvRwamyT5/5O.D50ApbO6dGWZg8hbVPXaLRcoFIFgIwRJwCLIMq',1,293,'es',NULL,'2018-03-13 09:51:41','2018-03-13 09:51:42'),(294,'','Montserrat','Ruiz Fabre','mariamonserrat.ruiz@ehu.eus','$2y$10$lo.K6oKPkp2L9FdMbtxktOQkAqvV5IvAc0aUfzyDjXpF.klbYCjqW',1,294,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(295,'','Juan Antonio','Sadaba Fernandez','juanantonio.sadaba@ehu.eus','$2y$10$z/73RhqPBabThKc4U0L9ru1U7a8PQgeQyACOIe8Y7faZWB5ar4JwO',1,295,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(296,'','Maialen','Sagarna Aramburu','maialen.sagarna@ehu.eus','$2y$10$1FBPaZjzXXADOsDbmm4bgen1YjkFTsqSU94sMtxiCuNcj2XxZmjFa',1,296,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(297,'','Angel','Salaverria Garnacho','angel.salaverria@ehu.es','$2y$10$xPrgYBL8kde/b3BCXIHt3uMIeNMbdPh9ET.HIcr0KizZSbhLxZwV6',1,297,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(298,'','Jose Luis','Salazar Salazar','joseluis.salazar@ehu.es','$2y$10$jlQNvg9gCmg4qLQ95ic87OTHznmdU0aev7pEJtLSLDzZrRhrA3vGy',1,298,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(299,'','Miren','Salegi Gorrotxategi','miren.salegi@ehu.eus','$2y$10$ySikJSg4BQE5HNeKhxZLnO0BfBdBuQP.e6D2r992Uc/MpV6qDI4jS',1,299,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(300,'','Aitor','San Francisco Lasa','aitor.sanfrancisco@ehu.eus','$2y$10$zhVSO9H1VuCvJfUZUt0kZeUm3qFBVt8.h4/OJHbJk.23veeWcIcMG',1,300,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(301,'','Cristina','Sanchez Agra','cristina.sancheza@ehu.es','$2y$10$caDwmV3Na62uuwoVO72i6..8zKKkB.1kQ4/63xOQjgj.B1uV.ktVW',1,301,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(302,'','Maialen','Sanchez Guereño','maialen.sanchez@ehu.eus','$2y$10$rGrcuyGLF0Wvv9Ptj0iDA.WhqJSsJ3U5Wq2u/w2Q/ts9wEP47Qz4.',1,302,'es',NULL,'2018-03-13 09:51:42','2018-03-13 09:51:42'),(303,'','Jose Manuel','Sanchez Losada','josemanuel.sanchez@ehu.eus','$2y$10$seRYJOdH2QDCpO94j6cp4esPXORUta/Kb3u/z8TZDK3LS2U2vjNIu',1,303,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(304,'','Montserrat','Sanfeliu Parera','montserrat.sanfeliu@ehu.es','$2y$10$HgFdrMEHjJbd8MBeEV6EyOX/mOEepZrLas/UHHdqG0zzLf7lhSuEG',1,304,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(305,'','Arantzazu','Santamaria Echart','arantzazu.santamaria@ehu.eus','$2y$10$OTmZtdYvp1yAxw5I.e634ebChS6OjCyUW6lAtBFMGxSoObKGTaCsq',1,305,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(306,'','Roman','Santos Ciriquiain','roman.santos@ehu.eus','$2y$10$d0TMhF9HDUv16gjxeJj6yOjJQgj/qdLwXzQoRQZCasQhRAg.1yBcG',1,306,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(307,'','Ainara','Saralegi Otamendi','ainara.saralegui@ehu.eus','$2y$10$EWaIxD0qAnJeRO7tthfPv.4MuU4b3TV3OJKEge8EelSHMDXlvOgUG',1,307,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(308,'','Ane','Sarasola Iñiguez','ane.sarasola@ehu.eus','$2y$10$YQyGJ4w09Usn3n9B0puqSe5Bg5/qh5Gn3lGy4WyAyr79kwa5Me/cq',1,308,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(309,'','Paulo','Sarriugarte Onaindia','paulo.sarriugarte@ehu.eus','$2y$10$QangsmtMhoyeMFjPCISLKOq1orQxIMp.Tf7ZL6V4qslCkEg.5by6S',1,309,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(310,'','Isabel','Sellens Fernandez','isabel.sellens@ehu.eus','$2y$10$Od1AXotavOpy.evPp15Vc.QpErNE4rCx9K1AUiw5iw21QY8Ps1zVG',1,310,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(311,'','Maria','Senderos Laka','maria.senderos@ehu.eus','$2y$10$N6zeK.TbXkfZn6bXIxUKcOkM6mjaJgGzEpWI/Kdskt/V4/azQjEwu',1,311,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(312,'','Joel','Sepulveda Irastorza','joel.sepulveda@ehu.es','$2y$10$y3k2wSUMVyJA8DA2Z0HsnO8U9QTdCw6QPOKgNGdQ8y74sq3oHTdzq',1,312,'es',NULL,'2018-03-13 09:51:43','2018-03-13 09:51:43'),(313,'','Ane','Sequeiros Echeverria','ane.sequeiros@ehu.eus','$2y$10$hnLC.zDYulqz.2VPvrkNreAtTFVo1CHZ6SdCVH5HrZeQUplOL.08W',1,313,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(314,'','Leyre','Sillero Ortigosa','leyre.sillero@ehu.eus','$2y$10$15bak1J45hGuBD8uTytSkuUV71K7QXYM/Z6mE68fpGH2FcdwHtdvS',1,314,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(315,'','Eneko','Solaberrieta Mendez','eneko.solaberrieta@ehu.eus','$2y$10$lgjl8Q8AjdaN693p932QZO8yZwFuWlo1uHWNr9yWwiWjLKHMQSJuu',1,315,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(316,'','Kepa','Solozabal Bergara','kepa.solozabal@ehu.eus','$2y$10$A50holtV9CzKAj3.Dxu1LuiLBVMklSq26xVNw.A30u89ZDEWEWOJ6',1,316,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(317,'','Agnieszka','Stepien .','agnieszkaurszula@ehu.es','$2y$10$3UM.e8b.Z0YeytNjDoSE2uGM6BpS6IEsdy8DlFn0.7sHPl4aWsV2y',1,317,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(318,'','Ana','Susperregui Burguete','ana.susperregui@ehu.eus','$2y$10$2FxBQHgQf53jK4BCcNNPleW.OOl9HPDuXt2KrQsUuS93LyGfai0Km',1,318,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(319,'','Ahmed','Talaat Farag Ibrahim','ahmed.talaatfarag@ehu.eus','$2y$10$ZTkBqDXO7t23xVaGy1BrD.uPL/61o0Jx6yP3dUPcH5VCfz8f.2i4y',1,319,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(320,'','Gerardo','Tapia Otaegui','gerardo.tapia@ehu.eus','$2y$10$FLDH2xAPgN7YMYE2mw8ijOhPVxdhAjH9bNhFZDtwEE9rd7sUb5Xci',1,320,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(321,'','Maria Aranzazu','Tapia Otaegui','arantxa.tapia@ehu.eus','$2y$10$YEPX1qyWuhfhl7M5ydbA/O/a.cqb22sZgPcly.BL8yYCSweOt7PIi',1,321,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(322,'','Ana','Telleria Imaz','ana.telleria@ehu.es','$2y$10$ViMatNNJDa5dplWTaOnsquZQM4fifUtToZWrPx9AjhN4c/UlmYQn.',1,322,'es',NULL,'2018-03-13 09:51:44','2018-03-13 09:51:44'),(323,'','Agnieszka','Tercjak Sliwinska','agnieszka.tercjaks@ehu.eus','$2y$10$ta2rvUnjs/KUyztTsUVSvOwQLVHKvf5SaWuDvUPURSxFD/c/g4pMS',1,323,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(324,'','Iñaki','Tolaretxipi Tejería','inaki.tolaretxipi@ehu.eus','$2y$10$uEmFsi0HjRLYY8Qonz5Nneb96/B5k2xUypAhVrZRaqXjP2ao4GTsq',1,324,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(325,'','Lorena','Ugarte Soraluce','lorena.ugarte@ehu.eus','$2y$10$WvUy4DB2C1/5qtMuW7GeUOSzk0kA79k.Y/8GnJrkW01H3bT8fumjS',1,325,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(326,'','Juan Jose','Ugartemendia De La Iglesia','juanjo.ugartemendia@ehu.eus','$2y$10$Cjyd5vFLMQ5FoFPpsibiqOEVGRNSZzzaoq7I7E28Br5Hq1yh/UfGK',1,326,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(327,'','Jone','Uranga Gama','jone.uranga@ehu.eus','$2y$10$vHFFueKrCeh.G6uWBho3WeORheDtT6Lj6BwrpqiGR62iRnFkrYG/a',1,327,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(328,'','Gorka','Urbicain Pelayo','gorka.urbikain@ehu.eus','$2y$10$sqgEc7P8xc7PyQ/EyG0nn.gsFiQ8i8NjSgNV97Vyk1sGcwYzPj98S',1,328,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(329,'','Leire','Urbina Moreno','leire.urbina@ehu.eus','$2y$10$IZeCO1SqKiq0C6RODPtrj.gAnmEX8r41n8tA/jWv7v22ltuH75JQG',1,329,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(330,'','Marta','Urdanpilleta Landaribar','marta.urdanpilleta@ehu.eus','$2y$10$iX9yIE1zQHUclo4bz7DM4eJIutSKO.z7OQB3FFMjSLzUDEV3e1b1u',1,330,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(331,'','Maider','Uriarte Idiazabal','maider.uriarte@ehu.eus','$2y$10$Qod3kXKSRG5eumNVpCmb4eYyhSgsg7J3o//VCfNvBJjIV30Z2Ju/S',1,331,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:45'),(332,'','Miren Josune','Urien Crespo','mirenjosune.urien@ehu.eus','$2y$10$e1hBnrG9aqxXQjwjfG7N3e9pvFaKet0D5y4n.XNXOEH.tzIVQv4ra',1,332,'es',NULL,'2018-03-13 09:51:45','2018-03-13 09:51:46'),(333,'','Nagore','Urrutia Del Campo','nagore.urrutia@ehu.eus','$2y$10$LbAWDam1ltvbi/vy0/2zMuQvmQjYNSjA8Iam6MoQVYGp5xnWUUESW',1,333,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(334,'','Javier','Urruzola Moreno','javier.urruzola@ehu.eus','$2y$10$tX7cNS.ptLdHQ9Z9TiIrEe1/5soKsSObu8Nugw.bCrA2XZn/uzczS',1,334,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(335,'','Aitor','Urtasun Gonzalez','aitor.urtasun@ehu.eus','$2y$10$DswGCHmUZi6UnIG.Q8/yx.prC0G8RQszMQ1SIsdNFXuMeAAWwuID2',1,335,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(336,'','Jose Agustin','Vaquero Marino','joseagustin.vaquero@ehu.eus','$2y$10$wgD19BCx59yt1rxnYaIDFurQUTGo.VI6866qcCOv2j.YqVEEsrFtG',1,336,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(337,'','Gustavo Adolfo','Vargas Silva','gustavo.vargas@ehu.eus','$2y$10$Zy/eRpoDMr8varP3PpdVmOYLuIghQI4mZiaL5TOu4iSNR.qzCy4Xq',1,337,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(338,'','Carlos','Yusta San Vicente','carlos.yusta@ehu.es','$2y$10$4wK4q7U40tLT7zYsO5bdUu4KHtq76TbGAU5XsLG82hO9El4nJED4W',1,338,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(339,'','Miren Josune','Zabala Galarza','mirenjosune.zabala@ehu.eus','$2y$10$Qh1zBtK9tU5f/rW7j9Nk4u/qv3sz0eFtxunMLdQbMwpaAch8Ayjxi',1,339,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(340,'','Nerea','Zaldua Carazo','nerea.zaldua@ehu.eus','$2y$10$SUa7G3fTr/ZEHOoFR3wE9unHGp9Qw7wf3VoosVeMRBK4TUMQ9UqbG',1,340,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(341,'','Iratxe','Zarandona Rodriguez','iratxe.zarandona@ehu.eus','$2y$10$SbL1CMvse5s2ElriNsRi1eRMnK.mRB4aYg4h8na6clsbjK/nZtgq6',1,341,'es',NULL,'2018-03-13 09:51:46','2018-03-13 09:51:46'),(342,'','Maria Arantzazu','Zatarain Gordoa','a.zatarain@ehu.eus','$2y$10$XKHj9s4b/UNlPbLD6YHH0.TfKkFgGBLYTrBankguy4ujUKoiYY.jK',1,342,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(343,'','Arkady Pavlovich','Zhukov Egorova','arkadi.joukov@ehu.eus','$2y$10$8xRdRYWvzqCfuMss0XbMouiXe1hrRqYsvf5kfXKKT0SbmaCIZch3K',1,343,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(344,'','Valentina','Zhukova Zhukova','valentina.zhukova@ehu.eus','$2y$10$snTavZy17/4mRk5WZvWkTOyahkPXgz2N2NjWqaAfQpXFJP.5L6z1e',1,344,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(345,'','Svetlana','Zimnukhova .','svetlana.zimnukhova@ehu.eus','$2y$10$fE6nlaMY7PCj8zXRR6QELOM62Owyo33kPAn/8ZXgZj03U7uShR.b2',1,345,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(346,'','Itziar','Zubia Olaskoaga','itziar.zubia@ehu.eus','$2y$10$P/zautStW26bxEPNI2062ecRx89z.jRSLMsobX7XQFQ./Hm5LMAza',1,346,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(347,'','Maria Manuela','Zubitur Soroa','manuela.zubitur@ehu.eus','$2y$10$mt4MKgQYSri1pZlw9PGyY.nJfI.sCPaejgKvBsaLiREfIzs4HKWrS',1,347,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(348,'','Mikel','Zubizarreta Irure','m.zubizarreta@ehu.eus','$2y$10$HatFAtD..FVY3HEpsHQa.uuV286gd9pHwCLL3zQZLWJ.BeEXeScyK',1,348,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(349,'','Iraitz','Zugasti Alcorta','iraitz.zugasti@ehu.eus','$2y$10$27FiTlwcVhd1ZDHtXeV7CO9Y6DTVl3zJf/Gms5tepNvi04.sw6p6u',1,349,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(350,'','Kristina','Zuza Elosegi','kristina.zuza@ehu.eus','$2y$10$04KtTCvzHpjqn4Fjej3aF.Kb1zpYdszPptW33IaKl4lEvLhpAjQb2',1,350,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47'),(351,'','Rafael','Zuza Elosegui','rafa.zuza@ehu.eus','$2y$10$mBT3CmHinFx/ukc2pu2RIek5QKV8bgxxEGXn86ghDs39xU7bl/4YG',1,351,'es',NULL,'2018-03-13 09:51:47','2018-03-13 09:51:47');
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

-- Dump completed on 2018-03-13  9:53:05
