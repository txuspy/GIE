-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: BdForest
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(12,1),(13,1),(18,1),(19,1),(1,3),(5,3),(12,3),(23,3),(20,4),(21,4),(22,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','Display Role Listing','See only Listing Of Role','2017-02-21 10:15:33','2017-02-27 14:38:19'),(2,'role-create','Crear Roled','Create New Role','2017-02-21 10:15:33','2017-03-02 08:43:01'),(3,'role-edit','Edit Role','Edit Role','2017-02-21 10:15:33','2017-02-21 10:15:33'),(4,'role-delete','Delete Role','Delete Role','2017-02-21 10:15:33','2017-02-21 10:15:33'),(5,'permission-list','Display Permission Listing','See only Listing of Permission','2017-02-23 14:41:35','2017-02-23 14:41:35'),(6,'permission-create','Crear Permission','Create New Permission','2017-02-23 14:43:12','2017-02-23 14:43:12'),(7,'permission-edit','Edit Permisssion','Edit Permission','2017-02-23 14:57:18','2017-02-23 14:57:18'),(8,'permission-delete','Delete Permissiion','Delete Permission','2017-02-23 15:00:36','2017-02-23 15:00:36'),(12,'user-list','Display User Listing','See only Listing of User','2017-02-24 09:28:54','2017-02-24 09:28:54'),(13,'user-create','Create User','Create New User','2017-02-24 09:36:59','2017-02-24 09:36:59'),(18,'user-edit','Edit User','Edit User','2017-02-28 14:52:19','2017-03-02 08:41:47'),(19,'user-delete','Delete User','Delete User','2017-03-02 08:42:23','2017-03-02 08:42:23'),(20,'customer-list','Clientes Listar','See only Listing of Customer','2017-03-02 08:46:09','2017-03-02 08:47:02'),(21,'customer-create','Clientes Crear','Clientes Crear','2017-03-02 08:46:37','2017-03-02 08:47:21'),(22,'customer-edit','Clientes Editar','Clientes Editar','2017-03-02 08:47:48','2017-03-02 08:48:18'),(23,'customer-delete','Clientes Borrar','Clientes Borrar','2017-03-02 08:48:11','2017-03-02 08:48:11'),(24,'adf','cvzcv','zcxvr','2017-03-06 08:56:41','2017-03-06 09:01:52'),(25,'aaa','vcxb','xvb','2017-03-06 09:36:07','2017-03-06 09:36:07'),(26,'aa','aa','aa','2017-03-06 09:39:20','2017-03-06 09:39:20');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
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
INSERT INTO `role_user` VALUES (1,1),(2,1),(1,3),(3,3),(1,4),(3,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'owner','Project Owner','User is the owner of a given project','2017-02-21 10:35:01','2017-02-21 10:35:01'),(3,'admin','Administrator','User is allowed to manage and edit other users','2017-02-21 10:36:17','2017-03-02 08:45:41'),(4,'Comercial','Comercial','Comerciales','2017-02-21 14:16:27','2017-02-21 14:16:27');
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(33) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'c14cbf141ab1b7cd009356f555b607d6','Unai','SUSPERREGI','unai@irunweb.com','$2y$10$.C.S2IBsEYFDAMwwCyjTVOdZZIY8V1QxoU/eQTG/MHKyzCX8G0y4a',1,'ALBC0oendOsbiBZspXfKW3SA3SDvDBEb80J8N2HvJcGAmhTIyRwqJuWLMHEI','2016-10-28 12:07:55','2017-03-02 11:50:15'),(2,'','Txuspy','SUSPERREGI','txuspy76@hotmail.com','$2y$10$r7wz8/3PUMjmyuP7hL3zAeKLodWD.E.spYrK0YHYNwMKOCeFwkEpu',1,'RSmE0rRiSJccybYLBkDtz6aJTm57LPzNLBBr8vaKEWH2oj5aEEOdCc9M3oL0','2016-11-07 15:03:00','2017-02-24 08:58:08'),(3,'1','Aitzi',NULL,'marketing@forestpioneer.com','$2y$10$s28K9maAsewMSn9NIZSoReAjl.X0rcJx3mceo4.yAcSG12tcxSQ4O',1,'7ZOv7hp89MvNxDKoOJ1NqpTJ3CiW7Yr1cIhUfr57BBukmwXgmaOlLZjN56Jw','2017-02-21 11:55:40','2017-02-21 11:57:15');
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

-- Dump completed on 2017-03-07  9:37:29
