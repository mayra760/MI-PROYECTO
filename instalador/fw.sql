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
  `nombre_producto` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cantidad_pro` int NOT NULL,
  `precio_pro` float NOT NULL,
  `fecha_agre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ca`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carrito`
--

LOCK TABLES `tb_carrito` WRITE;
/*!40000 ALTER TABLE `tb_carrito` DISABLE KEYS */;
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
  `categoria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
INSERT INTO `tb_categoria` VALUES (1,'Ropa para Damas y caballeros'),(3,'ropa infantil'),(4,'calzado para todos'),(5,'accesorios'),(6,'sabanas');
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
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
-- Table structure for table `tb_detalle_factura`
--

DROP TABLE IF EXISTS `tb_detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_detalle_factura` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` float NOT NULL,
  `subtotal` float NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_factura` (`id_factura`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tb_detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `tb_facturas` (`id_factura`),
  CONSTRAINT `tb_detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detalle_factura`
--

LOCK TABLES `tb_detalle_factura` WRITE;
/*!40000 ALTER TABLE `tb_detalle_factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_facturas`
--

DROP TABLE IF EXISTS `tb_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_facturas` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `documento_usuario` int NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_factura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_facturas`
--

LOCK TABLES `tb_facturas` WRITE;
/*!40000 ALTER TABLE `tb_facturas` DISABLE KEYS */;
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
  `nombre_produc` varchar(50) NOT NULL,
  `cantidad_fav` int NOT NULL,
  `fecga_agreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_favo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_favoritos`
--

LOCK TABLES `tb_favoritos` WRITE;
/*!40000 ALTER TABLE `tb_favoritos` DISABLE KEYS */;
INSERT INTO `tb_favoritos` VALUES (4,'aretes',1,'2024-08-27 02:18:12');
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
  `evento` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `color_evento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fecha_especial`
--

LOCK TABLES `tb_fecha_especial` WRITE;
/*!40000 ALTER TABLE `tb_fecha_especial` DISABLE KEYS */;
INSERT INTO `tb_fecha_especial` VALUES (5,'dia de la madre','2024-09-14','2024-09-06','naranja');
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
  `nombre_imagen` varchar(255) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL,
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `producto_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `valor` varchar(20) NOT NULL,
  PRIMARY KEY (`id_like`),
  KEY `producto_id` (`producto_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tb_likes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `tb_likes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_likes`
--

LOCK TABLES `tb_likes` WRITE;
/*!40000 ALTER TABLE `tb_likes` DISABLE KEYS */;
INSERT INTO `tb_likes` VALUES (3,5,1235,'like'),(10,5,12345,'like'),(14,6,159,'like'),(15,5,159,'like'),(17,4,1029800016,'like'),(18,19,1120571819,'like');
/*!40000 ALTER TABLE `tb_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lista_deseos`
--

DROP TABLE IF EXISTS `tb_lista_deseos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lista_deseos` (
  `id_deseo` int NOT NULL AUTO_INCREMENT,
  `documento` int NOT NULL,
  `nombre_producto` varchar(150) NOT NULL,
  `foto_referencia` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_deseo`),
  KEY `documento_usuario` (`documento`),
  CONSTRAINT `tb_lista_deseos_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lista_deseos`
--

LOCK TABLES `tb_lista_deseos` WRITE;
/*!40000 ALTER TABLE `tb_lista_deseos` DISABLE KEYS */;
INSERT INTO `tb_lista_deseos` VALUES (1,123,'lola','camisa.png','2024-08-14 04:27:26');
/*!40000 ALTER TABLE `tb_lista_deseos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productos`
--

DROP TABLE IF EXISTS `tb_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(150) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL,
  `detalles` varchar(1000) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `tallas` varchar(50) DEFAULT NULL,
  `ruta_img` varchar(250) DEFAULT NULL,
  `id_categoria` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_producto`),
  KEY `fk_categoria` (`id_categoria`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productos`
--

LOCK TABLES `tb_productos` WRITE;
/*!40000 ALTER TABLE `tb_productos` DISABLE KEYS */;
INSERT INTO `tb_productos` VALUES (4,'conjunto de bebe',40000,3,'este es un conjunto para bebe','vinotinto','talla 2','infantil3.png',3),(19,'camisa',34000,2,'esta es una camisa','negro','talla M','../img/camisa.png',1),(20,'cojunto de piezas para hombre',59000,3,'contiene estampado grafico, cuello redondo, manga corta','negro','talla M','../img/hombre3.png',1),(22,'conjunto para  mujer',89000,3,'conjunto de verano para mujer, muy comodo y de una muy buena calidad','blanco','talla s','../img/mujer.png',1),(23,'zapatos ',67000,3,'zapatos para niño para correr de un buen material','azul','talla 30','../img/zapato.png',4),(24,'puños para orejas',4000,5,'set de 5 piezas de puños para orejas de estilo Boho y Hip Hop para Mujer - No Requiere Perforación, Pendientes de Clip de Hierro para Uso Diario y Fiestas','dorado','unica','../img/accesorio1.png',5);
/*!40000 ALTER TABLE `tb_productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `contando_pro_eliminado` AFTER DELETE ON `tb_productos` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_productos (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha eliminado el producto: ', OLD.nombre_producto, ' con el ID: ', OLD.id_producto), 1, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_usuarios` (
  `documento` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(2000) DEFAULT NULL,
  `rol` int NOT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (1029800016,'Salvador ','Pores','sg6184915@gmail.com','$2y$12$xYFm9yP7XIXcc9oHS5xDeudOq93mUqWnb.bmRsHGN079KF9p06JHq','0000-00-00 00:00:00',NULL,1),(1120561506,'mayra','simon','mayrahs760@gmail.com','$2y$12$3Ke4O3QGl8Rt/PFt9bdZO.mH8cZPeExxWmwpbUm.TX1K1PCB5vpqW','2005-03-14 00:00:00','66d622b6514cc.png',0),(1120571819,'andri','vargas','andri@gmail.com','$2y$12$j3v/L.YOAeeKjRuKQTiu4edPxf.BsG/5IArei68xyQCIHceckZwky','2024-09-09 21:02:19',NULL,1);
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `contando_registro_user` AFTER INSERT ON `tb_usuarios` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_reg (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha registrado el usuario: ', NEW.nombre, ' con el documento: ', NEW.documento), 1, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `contando_eliminar_user` AFTER DELETE ON `tb_usuarios` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_eli (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha eliminado el usuario: ', OLD.nombre, ' con el documento: ', OLD.documento), 1, NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `vista_productos_likes`
--

DROP TABLE IF EXISTS `vista_productos_likes`;
/*!50001 DROP VIEW IF EXISTS `vista_productos_likes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_productos_likes` AS SELECT 
 1 AS `id_producto`,
 1 AS `nombre_producto`,
 1 AS `precio`,
 1 AS `cantidad`,
 1 AS `detalles`,
 1 AS `color`,
 1 AS `tallas`,
 1 AS `ruta_img`,
 1 AS `total_likes`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'fw'
--

--
-- Dumping routines for database 'fw'
--

--
-- Final view structure for view `vista_productos_likes`
--

/*!50001 DROP VIEW IF EXISTS `vista_productos_likes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_productos_likes` AS select `p`.`id_producto` AS `id_producto`,`p`.`nombre_producto` AS `nombre_producto`,`p`.`precio` AS `precio`,`p`.`cantidad` AS `cantidad`,`p`.`detalles` AS `detalles`,`p`.`color` AS `color`,`p`.`tallas` AS `tallas`,`p`.`ruta_img` AS `ruta_img`,count(`l`.`id_like`) AS `total_likes` from (`tb_productos` `p` left join `tb_likes` `l` on((`p`.`id_producto` = `l`.`producto_id`))) group by `p`.`id_producto` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-09 18:18:11
