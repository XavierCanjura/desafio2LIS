-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2022 a las 04:38:16
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `textil_export_db`
--
CREATE DATABASE IF NOT EXISTS `textil_export_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `textil_export_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Textil'),
(2, 'Promocional'),
(3, 'Recio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_factura`
--

CREATE TABLE `detalles_factura` (
  `codigo_producto_FK` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `id_factura_FK` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_usuario_FK` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo_producto` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `id_categoria_FK` int(11) NOT NULL,
  `existencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo_producto`, `nombre`, `descripcion`, `imagen`, `precio`, `id_categoria_FK`, `existencias`) VALUES
('PROD00001', 'Camiseta de algodón cuello redondo', 'Camiseta Mod. 1, elaborada en algodón de 200 grs. cuello redondo decorado, manga corta, costuras en cierres laterales.', 'PROD00001.jpg', '2.50', 1, 0),
('PROD00002', 'Camiseta de algodón cuello redondo', 'Camiseta Mod. 1, elaborada en algodón de 200 grs. cuello redondo decorado, manga corta, costuras en cierres laterales.', 'PROD00002.jpg', '2.50', 3, 462),
('PROD00003', 'Sudadera de algodón', 'Sudadera para adulto en combinación de materiales algodon y polister de 280g/m2, cuello redondo, sin gorro.', 'PROD00003.jpg', '10.0', 1, 4),
('PROD00004', 'Sudadera con zipper', 'Sudadera para adulto con capucha y cierre de central de zipper. En combinacion de materiales algodon y poliester de 280g/m2. Con cordones    a juego y 2 bolsas frontales. Material: 50% Algodon, 50% Poliester', 'PROD00004.jpg', '13.00', 1, 196),
('PROD00005', 'Blusa Tipo Polo', 'Blusa Tipo Polo en Liquidacion, diversa gama de colores con cuello en contraste.', 'PROD00005.jpg', '5.00', 1, 500),
('PROD00006', 'Camisa Tipo Polo', 'Camisa Tipo Polo en Liquidacion, diversa gama de colores con cuello en contraste.', 'PROD00006.jpg', '5.00', 1, 28),
('PROD00007', 'Chaleco', 'Chaleco en resistente combinacion de materiales algodon y poliester de vivos colores. Cierre de zipper principal, multitud de bolsillos frontales y laterales de gran capacidad con cierre de velcro y anilla metalica en el pecho.', 'PROD00007.jpg', '20.00', 1, 15),
('PROD00008', 'Mandil', 'Mandil pro de alta calidad en resistente material 100% algodon canvas de 340g/m2. De corte por debajo de la rodilla, con cintas de cuello y cintura en resistente polipiel con ajuste mediante hebilla y reforzado con remaches metalicos. Incluye multitud de bolsillos para los distintos utensilios, con las costuras reforzadas.', 'PROD00008.jpg', '12.00', 1, 25),
('PROD00009', 'Squeeze', 'Squeeze con cuerpo de acabado en aluminio en vivos y variados colores. Con tapon de rosca, dosificados de seguridad y tapon de cierre. Presentado en caja individual.', 'PROD00009.jpg', '3.50', 2, 210),
('PROD00010', 'Squeeze de sublimacion', 'Squeeze con cuerpo de acabado en suave y brillante color blanco, especialmente dise&#xF1;ado para marcaje en sublimacion. Con tapon de seguridad a rosca y mosqueton metalico de transporte. Presentado en caja individual.', 'PROD00010.jpg', '3.35', 2, 28),
('PROD00011', 'Taza', 'Taza de Linea Ecologica color Natural.', 'PROD00011.jpg', '1.30', 2, 500),
('PROD00012', 'Termo de sublimacion', 'Termo de 500ml de capacidad en resistente acero inoxidable. Superficie exterior especialmente diseñada para sublimacion. Con tapoon de seguridad y presentado en atractiva caja individual de diseño', 'PROD00012.jpg', '9.00', 2, 0),
('PROD00013', 'Gorra de algodon', 'Gorra sin impresion, importada, 100% algodon, 6 paneles con ojetes, cierre de hebilla, viñeta interior generica bordada. Talla unica de adulto.', 'PROD00013.jpg', '2.50', 2, 500),
('PROD00014', 'Gorra de poliester', 'Gorra de 5 paneles con visera plana acolchada y parte trasera en redecilla a juego. Material 100% poliester de suave acabado, con cierre ajustable de botones y en variada gama de vivos colores.', 'PROD00014.jpg', '2.75', 2, 500),
('PROD00015', 'Mochila', 'Mochila en acabado denim 600D, de dise&#xF1;o urbano, con acolchado total en todo el cuerpo y cintas de hombros. Bolsa exterior con cierre de zipper, asas de transporte y cintas de hombros reforzadas a juego y compartimento interior acolchado para portatil de hasta 15 pulgadas.', 'PROD00015.jpg', '12.00', 2, 500),
('PROD00016', 'Power Bank', 'Bater&#xED;a auxiliar externa de aluminio en llamativos colores de 2.200 mAh de capacidad de carga, con bot&#xF3;n y ledes indicadores de carga. Cable micro USB incluido y amplia superficie de marcaje, Presentada en atractiva caja de diseño. Las capacidades mostradas en todas nuestras baterias auxiliares externas son reales, incorporando todas ellas baterias de grado A y no recicladas, con una vida &#xFA;til de al menos 500 ciclos de carga y segan normativa CE. Ademas, estan fabricadas conforme a los estandares RoHS y en cumplimiento con los siguientes requisitos de seguridad: Sistema de proteccion contra sobrecarga del power bank. Sistema de protecci&#xF3;n contra descarga completa que proporciona una mayor durabilidad del power bank. Sistema de bloqueo para evitar cortocircuitos. Sistema de transferencia de carga constante, acorde con la capacidad del dispositivo de destino.', 'PROD00016.jpg', '5.50', 2, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_usuario_FK` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `correo`, `usuario`, `password`, `id_tipo_usuario_FK`, `estado`) VALUES
(1, 'Fernando Xavier', 'Maldonado Canjura', 'xavier6@gmail.com', 'Xavier6', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a', 1, 1),
(2, 'Xavier', 'Canjura', 'xavier6@gmail.com', 'Xavier6', '12345678', 2, 1),
(3, 'Xavier', 'Maldonado Canjura', 'xavier8@gmail.com', 'Xavier6', '12345678', 3, 0),
(5, 'Fernando', 'Maldonado', 'fernan16@gmail.com', 'Fernan16', '12345678', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles_factura`
--
ALTER TABLE `detalles_factura`
  ADD KEY `codigo_producto_FK` (`codigo_producto_FK`),
  ADD KEY `id_factura_FK` (`id_factura_FK`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_usuario_FK` (`id_usuario_FK`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_categoria_FK` (`id_categoria_FK`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario_FK` (`id_tipo_usuario_FK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_factura`
--
ALTER TABLE `detalles_factura`
  ADD CONSTRAINT `detalles_factura_ibfk_2` FOREIGN KEY (`id_factura_FK`) REFERENCES `facturas` (`id_factura`),
  ADD CONSTRAINT `detalles_factura_ibfk_3` FOREIGN KEY (`codigo_producto_FK`) REFERENCES `productos` (`codigo_producto`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_usuario_FK`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria_FK`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario_FK`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
