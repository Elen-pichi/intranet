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
-- Table structure for table `beneficios`
--

DROP TABLE IF EXISTS `beneficios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beneficios` (
  `id` int NOT NULL,
  `id_venta` int NOT NULL,
  `id_gasto` int NOT NULL,
  `fecha` date NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `porcentaje` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_venta_idx` (`id_venta`) /*!80000 INVISIBLE */,
  KEY `id_gasto_idx` (`id_gasto`),
  CONSTRAINT `id_gasto` FOREIGN KEY (`id_gasto`) REFERENCES `gastos` (`id`),
  CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficios`
--

LOCK TABLES `beneficios` WRITE;
/*!40000 ALTER TABLE `beneficios` DISABLE KEYS */;
/*!40000 ALTER TABLE `beneficios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centros`
--

DROP TABLE IF EXISTS `centros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centros`
--

LOCK TABLES `centros` WRITE;
/*!40000 ALTER TABLE `centros` DISABLE KEYS */;
INSERT INTO `centros` VALUES (29,'Sur Oeste','En cualquier lugar del mundo, 25 - Madrid','666666666'),(30,'Norte','C/ Codo 28 - Santander','666666667'),(32,'Central','Sin dirección','000000000'),(33,'Sur','Adivínalo en el sur, puede ser Andalucía, España','666666678');
/*!40000 ALTER TABLE `centros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gastos` (
  `id` int NOT NULL,
  `id_trabajador` int NOT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` text,
  `importe` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_trabajador_idx` (`id_trabajador`),
  CONSTRAINT `id_trabajador` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `id_centro` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `e_mail_UNIQUE` (`e_mail`),
  KEY `IDX_CF4C0B49A9B48B80` (`id_centro`),
  CONSTRAINT `FK_CF4C0B49A9B48B80` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
INSERT INTO `trabajadores` VALUES (32,'Juan','Pérez','gerente@test.com','123456789',5000.00,29),(33,'María','López','administrador@test.com','987654321',4000.00,32),(34,'Carlos','García','coordinador@test.com','456789123',3500.00,29),(35,'Ana','Torres','usuario@test.com','789123456',3000.00,32),(36,'Elena','Migallon','gerente@mail.com','000000000',0.00,32),(37,'mi nombre','MIGALLON','dfdf@mimail.com','666666666',5000.00,33);
/*!40000 ALTER TABLE `trabajadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('gerente','administrador','coordinador','usuario') COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('administrador@test.com','$2y$10$VQHAwe0mOdzLHiOWxZ/BRuYDrD1TN6uj7RXw41epK0V1NPxIl74kO','administrador',1),('coordinador@test.com','$2y$10$fpKynRE9z3oABvE9GrIRhe.ePJL7Ucgntn7ljwDdxSpS8i8ElbwSO','coordinador',1),('gerente@mail.com','$2y$10$/n/SfNK2TVrcfZ1t27ERkulGCDvpCf9Ewn7lMZ5MqbCu2IgRhJYni','gerente',1),('gerente@test.com','$2y$10$E5z.KcNoOPfzAk9eXJ5cSeGuEv6yb6hbPnSO.uwfojy5y1jbhxclq','gerente',1),('usuario@test.com','$2y$10$dMdSruJXDDQPOiJoT48.PO8VsKm6cwmpvqZ8EH3J9b0crf7IpEPS.','usuario',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_trabajador` int NOT NULL,
  `id_centro` int NOT NULL,
  `numero` int NOT NULL,
  `fecha` date NOT NULL,
  `tipo_transaccion` enum('Tarjeta','Efectivo','Bizum') COLLATE utf8mb4_unicode_ci NOT NULL,
  `importe_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`),
  KEY `IDX_808D9EA9B48B80` (`id_centro`),
  KEY `IDX_808D9EB0EBB40B` (`id_trabajador`),
  CONSTRAINT `FK_808D9EA9B48B80` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_808D9EB0EBB40B` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (63,36,32,14,'2024-12-03','Tarjeta',623.00),(64,36,32,16,'2024-12-03','Efectivo',154.00),(65,36,32,18,'2024-12-03','Tarjeta',130.00),(66,36,32,19,'2024-12-03','Tarjeta',222.00),(67,36,32,20,'2024-12-04','Bizum',269.00),(68,36,32,21,'2024-12-04','Tarjeta',215.00),(69,32,30,22,'2024-12-04','Tarjeta',447.00),(70,36,32,23,'2024-12-05','Tarjeta',65.00),(71,36,32,24,'2024-12-05','Bizum',684.00),(72,36,32,25,'2024-12-06','Bizum',1565.00);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_servicios`
--

DROP TABLE IF EXISTS `ventas_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NOT NULL,
  `id_servicio` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_servicios_ibfk_1` (`id_venta`),
  KEY `ventas_servicios_ibfk_2` (`id_servicio`),
  CONSTRAINT `ventas_servicios_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ventas_servicios_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_servicios`
--

LOCK TABLES `ventas_servicios` WRITE;
/*!40000 ALTER TABLE `ventas_servicios` DISABLE KEYS */;
INSERT INTO `ventas_servicios` VALUES (33,63,9,4,89.00,356.00),(34,63,9,3,89.00,267.00),(35,64,9,1,89.00,89.00),(36,64,8,1,65.00,65.00),(37,65,8,1,65.00,65.00),(38,65,8,1,65.00,65.00),(39,66,6,1,180.00,180.00),(40,66,10,1,42.00,42.00),(41,67,9,1,89.00,89.00),(42,67,6,1,180.00,180.00),(43,68,9,1,89.00,89.00),(44,68,7,3,42.00,126.00),(45,69,6,1,180.00,180.00),(46,69,9,3,89.00,267.00),(47,70,8,1,65.00,65.00),(52,71,12,1,34.00,34.00),(53,71,8,10,65.00,650.00),(56,72,133,1,1500.00,1500.00),(57,72,8,1,65.00,65.00);
/*!40000 ALTER TABLE `ventas_servicios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 17:11:07
