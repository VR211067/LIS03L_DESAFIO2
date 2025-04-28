-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-04-2025 a las 05:48:49
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `textil_export`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Camisetas'),
(2, 'Sudaderas y Hoodies'),
(3, 'Ropa Corporativa y Uniformes'),
(4, 'Ropa Deportiva'),
(5, 'Ropa Infantil y Escolar'),
(6, 'Accesorios Textiles'),
(7, 'Gorras y Sombreros Personalizados'),
(8, 'Tazas y Termos '),
(9, 'Llaveros y Pulseras'),
(10, 'Artículos de Oficina'),
(11, 'Textiles Promocionales'),
(12, 'Zapatos\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `password`, `activo`) VALUES
(1, 'nemesis valencia', 'nemesis-alejandra@outlook.com', '$2y$10$HGXpsD.qEiw21Vny0bl8buSL9FO4LKlhs95D0BpDExm05t3hU5VOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `venta_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 2, 1, 1, 8.99),
(2, 2, 3, 1, 9.99),
(3, 3, 1, 1, 8.99),
(4, 3, 3, 1, 9.99),
(5, 4, 1, 1, 8.99),
(6, 4, 3, 1, 9.99),
(7, 5, 1, 1, 8.99),
(8, 5, 3, 1, 9.99),
(9, 6, 1, 1, 8.99),
(10, 6, 3, 1, 9.99),
(11, 7, 1, 1, 8.99),
(12, 7, 3, 1, 9.99),
(13, 8, 1, 1, 8.99),
(14, 8, 3, 1, 9.99),
(15, 9, 1, 1, 8.99),
(16, 9, 3, 1, 9.99),
(17, 10, 1, 1, 8.99),
(18, 10, 3, 1, 9.99),
(19, 11, 1, 1, 8.99),
(20, 11, 3, 1, 9.99),
(21, 12, 14, 1, 6.99),
(22, 12, 5, 3, 44.99),
(23, 12, 6, 5, 44.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencias` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `imagen`, `categoria_id`, `precio`, `existencias`) VALUES
(1, 'PROD0001', 'Gorra One Piece', 'Gorra con el emblema del anime One Piece bordada color negro.', 'GorraONEPIECE.jpg', 7, 8.99, 25),
(3, 'PROD0002', 'Gorra Demon Slayer', 'Gorra de color blanco y rosado del anime Demon Slayer', 'gorraKNY.jpg', 7, 9.99, 25),
(5, 'PROD0003', 'Camiseta Barcelona', 'Camiseta original de la temporada 24/25', 'Camiseta Barca.jpg', 1, 44.99, 25),
(6, 'PROD0004', 'Camiseta Real Madrid', 'Camiseta original de la temporada 24/25', 'Camiseta Madrid.webp', 1, 44.99, 25),
(7, 'PROD0005', 'Sudadera de Capucha', 'Sudadera color amarillo con mangas cortas', 'Sudadera Amarrilla.jpg', 2, 17.99, 20),
(8, 'PROD0006', 'Hoodie', 'Hoodie unisex color negro', 'Sudadera Negra.jpg', 2, 15.99, 20),
(9, 'PROD0007', 'Uniforme ', 'Uniforme para enfermeras color azul', 'Uniforme.jpg', 3, 29.99, 15),
(10, 'PROD0008', 'Vector Premium', 'Ropa deportiva para hombre y mujer', 'Ropa deportiva 2.avif', 4, 12.99, 18),
(11, 'PROD0009', 'Conjunto Deportivo', 'Camisola y pans para ejercicio', 'Ropa deportiva.jpg', 4, 17.99, 20),
(12, 'PROD0010', 'Uniforme escolar', 'Uniforme rojo y azul ', 'Uniforme escolar.png', 5, 12.99, 35),
(13, 'PROD0011', 'Conjunto Mickey Mouse', 'Conjunto para bebes con bordado de Mickey Mouse', 'Ropa infantil.jpg', 5, 9.99, 15),
(14, 'PROD0012', 'Tejidos de seda', 'Tejidos de seda de multiples colores', 'textiles.jpg', 6, 6.99, 35),
(15, 'PROD0013', 'Tazas ', 'Tazas promocionales de distintos colores ', 'Taza.webp', 8, 7.99, 25),
(16, 'PROD0014', 'Termos', 'Termos promocionales de distintos colores ', 'termo.webp', 8, 14.99, 25),
(17, 'PROD0015', 'Llaveros', 'Llaveros 3D personalizados ', 'Llaveros.webp', 9, 2.99, 35),
(18, 'PROD0016', 'Pulseras Personalizada', 'Set de pulseras del yin yang', 'pulsera.webp', 9, 14.99, 8),
(19, 'PROD0017', 'Engrapadora', 'Engrapadora Metálica de Escritorio Isofit CM-70', 'Engrapadora.jpg', 10, 8.99, 7),
(21, 'PROD0018', 'Lampara', 'Lámpara De Escritorio Plástico Negro', 'lampara.webp', 10, 9.99, 12),
(22, 'PROD00019', 'Zapatos Futbol', 'Tenis para futbol sala color negro', 'Zapatos.avif', 12, 14.99, 16),
(23, 'PROD0020', 'Botas', 'Botas industrial Hercules color cafe para Hombre', 'botas.webp', 12, 74.99, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('admin','empleado') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `rol`) VALUES
(1, 'nemesis valencia', 'admin1', '$2y$10$60h.O.YjwRG//KUy4/RS9eANzUqCB6oEugOakJodM0EQP/Hmys.yG', 'admin'),
(2, 'alejandra rivera', 'emple1', '$2y$10$2JKZXG8aElXmTpRn4LYCq.H1LYQX4bNP1YD4ox67/TfOjHgiX/61C', 'empleado'),
(3, 'Luis', 'Lucho', '$2y$10$gvu40fPZb26gvwiMzv3FH.Vwsssr.sQf046qrXwhkEzlhJgUfZpn6', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) DEFAULT NULL,
  `comprobante_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cliente_id`, `fecha`, `total`, `comprobante_pdf`) VALUES
(1, 1, '2025-04-19 20:12:28', 18.98, NULL),
(2, 1, '2025-04-19 20:17:27', 18.98, NULL),
(3, 1, '2025-04-19 20:21:59', 18.98, 'comp-1745115719.pdf'),
(4, 1, '2025-04-19 20:29:15', 18.98, 'comp-1745116157.pdf'),
(5, 1, '2025-04-19 20:31:45', 18.98, 'comp-1745116305.pdf'),
(6, 1, '2025-04-19 20:33:41', 18.98, 'comp-1745116421.pdf'),
(7, 1, '2025-04-19 20:35:04', 18.98, 'comp-1745116504.pdf'),
(8, 1, '2025-04-19 20:37:55', 18.98, 'comp-1745116675.pdf'),
(9, 1, '2025-04-19 20:47:13', 18.98, 'comp-1745117233.pdf'),
(10, 1, '2025-04-19 20:51:02', 18.98, 'comp-1745117462.pdf'),
(11, 1, '2025-04-23 22:12:05', 18.98, 'comp-1745467928.pdf'),
(12, 1, '2025-04-23 23:32:11', 366.91, 'comp-1745472732.pdf');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
