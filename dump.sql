-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: proxectodb
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `padre_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorias_padre_id_foreign` (`padre_id`),
  CONSTRAINT `categorias_padre_id_foreign` FOREIGN KEY (`padre_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Pescados',NULL,'2025-04-12 10:47:49','2025-04-12 10:47:53','img/pescado.png'),(2,'Cefalópodos',NULL,'2025-04-12 10:48:25','2025-04-12 10:48:28','img/calamar.png'),(3,'Mariscos',NULL,'2025-04-12 10:48:53','2025-04-12 10:48:54','img/camaron.png'),(4,'Rape y rosada',1,'2025-04-12 10:49:37','2025-04-12 10:49:39',NULL),(5,'Merluza',1,'2025-04-12 10:49:54','2025-04-12 10:49:56',NULL),(6,'Bacalao y salmón',1,'2025-04-12 10:50:06','2025-04-12 10:50:08',NULL),(7,'Pulpo',2,'2025-04-12 10:50:25','2025-04-12 10:50:26',NULL),(8,'Calamar y pota ',2,'2025-04-12 10:50:45','2025-04-12 10:50:47',NULL),(9,'Choco',2,'2025-04-12 10:50:50','2025-04-12 10:50:51',NULL),(10,'Camarón y cigala',3,'2025-04-12 11:34:31','2025-04-12 11:34:33',NULL),(11,'Langostino y gambas',3,'2025-04-12 11:34:35','2025-04-12 11:34:36',NULL),(12,'Vieira y zamburiñas',3,'2025-04-12 10:51:21','2025-04-12 10:51:23',NULL),(13,'Carnes',NULL,'2025-04-12 11:48:25','2025-04-12 11:48:27',NULL),(14,'Verduras',NULL,'2025-04-12 11:48:29','2025-04-12 11:48:30',NULL),(15,'Precocinados',NULL,'2025-04-12 11:48:32','2025-04-12 11:48:34',NULL),(16,'Conservas',NULL,'2025-04-12 11:48:35','2025-04-12 11:48:36',NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_user_id_foreign` (`user_id`),
  CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (5,14,NULL,'666445566','2025-04-30 18:59:19','2025-04-30 18:59:19'),(6,16,NULL,'666904323','2025-05-08 17:07:54','2025-05-08 17:07:54'),(7,17,NULL,'666789876','2025-05-21 18:48:37','2025-05-21 18:48:37');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  KEY `detalle_pedidos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_pedidos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES (1,2,4,1,15.13,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(2,2,8,1,4.54,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(3,2,10,2,27.53,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(4,2,20,1,72.60,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(5,2,22,1,25.41,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(6,2,31,1,3.39,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(7,3,3,1,21.78,'2025-05-12 17:57:09','2025-05-12 17:57:09'),(8,3,14,2,47.71,'2025-05-12 17:57:09','2025-05-12 17:57:09'),(9,3,17,1,11.50,'2025-05-12 17:57:09','2025-05-12 17:57:09'),(10,3,22,1,25.41,'2025-05-12 17:57:09','2025-05-12 17:57:09'),(11,4,21,1,27.23,'2025-05-12 18:07:08','2025-05-12 18:07:08'),(12,4,28,1,3.39,'2025-05-12 18:07:08','2025-05-12 18:07:08'),(13,5,26,1,15.67,'2025-05-12 18:11:29','2025-05-12 18:11:29'),(14,6,16,3,13.25,'2025-05-12 18:15:26','2025-05-12 18:15:26'),(15,7,7,1,60.77,'2025-05-12 18:17:37','2025-05-12 18:17:37'),(16,8,8,5,4.54,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(17,8,9,1,8.17,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(18,8,16,1,13.25,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(19,8,22,9,25.41,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(20,8,26,1,15.67,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(21,9,36,1,2.72,'2025-05-12 23:34:54','2025-05-12 23:34:54'),(23,11,24,2,28.75,'2025-05-12 23:48:53','2025-05-12 23:48:53'),(24,12,10,1,27.53,'2025-05-12 23:50:06','2025-05-12 23:50:06'),(25,13,20,1,72.60,'2025-05-12 23:52:37','2025-05-12 23:52:37'),(26,14,15,1,8.41,'2025-05-12 23:59:04','2025-05-12 23:59:04'),(27,15,23,1,6.96,'2025-05-13 00:41:52','2025-05-13 00:41:52'),(28,16,12,1,23.23,'2025-05-13 00:49:26','2025-05-13 00:49:26'),(29,16,13,1,27.77,'2025-05-13 00:49:26','2025-05-13 00:49:26'),(30,16,15,1,8.41,'2025-05-13 00:49:26','2025-05-13 00:49:26'),(31,17,12,1,23.23,'2025-05-13 00:54:12','2025-05-13 00:54:12'),(32,18,14,1,47.71,'2025-05-13 01:01:53','2025-05-13 01:01:53'),(33,18,16,2,13.25,'2025-05-13 01:01:53','2025-05-13 01:01:53'),(34,19,18,1,10.59,'2025-05-20 18:49:30','2025-05-20 18:49:30'),(35,20,5,1,24.20,'2025-05-21 18:49:52','2025-05-21 18:49:52'),(36,20,20,1,72.60,'2025-05-21 18:49:52','2025-05-21 18:49:52'),(37,21,19,1,9.62,'2025-05-24 09:16:20','2025-05-24 09:16:20'),(38,22,19,1,9.62,'2025-05-24 09:20:51','2025-05-24 09:20:51'),(39,23,3,1,21.78,'2025-05-24 10:23:27','2025-05-24 10:23:27'),(40,24,15,1,8.41,'2025-05-24 10:58:53','2025-05-24 10:58:53'),(41,24,34,1,4.17,'2025-05-24 10:58:53','2025-05-24 10:58:53'),(42,25,20,1,72.60,'2025-05-26 19:42:10','2025-05-26 19:42:10'),(43,25,21,1,27.23,'2025-05-26 19:42:10','2025-05-26 19:42:10'),(44,26,20,3,72.60,'2025-05-26 19:43:20','2025-05-26 19:43:20'),(45,26,21,1,27.23,'2025-05-26 19:43:20','2025-05-26 19:43:20'),(46,27,33,1,3.03,'2025-05-26 19:44:29','2025-05-26 19:44:29'),(47,28,16,5,13.25,'2025-05-27 18:42:28','2025-05-27 18:42:28'),(48,29,23,1,6.96,'2025-05-31 08:57:11','2025-05-31 08:57:11');
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `numero_factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_emision` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facturas_numero_factura_unique` (`numero_factura`),
  KEY `facturas_pedido_id_foreign` (`pedido_id`),
  CONSTRAINT `facturas_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_29_092651_drop_cache_table',1),(5,'2025_03_29_100512_create_clientes_table',1),(6,'2025_03_29_100527_create_productos_table',1),(7,'2025_03_29_100552_create_pedidos_table',1),(8,'2025_03_29_100604_create_detalle_pedidos_table',1),(9,'2025_03_29_100614_create_facturas_table',1),(10,'2025_03_29_100654_create_camiones_table',1),(11,'2025_04_03_194123_add_image_url_to_productos_table',2),(12,'2025_04_07_193059_add_categoria_to_productos_table',3),(13,'2025_04_11_190448_create_categorias_table',4),(14,'2025_04_11_192114_add_categoria_to_productos_table',5),(15,'2025_04_12_100136_add_categoria_id_to_productos_table',6),(16,'2025_04_30_183213_create_permission_tables',7),(17,'2025_04_30_183746_remove_role_from_users_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',13),(3,'App\\Models\\User',14),(2,'App\\Models\\User',15),(3,'App\\Models\\User',16),(2,'App\\Models\\User',17),(3,'App\\Models\\User',17);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (2,5,176.12,'2025-05-12 17:40:18','2025-05-12 17:40:18'),(3,5,154.11,'2025-05-12 17:57:09','2025-05-12 17:57:09'),(4,5,30.61,'2025-05-12 18:07:08','2025-05-12 18:07:08'),(5,5,15.67,'2025-05-12 18:11:29','2025-05-12 18:11:29'),(6,5,39.75,'2025-05-12 18:15:26','2025-05-12 18:15:26'),(7,5,60.77,'2025-05-12 18:17:37','2025-05-12 18:17:37'),(8,5,288.46,'2025-05-12 18:34:31','2025-05-12 18:34:31'),(9,5,2.72,'2025-05-12 23:34:54','2025-05-12 23:34:54'),(11,5,57.50,'2025-05-12 23:48:53','2025-05-12 23:48:53'),(12,5,27.53,'2025-05-12 23:50:06','2025-05-12 23:50:06'),(13,5,72.60,'2025-05-12 23:52:37','2025-05-12 23:52:37'),(14,5,8.41,'2025-05-12 23:59:04','2025-05-12 23:59:04'),(15,6,6.96,'2025-05-13 00:41:52','2025-05-13 00:41:52'),(16,6,59.41,'2025-05-13 00:49:26','2025-05-13 00:49:26'),(17,6,23.23,'2025-05-13 00:54:12','2025-05-13 00:54:12'),(18,6,74.21,'2025-05-13 01:01:53','2025-05-13 01:01:53'),(19,6,10.59,'2025-05-20 18:49:30','2025-05-20 18:49:30'),(20,7,96.80,'2025-05-21 18:49:52','2025-05-21 18:49:52'),(21,6,9.62,'2025-05-24 09:16:20','2025-05-24 09:16:20'),(22,6,9.62,'2025-05-24 09:20:51','2025-05-24 09:20:51'),(23,6,21.78,'2025-05-24 10:23:27','2025-05-24 10:23:27'),(24,5,12.58,'2025-05-24 10:58:53','2025-05-24 10:58:53'),(25,5,99.83,'2025-05-26 19:42:10','2025-05-26 19:42:10'),(26,5,245.03,'2025-05-26 19:43:20','2025-05-26 19:43:20'),(27,5,3.03,'2025-05-26 19:44:28','2025-05-26 19:44:28'),(28,6,66.25,'2025-05-27 18:42:28','2025-05-27 18:42:28'),(29,5,6.96,'2025-05-31 08:57:11','2025-05-31 08:57:11');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagen_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (2,'Pulpo tamaño mediano',25.50,0,'2025-04-04 19:05:19','2025-04-04 19:05:19','img/pulpo.jpg',7),(3,'Merluza',18.00,23,'2025-04-04 19:06:48','2025-05-24 10:23:27','img/merluza.jpg',5),(4,'Calamar',12.50,29,'2025-04-04 19:06:48','2025-05-12 17:40:18','img/calamarFresco.jpg',8),(5,'Camarón',20.00,14,'2025-04-04 19:06:48','2025-05-21 18:49:52','img/camarón.jpg',10),(7,'Pulpo tamaño grande',50.22,22,'2025-04-13 12:11:26','2025-05-12 18:17:37','img/pulpo.jpg',7),(8,'Carioca',3.75,4,'2025-04-13 13:18:40','2025-05-12 18:34:31','img/carioca.jpg',5),(9,'Alas Merluza',6.75,16,'2025-04-13 13:19:40','2025-05-12 18:34:31','img/alasMerluza.jpg',5),(10,'Rape grande',22.75,21,'2025-04-13 13:21:02','2025-05-12 23:50:06','img/rapeGrande.jpg',4),(11,'Rape mediano',16.35,22,'2025-04-13 13:21:03','2025-04-13 13:21:04','img/rapeMediano.jpg',4),(12,'Rosada',19.20,16,'2025-04-13 13:21:05','2025-05-13 00:54:12','img/rosada.jpg',4),(13,'Bacalao',22.95,11,'2025-04-13 13:28:25','2025-05-13 00:49:26','img/bacalao.jpg',6),(14,'Salmón',39.43,27,'2025-04-13 13:28:26','2025-05-13 01:01:53','img/salmon.jpg',6),(15,'Salmón porciones',6.95,20,'2025-04-13 13:28:28','2025-05-24 10:58:53','img/salmonPorciones.jpg',6),(16,'Calamar limpio',10.95,8,'2025-04-13 13:30:18','2025-05-27 18:42:28','img/calamarLimpio.jpg',8),(17,'Pota',9.50,10,'2025-04-13 13:29:20','2025-05-12 17:57:09','img/pota.jpg',8),(18,'Choco grande',8.75,24,'2025-04-13 13:33:36','2025-05-20 18:49:30','img/chocoGrande.jpg',9),(19,'Choco pequeño',7.95,25,'2025-04-13 13:33:38','2025-05-24 09:20:51','img/chocoPequeño.jpg',9),(20,'Cigala',60.00,5,'2025-04-13 13:35:37','2025-05-26 19:43:20','img/cigala.jpg',10),(21,'Cigala arrocera',22.50,23,'2025-04-13 13:35:40','2025-05-26 19:43:20','img/cigalaArrocera.jpg',10),(22,'Langostino Arg.',21.00,0,'2025-04-13 13:37:46','2025-05-12 18:34:31','img/langostino.jpg',11),(23,'Gamba',5.75,3,'2025-04-13 13:37:49','2025-05-31 08:57:11','img/gamba.jpg',11),(24,'Vieira',23.76,0,'2025-04-13 13:39:50','2025-05-12 23:48:53','img/vieira.jpg',12),(25,'Zamburiñas',10.95,29,'2025-04-13 13:39:55','2025-04-13 13:39:56','img/zamburinas.jpg',12),(26,'Carrilleras de cerdo ',12.95,19,'2025-04-13 13:41:05','2025-05-12 23:42:04','img/carrilleras.jpg',13),(27,'Muslos de pavo',3.95,20,'2025-04-13 13:41:45','2025-04-13 13:41:46','img/muslos.jpg',13),(28,'Guisantes',2.80,11,'2025-04-13 13:44:20','2025-05-12 18:07:08','img/guisantes.jpg',14),(29,'Judía',2.05,16,'2025-04-13 13:44:22','2025-04-13 13:44:24','img/judia.jpg',14),(30,'Pimiento verde',2.80,22,'2025-04-13 13:44:25','2025-04-13 13:44:26','img/pimientoVerde.jpg',14),(31,'Pimiento rojo',2.80,16,'2025-04-13 13:44:28','2025-05-12 17:40:18','img/pimientoRojo.jpg',14),(32,'Croquetas',2.35,7,'2025-04-13 13:47:15','2025-04-13 13:47:16','img/croquetas.jpg',15),(33,'Empanadillas',2.50,23,'2025-04-13 13:47:17','2025-05-26 19:44:28','img/empanadillas.jpg',15),(34,'Mejillones en escabeche',3.45,19,'2025-04-13 13:48:23','2025-05-24 10:58:53','img/mejillonesEscabeche.jpg',16),(35,'Atún',1.95,23,'2025-04-13 13:49:56','2025-04-13 13:49:57','img/atun.jpg',16),(36,'Bonito',2.25,13,'2025-04-13 13:49:58','2025-05-12 23:34:54','img/bonito.jpg',16);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2025-04-30 18:46:51','2025-04-30 18:46:51'),(2,'empleado','web','2025-04-30 18:46:51','2025-04-30 18:46:51'),(3,'cliente','web','2025-04-30 18:46:51','2025-04-30 18:46:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('V0mhzNUQejYJemKm6YMzUN1ogbCv9bo7MUf8i8I7',13,'172.28.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2Z6WHFOMkZWMm1iVVhpVjFTem0wckF5c2MzalVOQThnVEtrWEFYTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9hZG1pbi9wZWRpZG9zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTM7fQ==',1749042359);
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
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (13,'Alejandro','alexfregueiro@gmail.com','$2y$12$oUUb8Zi83CvYVTobf0b48OWxKuRccrDCyb6mAYAHmRq7ole0fx5km','666904342','2025-04-30 18:58:51','2025-05-24 09:07:09','Fernández Regueiro','[]'),(14,'Valeriano','barral@gmail.com','$2y$12$rdETBhujoPTTZ1iHzM1REec35iAZWzDq68PV45izFScYNv0PnEx2K','666445566','2025-04-30 18:59:18','2025-05-31 08:57:11','Barral','[]'),(15,'Juan','juan@gmail.com','$2y$12$s7K8GymAB8HmpHKbCz0deuO/nVsENW.fHq4xOE1dy11XNJSo/txuq','444556655','2025-05-01 09:07:17','2025-05-01 09:07:17','Castro',NULL),(16,'Pablo','pablo@gmail.com','$2y$12$YgGwuZOttLAz1Io0sm5YsOsC3NPMLwvfJw/H.v0QmsWXc1jO3864u','666904323','2025-05-08 17:07:54','2025-05-31 08:56:37','F','{\"12\": {\"image\": \"img/rosada.jpg\", \"price\": \"19.20\", \"nombre\": \"Rosada\", \"quantity\": 1}}'),(17,'Pedro','pedro@gmail.com','$2y$12$FEINbx5JDK483J0zH2iLded63KMtzPcRkUCTj7.m.bUPCT.njLirC','666789876','2025-05-21 18:48:37','2025-05-21 18:49:52','T','[]');
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

-- Dump completed on 2025-06-04 13:31:03
