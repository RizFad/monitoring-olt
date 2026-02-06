-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 172.26.171.106    Database: monitoring
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `device_logs`
--

DROP TABLE IF EXISTS `device_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `device_type` enum('OLT','ONU') DEFAULT NULL,
  `device_id` int DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_logs`
--

LOCK TABLES `device_logs` WRITE;
/*!40000 ALTER TABLE `device_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `device_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `olt`
--

DROP TABLE IF EXISTS `olt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `olt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `firmware` varchar(50) DEFAULT NULL,
  `status` enum('online','offline') DEFAULT 'offline',
  `last_up_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olt`
--

LOCK TABLES `olt` WRITE;
/*!40000 ALTER TABLE `olt` DISABLE KEYS */;
INSERT INTO `olt` VALUES (2,'PUSC-OLT-HUAWEI-E02','Group/PUSC','HW-OLT9000','192.99.99.3','V5.1.2','online','2026-02-06 18:50:21','2026-02-06 11:50:21','2026-02-06 11:50:21'),(3,'DESPACITO-100-203',NULL,'LAN','0.0.0.0',NULL,'offline',NULL,'2026-02-06 12:28:15','2026-02-06 12:28:15'),(5,'PUSKOM','BATALYON','BYONCOMBAT','172.0.0.1','V.32.22','offline','2026-02-06 12:12:00','2026-02-06 12:55:13','2026-02-06 13:01:10'),(6,'deskripsi','asd','123','1231212.12312','asdm','offline','2312-12-31 03:11:00','2026-02-06 15:10:25','2026-02-06 15:10:25'),(7,'asd','asd','asd','zc','zxc','online','1241-12-04 02:21:00','2026-02-06 15:10:33','2026-02-06 15:10:33'),(8,'12123','asdas','asd','1312','asdas','online','2313-12-31 11:01:00','2026-02-06 15:10:45','2026-02-06 15:10:45');
/*!40000 ALTER TABLE `olt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `onu`
--

DROP TABLE IF EXISTS `onu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `olt_id` int DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `mac` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `vendor_model` varchar(50) DEFAULT NULL,
  `firmware` varchar(50) DEFAULT NULL,
  `status` enum('online','offline') DEFAULT 'offline',
  `reason` varchar(100) DEFAULT NULL,
  `rx` varchar(20) DEFAULT NULL,
  `tx` varchar(20) DEFAULT NULL,
  `last_up_time` datetime DEFAULT NULL,
  `status_internet` enum('ON','OFF') DEFAULT 'ON',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_onu_olt` (`olt_id`),
  CONSTRAINT `fk_onu_olt` FOREIGN KEY (`olt_id`) REFERENCES `olt` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `onu`
--

LOCK TABLES `onu` WRITE;
/*!40000 ALTER TABLE `onu` DISABLE KEYS */;
INSERT INTO `onu` VALUES (3,2,'BUDI SETIAWAN','FH123458','D0:5F:AF:52:E2:E9',NULL,'HG8245H',NULL,'offline',NULL,'-20.10','0.90','2026-02-06 18:50:21','OFF','2026-02-06 11:50:21','2026-02-06 11:50:21'),(4,3,'KAMIL SUBAKTI',NULL,NULL,NULL,NULL,NULL,'offline',NULL,NULL,NULL,NULL,'ON','2026-02-06 12:35:57','2026-02-06 12:35:57'),(5,5,'HARJANTO','CDT','D0A:12:21:AA:211A','172.0.0.1','CDTC','V.32.22','online','reass','-12,23 dBm','14,22 dBm','2222-12-12 12:12:00','ON','2026-02-06 13:41:19','2026-02-06 13:41:19'),(6,8,'asd','asd','sad','1312','asd','asdas','online','','zxc','qwe','1321-12-31 03:02:00','ON','2026-02-06 15:33:58','2026-02-06 17:57:30'),(7,3,'eee','q','ww','0.0.0.0','www','asd','online','xx','rrrr','ttttt','2222-02-22 22:22:00','ON','2026-02-06 15:34:22','2026-02-06 15:34:22'),(8,8,'12','qsad','zxc','4431221','www212','ggdffd','online','hjfghfg','cxv','tttttxcvcx','0003-12-21 23:02:00','ON','2026-02-06 15:34:42','2026-02-06 15:34:42');
/*!40000 ALTER TABLE `onu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `onu_detail`
--

DROP TABLE IF EXISTS `onu_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `onu_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `onu_id` int DEFAULT NULL,
  `wifi_name` varchar(100) DEFAULT NULL,
  `wifi_password` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `gateway` varchar(50) DEFAULT NULL,
  `dns` varchar(50) DEFAULT NULL,
  `cpu_usage` int DEFAULT NULL,
  `memory_usage` int DEFAULT NULL,
  `wireless_clients` int DEFAULT NULL,
  `wired_clients` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_detail_onu` (`onu_id`),
  CONSTRAINT `fk_detail_onu` FOREIGN KEY (`onu_id`) REFERENCES `onu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `onu_detail`
--

LOCK TABLES `onu_detail` WRITE;
/*!40000 ALTER TABLE `onu_detail` DISABLE KEYS */;
INSERT INTO `onu_detail` VALUES (3,3,'WiFi-Budi','12345678','10.1.1.4','10.1.1.1','8.8.8.8',5,10,1,1,'2026-02-06 11:50:21'),(4,6,'asd','zxc','1312','ffff','ccc',333,0,0,333,'2026-02-06 17:36:26');
/*!40000 ALTER TABLE `onu_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator') DEFAULT 'operator',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','0192023a7bbd73250516f069df18b500','admin','2026-02-06 11:49:59','2026-02-06 11:49:59'),(2,'operator1','2407bd807d6ca01d1bcd766c730cec9a','operator','2026-02-06 11:49:59','2026-02-06 11:49:59');
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

-- Dump completed on 2026-02-07  1:05:45
