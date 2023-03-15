-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2023 a las 06:44:20
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutricosmetic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IdCarrito` int(4) NOT NULL,
  `IdUsuario` int(4) NOT NULL,
  `IdProducto` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(4) NOT NULL,
  `NomCategoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NomCategoria`) VALUES
(1, 'protector solar'),
(2, 'crema humectante'),
(3, 'café'),
(4, 'bajar de peso'),
(7, 'belleza'),
(8, 'bebida hidratante'),
(19, 'salud'),
(20, 'bebida energetica'),
(22, 'belleza facial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `IdDireccion` int(4) NOT NULL,
  `Colonia` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Calle` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nom_Exterior` int(4) NOT NULL,
  `nom_Interior` int(4) NOT NULL,
  `cp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `IdMarca` int(4) NOT NULL,
  `NomMarca` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`IdMarca`, `NomMarca`) VALUES
(1, 'seytú'),
(2, 'omnilife');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProducto` int(4) NOT NULL,
  `IdMarca` int(4) NOT NULL,
  `TokenProd` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `NomProducto` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Porcion` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `PrecioOriginal` int(10) NOT NULL,
  `PrecioOferta` int(10) DEFAULT NULL,
  `Descripcion` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Imagen` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `IdMarca`, `TokenProd`, `NomProducto`, `Porcion`, `PrecioOriginal`, `PrecioOferta`, `Descripcion`, `Imagen`) VALUES
(59, 1, 'eff30ee9c3c03c312ce1538d94f8b327', 'labiales', '25', 399, 299, 'Labial efecto voluminizador', '/galeria/productos/eff30ee9c3c03c312ce1538d94f8b327.jpeg'),
(60, 1, '2ec02ef00257741d0ac20f2ddd937756', 'pestañas', '50', 200, 0, 'enchinador de pestañas', '/galeria/productos/2ec02ef00257741d0ac20f2ddd937756.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionprodcat`
--

CREATE TABLE `relacionprodcat` (
  `IdRelProdCat` int(4) NOT NULL,
  `IdProducto` int(4) NOT NULL,
  `IdCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `relacionprodcat`
--

INSERT INTO `relacionprodcat` (`IdRelProdCat`, `IdProducto`, `IdCategoria`) VALUES
(30, 59, 22),
(31, 60, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `IdTipoUsurario` int(4) NOT NULL,
  `TipoUsuario` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`IdTipoUsurario`, `TipoUsuario`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(4) NOT NULL,
  `IdDireccion` int(4) DEFAULT NULL,
  `IdTipoUsuario` int(4) NOT NULL,
  `Token` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `NombreCom` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Contrasena` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Celular` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `DirecImagen` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `IdDireccion`, `IdTipoUsuario`, `Token`, `NombreCom`, `Email`, `Contrasena`, `Celular`, `DirecImagen`) VALUES
(8, NULL, 1, '28e18a5d666c2d2c3f3bb1f546a93374', 'lenin alejandro de la o serna', 'lads2499@gmail.com', 'e377f18004c734849de045d862b5349d', '7441287347', '/galeria/usuarios/b3f0994b7f75305a2498c907e7086431.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IdCarrito`),
  ADD KEY `IdUsuario` (`IdUsuario`) USING BTREE,
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`IdDireccion`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`IdMarca`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdUsuario` (`IdMarca`) USING BTREE,
  ADD KEY `IdMarca` (`IdMarca`) USING BTREE;

--
-- Indices de la tabla `relacionprodcat`
--
ALTER TABLE `relacionprodcat`
  ADD PRIMARY KEY (`IdRelProdCat`),
  ADD KEY `prod` (`IdProducto`) USING BTREE,
  ADD KEY `cat` (`IdCategoria`) USING BTREE;

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`IdTipoUsurario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `iddireccion` (`IdDireccion`),
  ADD KEY `IdTipoUsu` (`IdTipoUsuario`),
  ADD KEY `IdDireccion_2` (`IdDireccion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `IdCarrito` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `IdDireccion` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProducto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `relacionprodcat`
--
ALTER TABLE `relacionprodcat`
  MODIFY `IdRelProdCat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `IdTipoUsurario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`IdDireccion`) REFERENCES `usuarios` (`IdDireccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `relacionprodcat`
--
ALTER TABLE `relacionprodcat`
  ADD CONSTRAINT `relacionprodcat_ibfk_2` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relacionprodcat_ibfk_3` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `IdTipoUsu` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`IdTipoUsurario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
