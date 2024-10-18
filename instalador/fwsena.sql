-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 17:41:55
-- Versión del servidor: 8.0.34
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fwsena`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `sumar` (`num1` INT, `num2` INT) RETURNS INT DETERMINISTIC BEGIN
RETURN num1 + num2;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrito`
--

CREATE TABLE `tb_carrito` (
  `id_ca` int NOT NULL,
  `nombre_producto` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cantidad_pro` int NOT NULL,
  `precio_pro` float NOT NULL,
  `fecha_agre` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_carrito`
--

INSERT INTO `tb_carrito` (`id_ca`, `nombre_producto`, `cantidad_pro`, `precio_pro`, `fecha_agre`) VALUES
(25, 'zapatillas ', 3, 89000, '2024-10-01 19:48:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id_categoria` int NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Ropa para Damas y caballeros'),
(3, 'ropa infantil'),
(4, 'calzado para todos'),
(5, 'accesorios'),
(7, 'gorras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_conteo_eli`
--

CREATE TABLE `tb_conteo_eli` (
  `id_conteo` int NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_conteo_eli`
--

INSERT INTO `tb_conteo_eli` (`id_conteo`, `descripcion`, `conteo`, `fec_reg`) VALUES
(1, 'Se ha eliminado el usuario: maria con el documento: 12345', 1, '2024-09-07 22:44:53'),
(2, 'Se ha eliminado el usuario: marcela con el documento: 123456', 1, '2024-09-07 22:45:04'),
(3, 'Se ha eliminado el usuario: maria con el documento: 1235', 1, '2024-09-07 22:45:16'),
(4, 'Se ha eliminado el usuario: ronal con el documento: 159', 1, '2024-09-07 22:45:28'),
(5, 'Se ha eliminado el usuario: cindy con el documento: 123', 1, '2024-09-07 22:45:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_conteo_productos`
--

CREATE TABLE `tb_conteo_productos` (
  `id_conteo` int NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_conteo_productos`
--

INSERT INTO `tb_conteo_productos` (`id_conteo`, `descripcion`, `conteo`, `fec_reg`) VALUES
(1, 'Se ha eliminado el producto: vestido con el ID: 3', 1, '2024-09-02 17:37:13'),
(2, 'Se ha eliminado el producto: vestido con el ID: 12', 1, '2024-09-06 19:54:53'),
(3, 'Se ha eliminado el producto: maria con el ID: 7', 1, '2024-09-06 20:10:35'),
(4, 'Se ha eliminado el producto: maria con el ID: 8', 1, '2024-09-06 20:10:42'),
(5, 'Se ha eliminado el producto: camisa con el ID: 9', 1, '2024-09-06 20:34:14'),
(6, 'Se ha eliminado el producto: CAMISA con el ID: 10', 1, '2024-09-06 22:42:29'),
(7, 'Se ha eliminado el producto: maria con el ID: 11', 1, '2024-09-06 22:42:32'),
(8, 'Se ha eliminado el producto: 0 con el ID: 12', 1, '2024-09-06 22:42:38'),
(9, 'Se ha eliminado el producto: 0 con el ID: 13', 1, '2024-09-06 23:23:08'),
(10, 'Se ha eliminado el producto: 0 con el ID: 14', 1, '2024-09-06 23:23:12'),
(11, 'Se ha eliminado el producto: 0 con el ID: 15', 1, '2024-09-06 23:23:15'),
(12, 'Se ha eliminado el producto: 0 con el ID: 16', 1, '2024-09-07 12:42:09'),
(13, 'Se ha eliminado el producto: 0 con el ID: 17', 1, '2024-09-07 12:47:58'),
(14, 'Se ha eliminado el producto: camisa con el ID: 18', 1, '2024-09-09 16:19:44'),
(15, 'Se ha eliminado el producto: zapatos  con el ID: 21', 1, '2024-09-09 16:28:53'),
(16, 'Se ha eliminado el producto: aretes con el ID: 2', 1, '2024-09-09 16:30:42'),
(17, 'Se ha eliminado el producto: vestido para dama con el ID: 1', 1, '2024-09-09 16:31:15'),
(18, 'Se ha eliminado el producto: camisa con el ID: 3', 1, '2024-09-09 17:01:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_conteo_reg`
--

CREATE TABLE `tb_conteo_reg` (
  `id_conteo` int NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conteo` int NOT NULL,
  `fec_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_conteo_reg`
--

INSERT INTO `tb_conteo_reg` (`id_conteo`, `descripcion`, `conteo`, `fec_reg`) VALUES
(1, 'Se ha registrado el usuario: Salvador  con el documento: 1029800016', 1, '2024-09-06 20:58:46'),
(2, 'Se ha registrado el usuario: andri con el documento: 1120571819', 1, '2024-09-09 16:02:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_facturas`
--

CREATE TABLE `tb_facturas` (
  `id_factura` int NOT NULL,
  `documento` int DEFAULT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_factura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `direccion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_facturas`
--

INSERT INTO `tb_facturas` (`id_factura`, `documento`, `metodo_pago`, `fecha_factura`, `direccion`, `telefono`, `total`) VALUES
(1, 123456, 'tarjeta', NULL, 'BICENTENARIO 2', '7484848', 245000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_favoritos`
--

CREATE TABLE `tb_favoritos` (
  `id_favo` int NOT NULL,
  `nombre_produc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cantidad_fav` int NOT NULL,
  `fecga_agreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_favoritos`
--

INSERT INTO `tb_favoritos` (`id_favo`, `nombre_produc`, `cantidad_fav`, `fecga_agreg`) VALUES
(6, 'accesorio', 2, '2024-10-01 19:56:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_fecha_especial`
--

CREATE TABLE `tb_fecha_especial` (
  `id` int NOT NULL,
  `evento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `color_evento` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_fecha_especial`
--

INSERT INTO `tb_fecha_especial` (`id`, `evento`, `fecha_inicio`, `fecha_fin`, `color_evento`) VALUES
(5, 'dia de la madre', '2024-09-14', '2024-09-06', 'naranja'),
(6, 'festival yurupary de oro', '2024-09-30', '2024-10-01', 'amarillo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_imagenes`
--

CREATE TABLE `tb_imagenes` (
  `id` int NOT NULL,
  `nombre_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ruta_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_likes`
--

CREATE TABLE `tb_likes` (
  `id_like` int NOT NULL,
  `producto_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `valor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `id_producto` int NOT NULL,
  `nombre_producto` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL,
  `detalles` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tallas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ruta_img` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_categoria` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`id_producto`, `nombre_producto`, `precio`, `cantidad`, `detalles`, `color`, `tallas`, `ruta_img`, `id_categoria`) VALUES
(25, 'cadena', 45000, 2, 'esta es una cadena', 'plata', 'unica', '../img/accesosio2.png', 5),
(27, 'zapatillas ', 89000, 1, 'estas son unas zapatillas', 'blanco', 'talla 38', '../img/zapatillas.png', 4),
(30, 'accesorio', 56000, 2, 'esto es un accesorio', 'plata', '23', '../img/accesorio1.png', 5),
(31, 'gorra para hombre', 34000, 2, 'esta es una gorra para caballero de un buen material', 'negro', 'talla M', '../img/gorrass.png,../img/int.png', 7);

--
-- Disparadores `tb_productos`
--
DELIMITER $$
CREATE TRIGGER `contando_pro_eliminado` AFTER DELETE ON `tb_productos` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_productos (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha eliminado el producto: ', OLD.nombre_producto, ' con el ID: ', OLD.id_producto), 1, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `documento` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contraseña` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`documento`, `nombre`, `apellido`, `correo`, `contraseña`, `fecha`, `foto`, `rol`) VALUES
(12345, 'maria', 'perez', 'maria@gmail.com', '$2y$12$dsOJ6AfWm/oB41LfzXQi7OIxuoplqto90ZJVHDI8lNOMS.hGIqUvi', '2024-09-30 14:47:13', NULL, '1'),
(123456, 'pepito', 'perez', 'pepito@gmail.com', '$2y$12$rtAxYGnb7AywWOtRpH0C2OiRjJ07XTT4DVERbpHC0f/OO/jf7Expa', '2024-10-01 13:09:59', '66fc588fef42f.png', '1'),
(1029800016, 'Salvador ', 'Pores', 'luiszapata2051@gmail.com', '$2y$12$KWD6YAqkU8rN6RJmkaXFbugSuiW4Su0HhoqYcEtdA2voGVmZ9y3qS', '2024-10-07 23:44:28', NULL, '1'),
(1120561506, 'mayra', 'simon', 'mayrahs760@gmail.com', '$2y$12$XZ0AoWsz6TX/oqEE8d7Uve0BMvXF71YRcQRjwVibdWXnDUxlGh3f2', '2024-09-30 14:22:45', '66fafa9ab8236.png', '0');

--
-- Disparadores `tb_usuarios`
--
DELIMITER $$
CREATE TRIGGER `contando_eliminar_user` AFTER DELETE ON `tb_usuarios` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_eli (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha eliminado el usuario: ', OLD.nombre, ' con el documento: ', OLD.documento), 1, NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `contando_registro_user` AFTER INSERT ON `tb_usuarios` FOR EACH ROW BEGIN 
    INSERT INTO tb_conteo_reg (descripcion, conteo, fec_reg)
    VALUES (CONCAT('Se ha registrado el usuario: ', NEW.nombre, ' con el documento: ', NEW.documento), 1, NOW());
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD PRIMARY KEY (`id_ca`);

--
-- Indices de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_conteo_eli`
--
ALTER TABLE `tb_conteo_eli`
  ADD PRIMARY KEY (`id_conteo`);

--
-- Indices de la tabla `tb_conteo_productos`
--
ALTER TABLE `tb_conteo_productos`
  ADD PRIMARY KEY (`id_conteo`);

--
-- Indices de la tabla `tb_conteo_reg`
--
ALTER TABLE `tb_conteo_reg`
  ADD PRIMARY KEY (`id_conteo`);

--
-- Indices de la tabla `tb_facturas`
--
ALTER TABLE `tb_facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `documento` (`documento`);

--
-- Indices de la tabla `tb_favoritos`
--
ALTER TABLE `tb_favoritos`
  ADD PRIMARY KEY (`id_favo`);

--
-- Indices de la tabla `tb_fecha_especial`
--
ALTER TABLE `tb_fecha_especial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_imagenes`
--
ALTER TABLE `tb_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_likes`
--
ALTER TABLE `tb_likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_producto` (`producto_id`);

--
-- Indices de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  MODIFY `id_ca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_conteo_eli`
--
ALTER TABLE `tb_conteo_eli`
  MODIFY `id_conteo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_conteo_productos`
--
ALTER TABLE `tb_conteo_productos`
  MODIFY `id_conteo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tb_conteo_reg`
--
ALTER TABLE `tb_conteo_reg`
  MODIFY `id_conteo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_facturas`
--
ALTER TABLE `tb_facturas`
  MODIFY `id_factura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_favoritos`
--
ALTER TABLE `tb_favoritos`
  MODIFY `id_favo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_fecha_especial`
--
ALTER TABLE `tb_fecha_especial`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_imagenes`
--
ALTER TABLE `tb_imagenes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_likes`
--
ALTER TABLE `tb_likes`
  MODIFY `id_like` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_facturas`
--
ALTER TABLE `tb_facturas`
  ADD CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `tb_usuarios` (`documento`);

--
-- Filtros para la tabla `tb_likes`
--
ALTER TABLE `tb_likes`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_likes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`documento`);

--
-- Filtros para la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
