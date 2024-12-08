-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: intranet
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Aromatherapy Relax',30,39.00,NULL),(2,'Aromatherapy Relax',50,55.00,NULL),(3,'Aromatherapy Relax',80,79.00,NULL),(4,'Ayurveda Relaxing',80,89.00,NULL),(5,'Coupla Massage',50,150.00,NULL),(6,'Coupla Massage',80,180.00,NULL),(7,'Deep Tissue Massage',30,42.00,NULL),(8,'Deep Tissue Massage',50,65.00,NULL),(9,'Deep Tissue Massage',80,89.00,NULL),(10,'Facial Express',30,42.00,NULL),(11,'Hot Stone Massage',80,79.00,NULL),(12,'India Head Massage',30,34.00,NULL),(13,'Lomi Lomi Nui',50,59.00,NULL),(14,'Lomi Lomi Nui',80,79.00,NULL),(15,'Manicura',45,25.00,NULL),(16,'Pain Relief',80,55.00,NULL),(17,'Pain Relief',80,79.00,NULL),(18,'Pedicura',60,39.00,NULL),(19,'Private Spa Valle Orotava',60,20.00,NULL),(20,'Reflexology',30,32.00,NULL),(21,'Reflexology',50,45.00,NULL),(22,'Sauna Taoro',60,20.00,NULL),(23,'Specialized Facial',70,79.00,NULL),(24,'Thai Massage',80,99.00,NULL),(25,'Tired Legs Massage',30,39.00,NULL),(26,'Tired Legs Massage',50,55.00,NULL),(133,'Añadimos un servicio de prueba',160,1500.00,'Te ponen piedras hirviendo');
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 17:11:32
