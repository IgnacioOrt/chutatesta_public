-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2020 a las 03:32:54
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chuta`
--
CREATE DATABASE IF NOT EXISTS `chuta` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `chuta`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base_product`
--

DROP TABLE IF EXISTS `base_product`;
CREATE TABLE `base_product` (
  `id_producto_base` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `base_product`
--

INSERT INTO `base_product` (`id_producto_base`, `nombre`, `descripcion`, `precio`) VALUES
(2, 'Uno1', '', 100),
(4, 'Uno2', '', 100),
(5, 'Uno3', '', 100),
(6, 'Uno4', '', 100),
(7, 'Uno5', '', 100),
(10, 'Uno6', '', 100),
(13, 'Carne', '', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_categoria`, `nombre`) VALUES
(2, 'Alitas'),
(6, 'Bebidas'),
(1, 'Burger'),
(4, 'Empanadas'),
(7, 'General'),
(3, 'Hot-Dog'),
(5, 'Papas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `notas` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id_cliente`, `nombre`, `telefono`, `direccion`, `notas`) VALUES
(2, 'JESUS SANTIAR', '8120402051', '4ta privada #8', NULL),
(3, 'CARLOS BETANZOS', '2226707889', 'ZEREZOTLA', NULL),
(4, 'POR LAS VIAS', '2214635895', '6 Ote 813', NULL),
(5, 'ORFIDIA', '2225901406', 'ZEREZOTLA', NULL),
(6, 'VALDOMERO MIRELES', '2226822768', 'ZEREZOTLA', NULL),
(7, 'CLAUDIA GUTIERREZ', '2227075276', 'ZEREZOTLA', NULL),
(8, 'MUCHACHO?', '5517552692', 'ZEREZOTLA', NULL),
(9, 'MUCHACHO DEL OXXO', '2211347291', 'OXXO', NULL),
(10, 'JUAN CARLOS ZURITA', '2225507761', 'NANCHITAL', NULL),
(11, 'SRA DEL SAMS', '2212302284', 'ZEREZOTLA', NULL),
(12, 'OLGA ENRIQUEZ', 'S/N', 'Encinos #7', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `id_ingrediente` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `unidad_de_medida` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` int(11) DEFAULT NULL,
  `id_stock` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_producto_base` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ingredient`
--

INSERT INTO `ingredient` (`id_ingrediente`, `nombre`, `unidad_de_medida`, `cantidad`, `costo`, `id_stock`, `id_producto`, `id_producto_base`) VALUES
(12, 'Pan de hamburguesa', 'Pieza', 1, 100, 2, NULL, 10),
(15, 'Pan de hamburguesa', 'Pieza', 1, 100, 2, NULL, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `id_venta` int(11) NOT NULL,
  `fecha_creacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_item`
--

DROP TABLE IF EXISTS `sale_item`;
CREATE TABLE `sale_item` (
  `id_articulo_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `fecha_de_compra` date DEFAULT NULL,
  `fecha_de_caducidad` date DEFAULT NULL,
  `dias_de_soporte` int(11) DEFAULT NULL,
  `unidad_de_medida` enum('Litro','Kilogramo','Pieza') COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `nombre`, `descripcion`, `cantidad`, `precio`, `id_proveedor`, `fecha_de_compra`, `fecha_de_caducidad`, `dias_de_soporte`, `unidad_de_medida`) VALUES
(2, 'Pan de hamburguesa', '', 10, 100, 0, '2020-05-20', '2020-05-24', 5, 'Pieza'),
(3, 'Carne para hamburguesas', NULL, 10, 100, NULL, '2020-05-24', '2020-05-24', 2, 'Pieza'),
(4, 'Pan para hotdog', NULL, 10, 100, NULL, '2020-05-24', '2020-05-24', 2, 'Pieza'),
(5, 'Salchichas para hotdog', NULL, 10, 100, NULL, '2020-05-24', '2020-05-24', 2, 'Kilogramo'),
(6, 'Carne para hotdog', NULL, 10, 100, NULL, '2020-05-24', '2020-05-24', 2, NULL),
(7, 'Alitas', NULL, 10, 100, NULL, '2020-05-24', '2020-05-24', 2, NULL),
(19, 'Jamon', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Queso amarillo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Queso Chedar', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Aceite', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Aguas', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Refrescos', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Bufalo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Mango Habanero', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Pia Habanero', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Tamarindo habanero', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Pia en almibar', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Pepinillos', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Mayonesa', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Dedos de queso', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Aderezo ranch', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Aderezo Habanero', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Papas para freir', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Chili', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Empanadas Pollo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Crunch', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Jitomate', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Aguacate', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Zanahoria', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Apio', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Peregil', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Cilandro', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Lechuga', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Cebolla blanca', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Cebolla morada', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Chile serrano', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Chile habanero', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Contenedor Burger', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Contenedor de Hotdog', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Contenedor Charola', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Bolsa de mangas ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Jabon en polvo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Javon liquido', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'BBQ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'BBQ Chipotle', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Ajo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Tocino', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Pan Molido', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Contenedor de Aderezos', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Tapa de contenedores', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Boneless', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'ChampiÃ±pnes', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Mostaza ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'Crema acida', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Papas frescas', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'Huevos', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Pimienta', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Sal', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Platano macho', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Quesillo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Espinacas', '', 0, 0, 0, '2020-07-30', '0000-00-00', 0, 'Kilogramo'),
(74, 'Pan integral', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Pechuga fileteada', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Ensalada de atun', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'Ensalada de pollo', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Pieza de pan', '', 0, 0, 0, NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'asdasd', '', ''),
(2, 'Sam\'s', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base_product`
--
ALTER TABLE `base_product`
  ADD PRIMARY KEY (`id_producto_base`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `nombre_2` (`nombre`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingrediente`),
  ADD KEY `id_stock` (`id_stock`) USING BTREE,
  ADD KEY `id_producto` (`id_producto`) USING BTREE,
  ADD KEY `id_producto_base` (`id_producto_base`) USING BTREE;

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id_venta`),
  ADD UNIQUE KEY `fecha_creacion` (`fecha_creacion`);

--
-- Indices de la tabla `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`id_articulo_venta`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base_product`
--
ALTER TABLE `base_product`
  MODIFY `id_producto_base` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sale`
--
ALTER TABLE `sale`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `id_articulo_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `product` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto_base` FOREIGN KEY (`id_producto_base`) REFERENCES `base_product` (`id_producto_base`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_stock` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `category` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
