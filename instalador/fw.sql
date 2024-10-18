-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: fw
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `tb_carrito`
--

DROP TABLE IF EXISTS `tb_carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carrito` (
  `id_ca` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cantidad_pro` int NOT NULL,
  `precio_pro` float NOT NULL,
  `fecha_agre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ca`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carrito`
--

LOCK TABLES `tb_carrito` WRITE;
/*!40000 ALTER TABLE `tb_carrito` DISABLE KEYS */;
INSERT INTO `tb_carrito` VALUES (25,'zapatillas ',3,89000,'2024-10-01 19:48:23');
/*!40000 ALTER TABLE `tb_carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
INSERT INTO `tb_categoria` VALUES (1,'Ropa para Damas y caballeros'),(3,'ropa infantil'),(4,'calzado para todos'),(5,'accesorios'),(7,'gorras');
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_eli`
--

DROP TABLE IF EXISTS `tb_conteo_eli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_eli` (
  `id_conteo` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_eli`
--

LOCK TABLES `tb_conteo_eli` WRITE;
/*!40000 ALTER TABLE `tb_conteo_eli` DISABLE KEYS */;
INSERT INTO `tb_conteo_eli` VALUES (1,'Se ha eliminado el usuario: maria con el documento: 12345',1,'2024-09-07 22:44:53'),(2,'Se ha eliminado el usuario: marcela con el documento: 123456',1,'2024-09-07 22:45:04'),(3,'Se ha eliminado el usuario: maria con el documento: 1235',1,'2024-09-07 22:45:16'),(4,'Se ha eliminado el usuario: ronal con el documento: 159',1,'2024-09-07 22:45:28'),(5,'Se ha eliminado el usuario: cindy con el documento: 123',1,'2024-09-07 22:45:42');
/*!40000 ALTER TABLE `tb_conteo_eli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_productos`
--

DROP TABLE IF EXISTS `tb_conteo_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_productos` (
  `id_conteo` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_productos`
--

LOCK TABLES `tb_conteo_productos` WRITE;
/*!40000 ALTER TABLE `tb_conteo_productos` DISABLE KEYS */;
INSERT INTO `tb_conteo_productos` VALUES (1,'Se ha eliminado el producto: vestido con el ID: 3',1,'2024-09-02 17:37:13'),(2,'Se ha eliminado el producto: vestido con el ID: 12',1,'2024-09-06 19:54:53'),(3,'Se ha eliminado el producto: maria con el ID: 7',1,'2024-09-06 20:10:35'),(4,'Se ha eliminado el producto: maria con el ID: 8',1,'2024-09-06 20:10:42'),(5,'Se ha eliminado el producto: camisa con el ID: 9',1,'2024-09-06 20:34:14'),(6,'Se ha eliminado el producto: CAMISA con el ID: 10',1,'2024-09-06 22:42:29'),(7,'Se ha eliminado el producto: maria con el ID: 11',1,'2024-09-06 22:42:32'),(8,'Se ha eliminado el producto: 0 con el ID: 12',1,'2024-09-06 22:42:38'),(9,'Se ha eliminado el producto: 0 con el ID: 13',1,'2024-09-06 23:23:08'),(10,'Se ha eliminado el producto: 0 con el ID: 14',1,'2024-09-06 23:23:12'),(11,'Se ha eliminado el producto: 0 con el ID: 15',1,'2024-09-06 23:23:15'),(12,'Se ha eliminado el producto: 0 con el ID: 16',1,'2024-09-07 12:42:09'),(13,'Se ha eliminado el producto: 0 con el ID: 17',1,'2024-09-07 12:47:58'),(14,'Se ha eliminado el producto: camisa con el ID: 18',1,'2024-09-09 16:19:44'),(15,'Se ha eliminado el producto: zapatos  con el ID: 21',1,'2024-09-09 16:28:53'),(16,'Se ha eliminado el producto: aretes con el ID: 2',1,'2024-09-09 16:30:42'),(17,'Se ha eliminado el producto: vestido para dama con el ID: 1',1,'2024-09-09 16:31:15'),(18,'Se ha eliminado el producto: camisa con el ID: 3',1,'2024-09-09 17:01:56');
/*!40000 ALTER TABLE `tb_conteo_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_reg`
--

DROP TABLE IF EXISTS `tb_conteo_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_reg` (
  `id_conteo` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_reg`
--

LOCK TABLES `tb_conteo_reg` WRITE;
/*!40000 ALTER TABLE `tb_conteo_reg` DISABLE KEYS */;
INSERT INTO `tb_conteo_reg` VALUES (1,'Se ha registrado el usuario: Salvador  con el documento: 1029800016',1,'2024-09-06 20:58:46'),(2,'Se ha registrado el usuario: andri con el documento: 1120571819',1,'2024-09-09 16:02:19');
/*!40000 ALTER TABLE `tb_conteo_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_facturas`
--

DROP TABLE IF EXISTS `tb_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_facturas` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `documento` int DEFAULT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_factura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `direccion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `documento` (`documento`),
  CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_facturas`
--

LOCK TABLES `tb_facturas` WRITE;
/*!40000 ALTER TABLE `tb_facturas` DISABLE KEYS */;
INSERT INTO `tb_facturas` VALUES (1,123456,'tarjeta',NULL,'BICENTENARIO 2','7484848',245000.00);
/*!40000 ALTER TABLE `tb_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_favoritos`
--

DROP TABLE IF EXISTS `tb_favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_favoritos` (
  `id_favo` int NOT NULL AUTO_INCREMENT,
  `nombre_produc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cantidad_fav` int NOT NULL,
  `fecga_agreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_favo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_favoritos`
--

LOCK TABLES `tb_favoritos` WRITE;
/*!40000 ALTER TABLE `tb_favoritos` DISABLE KEYS */;
INSERT INTO `tb_favoritos` VALUES (6,'accesorio',2,'2024-10-01 19:56:55');
/*!40000 ALTER TABLE `tb_favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fecha_especial`
--

DROP TABLE IF EXISTS `tb_fecha_especial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_fecha_especial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `color_evento` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fecha_especial`
--

LOCK TABLES `tb_fecha_especial` WRITE;
/*!40000 ALTER TABLE `tb_fecha_especial` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_fecha_especial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imagenes`
--

DROP TABLE IF EXISTS `tb_imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_imagenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ruta_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imagenes`
--

LOCK TABLES `tb_imagenes` WRITE;
/*!40000 ALTER TABLE `tb_imagenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_likes`
--

DROP TABLE IF EXISTS `tb_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_likes` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `producto_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `valor` int DEFAULT NULL,
  PRIMARY KEY (`id_like`),
  KEY `usuario_id` (`usuario_id`),
  KEY `fk_producto` (`producto_id`),
  CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `tb_likes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_likes`
--

LOCK TABLES `tb_likes` WRITE;
/*!40000 ALTER TABLE `tb_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productos`
--

DROP TABLE IF EXISTS `tb_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL,
  `detalles` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tallas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ruta_img` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_categoria` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_producto`),
  KEY `fk_categoria` (`id_categoria`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productos`
--

LOCK TABLES `tb_productos` WRITE;
/*!40000 ALTER TABLE `tb_productos` DISABLE KEYS */;
INSERT INTO `tb_productos` VALUES (25,'cadena',45000,2,'esta es una cadena','plata','unica','../img/accesosio2.png',5),(32,'cadena',50000,2,'askjaskjaslklask','negro','talla M','../img/accesorio1.png',5);
/*!40000 ALTER TABLE `tb_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_usuarios` (
  `documento` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contraseña` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`documento`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (12345,'maria','perez','maria@gmail.com','$2y$12$dsOJ6AfWm/oB41LfzXQi7OIxuoplqto90ZJVHDI8lNOMS.hGIqUvi','2024-09-30 14:47:13',NULL,'1'),(123456,'pepito','perez','pepito@gmail.com','$2y$12$rtAxYGnb7AywWOtRpH0C2OiRjJ07XTT4DVERbpHC0f/OO/jf7Expa','2024-10-01 13:09:59','66fc588fef42f.png','1'),(1029800016,'Salvador ','Pores','luiszapata2051@gmail.com','$2y$12$KWD6YAqkU8rN6RJmkaXFbugSuiW4Su0HhoqYcEtdA2voGVmZ9y3qS','2024-10-07 23:44:28',NULL,'1'),(1120561506,'mayra','simon','mayrahs760@gmail.com','$2y$12$XZ0AoWsz6TX/oqEE8d7Uve0BMvXF71YRcQRjwVibdWXnDUxlGh3f2','2024-09-30 14:22:45','67114aff32127.png','0');
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;


-- DELIMITER ;;

-- CREATE TRIGGER `contando_eliminar_user` 
-- AFTER DELETE ON `tb_usuarios` 
-- FOR EACH ROW 
-- BEGIN 
--     INSERT INTO tb_conteo_eli (descripcion, conteo, fec_reg)
--     VALUES (CONCAT('Se ha eliminado el usuario: ', OLD.nombre, ' con el documento: ', OLD.documento), 1, NOW());
-- END;;

-- DELIMITER ;;




-- DELIMITER ;;

-- CREATE TRIGGER `contando_registro_user` 
-- AFTER INSERT ON `tb_usuarios`
-- FOR EACH ROW   
-- BEGIN 
--     INSERT INTO tb_conteo_reg (descripcion, conteo, fec_reg)
--     VALUES (CONCAT('Se ha registrado el usuario: ', NEW.nombre, ' con el documento: ', NEW.documento), 1, NOW());
-- END;;

-- DELIMITER ;;


/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;




/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping events for database 'fw'
--

--
-- Dumping routines for database 'fw'
--
/*!50003 DROP FUNCTION IF EXISTS `sumar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;


-- DELIMITER ;;
-- CREATE DEFINER=`root`@`localhost` FUNCTION `sumar`(n1 INT, n2 INT) RETURNS int
--    DETERMINISTIC
-- BEGIN
--    RETURN n1 + n2;
-- END ;;
-- DELIMITER ;


/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sumar_numeros` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;


-- DELIMITER ;;
-- CREATE DEFINER=`root`@`localhost` PROCEDURE `sumar_numeros`(IN n1 INT, IN n2 INT)
-- BEGIN
--    DECLARE resultado INT; 
--    SET resultado = n1 + n2; 
--    SELECT resultado AS Suma;
-- END ;;
-- DELIMITER ;


/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 11:37:37
