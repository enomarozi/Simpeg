-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rbac
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_roles`
--

DROP TABLE IF EXISTS `access_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `role` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_roles`
--

LOCK TABLES `access_roles` WRITE;
/*!40000 ALTER TABLE `access_roles` DISABLE KEYS */;
INSERT INTO `access_roles` VALUES (2,'admindti','dti','Create Read Update Delete',NULL,'2024-10-21 04:28:54','2024-12-06 06:37:00'),(5,'administrator','administrator','CRUD',NULL,NULL,NULL),(6,'adminrektorat','adminrektorat','Create Read Update Delete',NULL,'2025-01-23 05:58:16','2025-01-23 05:58:16');
/*!40000 ALTER TABLE `access_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'administrator','GET','configuration/access_role','2025-01-23 05:21:55','2025-01-23 05:21:55'),(2,'administrator','GET','configuration/getAccessRole','2025-01-23 05:21:55','2025-01-23 05:21:55'),(3,'administrator','GET','configuration/access_role','2025-01-23 05:45:28','2025-01-23 05:45:28'),(4,'administrator','GET','configuration/getAccessRole','2025-01-23 05:45:28','2025-01-23 05:45:28'),(5,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:45:36','2025-01-23 05:45:36'),(6,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:47:58','2025-01-23 05:47:58'),(7,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:48:30','2025-01-23 05:48:30'),(8,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:48:36','2025-01-23 05:48:36'),(9,'administrator','GET','configuration/access_role','2025-01-23 05:48:37','2025-01-23 05:48:37'),(10,'administrator','GET','configuration/getAccessRole','2025-01-23 05:48:38','2025-01-23 05:48:38'),(11,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:48:41','2025-01-23 05:48:41'),(12,'administrator','GET','configuration/access_role','2025-01-23 05:49:02','2025-01-23 05:49:02'),(13,'administrator','GET','configuration/getAccessRole','2025-01-23 05:49:02','2025-01-23 05:49:02'),(14,'administrator','GET','configuration/access_role','2025-01-23 05:49:28','2025-01-23 05:49:28'),(15,'administrator','GET','configuration/getAccessRole','2025-01-23 05:49:28','2025-01-23 05:49:28'),(16,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:49:33','2025-01-23 05:49:33'),(17,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:51:03','2025-01-23 05:51:03'),(18,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:51:07','2025-01-23 05:51:07'),(19,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:51:46','2025-01-23 05:51:46'),(20,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:51:54','2025-01-23 05:51:54'),(21,'administrator','GET','configuration/access_role','2025-01-23 05:53:36','2025-01-23 05:53:36'),(22,'administrator','GET','configuration/getAccessRole','2025-01-23 05:53:36','2025-01-23 05:53:36'),(23,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:53:42','2025-01-23 05:53:42'),(24,'administrator','GET','configuration/access_role','2025-01-23 05:54:05','2025-01-23 05:54:05'),(25,'administrator','GET','configuration/getAccessRole','2025-01-23 05:54:05','2025-01-23 05:54:05'),(26,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:54:08','2025-01-23 05:54:08'),(27,'administrator','GET','configuration/access_role','2025-01-23 05:54:35','2025-01-23 05:54:35'),(28,'administrator','GET','configuration/getAccessRole','2025-01-23 05:54:35','2025-01-23 05:54:35'),(29,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:54:38','2025-01-23 05:54:38'),(30,'administrator','GET','configuration/access_role','2025-01-23 05:54:38','2025-01-23 05:54:38'),(31,'administrator','GET','configuration/getAccessRole','2025-01-23 05:54:38','2025-01-23 05:54:38'),(32,'administrator','GET','configuration/access_role','2025-01-23 05:54:42','2025-01-23 05:54:42'),(33,'administrator','GET','configuration/getAccessRole','2025-01-23 05:54:42','2025-01-23 05:54:42'),(34,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:56:14','2025-01-23 05:56:14'),(35,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:56:25','2025-01-23 05:56:25'),(36,'administrator','GET','configuration/access_role','2025-01-23 05:58:07','2025-01-23 05:58:07'),(37,'administrator','GET','configuration/getAccessRole','2025-01-23 05:58:08','2025-01-23 05:58:08'),(38,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:58:16','2025-01-23 05:58:16'),(39,'administrator','GET','configuration/access_role','2025-01-23 05:58:16','2025-01-23 05:58:16'),(40,'administrator','GET','configuration/getAccessRole','2025-01-23 05:58:16','2025-01-23 05:58:16'),(41,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:58:21','2025-01-23 05:58:21'),(42,'administrator','POST','configuration/crudAccessRole','2025-01-23 05:58:37','2025-01-23 05:58:37'),(43,'administrator','GET','configuration/access_role','2025-01-23 06:00:42','2025-01-23 06:00:42'),(44,'administrator','GET','configuration/getAccessRole','2025-01-23 06:00:42','2025-01-23 06:00:42'),(45,'administrator','POST','configuration/crudAccessRole','2025-01-23 06:01:01','2025-01-23 06:01:01'),(46,'administrator','GET','configuration/access_role','2025-01-23 06:01:01','2025-01-23 06:01:01'),(47,'administrator','GET','configuration/getAccessRole','2025-01-23 06:01:01','2025-01-23 06:01:01'),(48,'administrator','GET','configuration/user','2025-01-23 06:01:21','2025-01-23 06:01:21'),(49,'administrator','GET','configuration/getUser','2025-01-23 06:01:21','2025-01-23 06:01:21'),(50,'administrator','GET','configuration/statusUser/admindti/1','2025-01-23 06:01:33','2025-01-23 06:01:33'),(51,'administrator','GET','configuration/user','2025-01-23 06:01:33','2025-01-23 06:01:33'),(52,'administrator','GET','configuration/getUser','2025-01-23 06:01:34','2025-01-23 06:01:34'),(53,'administrator','GET','configuration/statusUser/admindti/0','2025-01-23 06:01:37','2025-01-23 06:01:37'),(54,'administrator','GET','configuration/user','2025-01-23 06:01:37','2025-01-23 06:01:37'),(55,'administrator','GET','configuration/getUser','2025-01-23 06:01:37','2025-01-23 06:01:37'),(56,'administrator','GET','configuration/access_role','2025-01-23 06:12:25','2025-01-23 06:12:25'),(57,'administrator','GET','configuration/getAccessRole','2025-01-23 06:12:25','2025-01-23 06:12:25'),(58,'administrator','POST','configuration/crudAccessRole','2025-01-23 06:12:49','2025-01-23 06:12:49'),(59,'administrator','GET','configuration/role','2025-01-23 06:13:20','2025-01-23 06:13:20'),(60,'administrator','GET','configuration/getRole','2025-01-23 06:13:20','2025-01-23 06:13:20'),(61,'administrator','POST','configuration/crudRole','2025-01-23 06:13:31','2025-01-23 06:13:31'),(62,'administrator','GET','configuration/role','2025-01-23 06:14:31','2025-01-23 06:14:31'),(63,'administrator','GET','configuration/getRole','2025-01-23 06:14:31','2025-01-23 06:14:31'),(64,'administrator','POST','configuration/crudRole','2025-01-23 06:17:47','2025-01-23 06:17:47'),(65,'administrator','GET','configuration/role','2025-01-23 06:18:39','2025-01-23 06:18:39'),(66,'administrator','GET','configuration/getRole','2025-01-23 06:18:39','2025-01-23 06:18:39'),(67,'administrator','GET','configuration/role','2025-01-23 06:20:07','2025-01-23 06:20:07'),(68,'administrator','GET','configuration/getRole','2025-01-23 06:20:07','2025-01-23 06:20:07'),(69,'administrator','POST','configuration/crudRole','2025-01-23 06:20:13','2025-01-23 06:20:13'),(70,'administrator','GET','configuration/role','2025-01-23 06:21:27','2025-01-23 06:21:27'),(71,'administrator','GET','configuration/getRole','2025-01-23 06:21:27','2025-01-23 06:21:27'),(72,'administrator','POST','configuration/crudRole','2025-01-23 06:21:31','2025-01-23 06:21:31'),(73,'administrator','GET','configuration/role','2025-01-23 06:21:31','2025-01-23 06:21:31'),(74,'administrator','GET','configuration/getRole','2025-01-23 06:21:31','2025-01-23 06:21:31'),(75,'administrator','POST','configuration/crudRole','2025-01-23 06:21:36','2025-01-23 06:21:36'),(76,'administrator','GET','configuration/role','2025-01-23 06:21:36','2025-01-23 06:21:36'),(77,'administrator','GET','configuration/getRole','2025-01-23 06:21:36','2025-01-23 06:21:36'),(78,'administrator','POST','configuration/crudRole','2025-01-23 06:21:43','2025-01-23 06:21:43'),(79,'administrator','GET','configuration/role','2025-01-23 06:21:43','2025-01-23 06:21:43'),(80,'administrator','GET','configuration/getRole','2025-01-23 06:21:43','2025-01-23 06:21:43'),(81,'administrator','POST','configuration/crudRole','2025-01-23 06:21:48','2025-01-23 06:21:48'),(82,'administrator','GET','configuration/role','2025-01-23 06:21:48','2025-01-23 06:21:48'),(83,'administrator','GET','configuration/getRole','2025-01-23 06:21:48','2025-01-23 06:21:48'),(84,'administrator','GET','configuration/role','2025-01-23 06:22:32','2025-01-23 06:22:32'),(85,'administrator','GET','configuration/getRole','2025-01-23 06:22:33','2025-01-23 06:22:33'),(86,'administrator','POST','configuration/crudRole','2025-01-23 06:22:39','2025-01-23 06:22:39'),(87,'administrator','GET','configuration/role','2025-01-23 06:22:39','2025-01-23 06:22:39'),(88,'administrator','GET','configuration/getRole','2025-01-23 06:22:40','2025-01-23 06:22:40'),(89,'administrator','POST','configuration/crudRole','2025-01-23 06:22:42','2025-01-23 06:22:42'),(90,'administrator','GET','configuration/role','2025-01-23 06:22:42','2025-01-23 06:22:42'),(91,'administrator','GET','configuration/getRole','2025-01-23 06:22:42','2025-01-23 06:22:42'),(92,'administrator','GET','configuration/parent_menu','2025-01-23 06:22:43','2025-01-23 06:22:43'),(93,'administrator','GET','configuration/getParentMenu','2025-01-23 06:22:44','2025-01-23 06:22:44'),(94,'administrator','GET','configuration/parent_menu','2025-01-23 06:22:50','2025-01-23 06:22:50'),(95,'administrator','GET','configuration/getParentMenu','2025-01-23 06:22:50','2025-01-23 06:22:50'),(96,'administrator','POST','configuration/crudParentMenu','2025-01-23 06:23:43','2025-01-23 06:23:43'),(97,'administrator','GET','configuration/parent_menu','2025-01-23 06:23:44','2025-01-23 06:23:44'),(98,'administrator','GET','configuration/getParentMenu','2025-01-23 06:23:44','2025-01-23 06:23:44'),(99,'administrator','GET','configuration/role','2025-01-23 06:24:10','2025-01-23 06:24:10'),(100,'administrator','GET','configuration/getRole','2025-01-23 06:24:11','2025-01-23 06:24:11'),(101,'administrator','POST','configuration/crudRole','2025-01-23 06:24:33','2025-01-23 06:24:33'),(102,'administrator','GET','configuration/role','2025-01-23 06:24:33','2025-01-23 06:24:33'),(103,'administrator','GET','configuration/getRole','2025-01-23 06:24:34','2025-01-23 06:24:34'),(104,'administrator','POST','configuration/crudRole','2025-01-23 06:24:43','2025-01-23 06:24:43'),(105,'administrator','GET','configuration/role','2025-01-23 06:43:10','2025-01-23 06:43:10'),(106,'administrator','GET','configuration/getRole','2025-01-23 06:43:10','2025-01-23 06:43:10'),(107,'administrator','POST','configuration/crudRole','2025-01-23 07:01:27','2025-01-23 07:01:27'),(108,'administrator','GET','configuration/role','2025-01-23 07:01:42','2025-01-23 07:01:42'),(109,'administrator','GET','configuration/getRole','2025-01-23 07:01:42','2025-01-23 07:01:42'),(110,'administrator','GET','configuration/role','2025-01-23 07:05:05','2025-01-23 07:05:05'),(111,'administrator','GET','configuration/getRole','2025-01-23 07:05:06','2025-01-23 07:05:06'),(112,'administrator','GET','configuration/role','2025-01-23 07:09:11','2025-01-23 07:09:11'),(113,'administrator','GET','configuration/getRole','2025-01-23 07:09:11','2025-01-23 07:09:11'),(114,'administrator','POST','configuration/crudRole','2025-01-23 07:09:19','2025-01-23 07:09:19'),(115,'administrator','GET','configuration/role','2025-01-23 07:09:19','2025-01-23 07:09:19'),(116,'administrator','GET','configuration/getRole','2025-01-23 07:09:19','2025-01-23 07:09:19'),(117,'administrator','GET','configuration/role','2025-01-23 07:09:41','2025-01-23 07:09:41'),(118,'administrator','GET','configuration/getRole','2025-01-23 07:09:42','2025-01-23 07:09:42'),(119,'administrator','POST','configuration/crudRole','2025-01-23 07:09:48','2025-01-23 07:09:48'),(120,'administrator','GET','configuration/role','2025-01-23 07:09:48','2025-01-23 07:09:48'),(121,'administrator','GET','configuration/getRole','2025-01-23 07:09:48','2025-01-23 07:09:48'),(122,'administrator','GET','configuration/role','2025-01-23 07:21:22','2025-01-23 07:21:22'),(123,'administrator','GET','configuration/getRole','2025-01-23 07:21:22','2025-01-23 07:21:22'),(124,'administrator','GET','configuration/role','2025-01-23 07:21:31','2025-01-23 07:21:31'),(125,'administrator','GET','configuration/getRole','2025-01-23 07:21:31','2025-01-23 07:21:31'),(126,'administrator','GET','configuration/parent_menu','2025-01-23 07:21:32','2025-01-23 07:21:32'),(127,'administrator','GET','configuration/getParentMenu','2025-01-23 07:21:32','2025-01-23 07:21:32'),(128,'administrator','GET','configuration/role','2025-01-23 07:21:35','2025-01-23 07:21:35'),(129,'administrator','GET','configuration/getRole','2025-01-23 07:21:35','2025-01-23 07:21:35'),(130,'administrator','POST','configuration/crudRole','2025-01-23 07:21:42','2025-01-23 07:21:42'),(131,'administrator','GET','configuration/role','2025-01-23 07:21:42','2025-01-23 07:21:42'),(132,'administrator','GET','configuration/getRole','2025-01-23 07:21:42','2025-01-23 07:21:42'),(133,'administrator','GET','configuration/parent_menu','2025-01-23 07:21:44','2025-01-23 07:21:44'),(134,'administrator','GET','configuration/getParentMenu','2025-01-23 07:21:45','2025-01-23 07:21:45'),(135,'administrator','GET','configuration/parent_menu','2025-01-23 07:21:52','2025-01-23 07:21:52'),(136,'administrator','GET','configuration/getParentMenu','2025-01-23 07:21:52','2025-01-23 07:21:52'),(137,'administrator','GET','configuration/parent_menu','2025-01-23 07:21:59','2025-01-23 07:21:59'),(138,'administrator','GET','configuration/getParentMenu','2025-01-23 07:22:00','2025-01-23 07:22:00'),(139,'administrator','GET','configuration/menu','2025-01-23 07:22:13','2025-01-23 07:22:13'),(140,'administrator','GET','configuration/getMenu','2025-01-23 07:22:13','2025-01-23 07:22:13'),(141,'administrator','GET','configuration/user','2025-01-23 07:22:14','2025-01-23 07:22:14'),(142,'administrator','GET','configuration/getUser','2025-01-23 07:22:15','2025-01-23 07:22:15'),(143,'administrator','GET','configuration/access_role','2025-01-23 07:22:34','2025-01-23 07:22:34'),(144,'administrator','GET','configuration/getAccessRole','2025-01-23 07:22:34','2025-01-23 07:22:34'),(145,'administrator','GET','configuration/access_role','2025-01-23 07:35:17','2025-01-23 07:35:17'),(146,'administrator','GET','configuration/getAccessRole','2025-01-23 07:35:18','2025-01-23 07:35:18'),(147,'administrator','GET','configuration/access_role','2025-01-23 07:35:35','2025-01-23 07:35:35'),(148,'administrator','GET','configuration/getAccessRole','2025-01-23 07:35:35','2025-01-23 07:35:35'),(149,'administrator','GET','configuration/role','2025-01-23 07:35:36','2025-01-23 07:35:36'),(150,'administrator','GET','configuration/getRole','2025-01-23 07:35:37','2025-01-23 07:35:37'),(151,'administrator','GET','configuration/parent_menu','2025-01-23 07:35:37','2025-01-23 07:35:37'),(152,'administrator','GET','configuration/getParentMenu','2025-01-23 07:35:37','2025-01-23 07:35:37'),(153,'administrator','GET','configuration/menu','2025-01-23 07:35:38','2025-01-23 07:35:38'),(154,'administrator','GET','configuration/getMenu','2025-01-23 07:35:38','2025-01-23 07:35:38'),(155,'administrator','GET','configuration/user','2025-01-23 07:35:38','2025-01-23 07:35:38'),(156,'administrator','GET','configuration/getUser','2025-01-23 07:35:39','2025-01-23 07:35:39'),(157,'administrator','GET','configuration/access_role','2025-01-23 07:35:39','2025-01-23 07:35:39'),(158,'administrator','GET','configuration/getAccessRole','2025-01-23 07:35:39','2025-01-23 07:35:39'),(159,'administrator','GET','configuration/role','2025-01-23 07:37:34','2025-01-23 07:37:34'),(160,'administrator','GET','configuration/getRole','2025-01-23 07:37:35','2025-01-23 07:37:35'),(161,'administrator','GET','configuration/parent_menu','2025-01-23 07:37:36','2025-01-23 07:37:36'),(162,'administrator','GET','configuration/getParentMenu','2025-01-23 07:37:36','2025-01-23 07:37:36'),(163,'administrator','GET','configuration/menu','2025-01-23 07:37:37','2025-01-23 07:37:37'),(164,'administrator','GET','configuration/getMenu','2025-01-23 07:37:38','2025-01-23 07:37:38'),(165,'administrator','GET','configuration/user','2025-01-23 07:37:39','2025-01-23 07:37:39'),(166,'administrator','GET','configuration/getUser','2025-01-23 07:37:40','2025-01-23 07:37:40'),(167,'administrator','GET','configuration/access_role','2025-01-23 07:37:41','2025-01-23 07:37:41'),(168,'administrator','GET','configuration/getAccessRole','2025-01-23 07:37:41','2025-01-23 07:37:41');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_code` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `route_name` varchar(40) NOT NULL,
  `ordered` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (4,'dashboard321','DTI Data','dti.data',1,'fa fa-list','2024-10-30 02:05:56','2024-10-31 03:12:55'),(5,'dashboard321','Admin DTI','admin.dti',3,'fa fa-list-alt','2024-10-30 02:07:28','2024-10-31 03:12:58'),(6,'adminpanel31','User Data','usedata',4,'fa fa-user-circle-o','2024-10-31 03:29:58','2024-10-31 03:29:58');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (130,'0001_01_01_000000_create_users_table',1),(131,'0001_01_01_000001_create_cache_table',1),(132,'0001_01_01_000002_create_jobs_table',1),(133,'2024_10_09_075955_create_accounts_table',1),(134,'2024_10_10_044439_create_menus_table',1),(135,'2024_10_11_135036_create_roles_table',1),(136,'2024_10_11_144111_create_permissions_table',1),(137,'2024_10_14_103604_create_access_roles_table',1),(138,'2024_10_15_110506_create_role_permissions_table',1),(139,'2024_10_23_100240_create_password_resets_table',2),(140,'2024_10_30_140908_create_parent_menu',3),(141,'2025_01_17_090251_create_logs',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parent_menu`
--

DROP TABLE IF EXISTS `parent_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parent_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(30) NOT NULL,
  `parent_code` varchar(30) NOT NULL,
  `parent_name` varchar(30) DEFAULT NULL,
  `ordered` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parent_menu`
--

LOCK TABLES `parent_menu` WRITE;
/*!40000 ALTER TABLE `parent_menu` DISABLE KEYS */;
INSERT INTO `parent_menu` VALUES (3,'dti','dashboard321','Dashboard',1,'2024-10-30 09:15:31','2024-10-30 09:15:31'),(4,'dti','adminpanel31','Admin Panel',2,'2024-10-31 03:27:05','2024-10-31 03:27:05'),(5,'dti','data31','Olah Data',3,'2024-10-31 03:27:41','2024-10-31 03:27:41'),(6,'administrator','213','123123',213123,'2025-01-23 06:23:44','2025-01-23 06:23:44');
/*!40000 ALTER TABLE `parent_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('marozi.eno@gmail.com','pfSsc7tCO23Nd4ubh4DoGDwtE2svvOo0T61r9tSD100NG90gQb4Yt4sYe24w','2024-10-23 09:11:28');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `permissions` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator',NULL,'ONLY ONE',NULL,'2024-12-06 02:57:54'),(4,'sdm',NULL,'untuk sdm','2024-10-21 04:20:49','2024-12-06 03:24:39'),(5,'adminrektorat',NULL,'Untuk Rektorat','2024-10-30 02:46:38','2024-10-30 02:46:38'),(7,'dti',NULL,'untuk dti','2024-12-06 03:20:55','2024-12-06 03:20:55');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('6zLyqCbKgHAbruUBfIKDGFuKs2IAZ2UEvj5jFt6P',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEZWYThZODRrSE5ON1NrQnY1VEVqY21BUjZLWFRScDZZQkhOalZVdSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb25maWd1cmF0aW9uL2dldEFjY2Vzc1JvbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1737617861);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eno Marozi','administrator','marozi.eno@gmail.com',NULL,'$2y$12$qXcqg7kNgMNMGWY3OjAi2.ApXT0sNk4ALqVE9uoeIEcT8rEnFh6uy',1,'9UzA2NXfmzQ8AdzlSmqbbwEDlIsQfkMqM09VHJNnTxSRXhW4VvXxNuSoyjJu','2024-10-21 04:01:35','2024-12-05 03:45:40'),(2,'Admin DTI','admindti','admindti@unand.ac.id',NULL,'$2y$12$oec3rpLG4RuwnXYUy6Y.DOolSAypI122rz3L9eVmJdzQczz2G46fq',0,NULL,'2024-10-21 04:28:43','2024-10-21 04:28:43'),(3,'Admin Rektorat','adminrektorat','adminrektorat@gmail.com',NULL,'$2y$12$3SZrMhKEnsoJOnp6manXnejGsPNTmOryvBcr.wdwfIOjgvDXsFIui',0,NULL,'2024-10-30 02:46:06','2024-10-30 02:46:06');
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

-- Dump completed on 2025-01-23 14:38:15
