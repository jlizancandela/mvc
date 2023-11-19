-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2023 a las 13:02:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_ropa`
--
CREATE DATABASE IF NOT EXISTS `tienda_ropa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda_ropa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`Id`, `Nombre`, `Descripcion`) VALUES
(1, 'Polo', NULL),
(2, 'Camisa', NULL),
(3, 'Camiseta', NULL),
(4, 'Vestidos', 'Ropa elegante para mujeres.'),
(5, 'Blusas', 'Variedad de blusas para mujeres.'),
(6, 'Jeans', 'Jeans modernos para mujeres.'),
(7, 'Zapatos', 'Calzado de moda para mujeres.'),
(8, 'Abrigos', 'Abrigos para el invierno.'),
(9, 'Camisetas', 'Camisetas cómodas para hombres.'),
(10, 'Pantalones', 'Pantalones versátiles para hombres.'),
(11, 'Zapatos Deportivos', 'Calzado deportivo para hombres.'),
(12, 'Trajes', 'Trajes formales para hombres.'),
(13, 'Gorras', 'Accesorios de moda para hombres.'),
(15, 'Falda', 'Faldas largas y cortas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Direccion`
--

CREATE TABLE `Direccion` (
  `Codigo` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `CP` varchar(5) NOT NULL,
  `Provincia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Direccion`
--

INSERT INTO `Direccion` (`Codigo`, `Usuario`, `Direccion`, `CP`, `Provincia`) VALUES
(33, 30, 'salazar alonso 6 elche', '03202', 'alicante'),
(37, 23, 'mob user 3', '04023', 'moblandia'),
(39, 32, 'Monte Nevado', '03202', 'alicante'),
(40, 33, 'poligono', '03202', 'torrevieja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imagenes`
--

CREATE TABLE `Imagenes` (
  `Id` int(11) NOT NULL,
  `Url` varchar(300) DEFAULT NULL,
  `Txt_Alt` text DEFAULT NULL,
  `Id_Producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Imagenes`
--

INSERT INTO `Imagenes` (`Id`, `Url`, `Txt_Alt`, `Id_Producto`) VALUES
(1, 'public/img/vestido001.jpg', 'Vestido Floral', 1),
(2, 'public/img/vestido002.jpg', 'Vestido Floral', 1),
(3, 'public/img/vestido003.jpg', 'Vestido Floral', 1),
(4, 'public/img/blusa001.jpg', 'Blusa Elegante', 2),
(5, 'public/img/blusa002.jpg', 'Blusa Elegante', 2),
(6, 'public/img/blusa003.jpg', 'Blusa Elegante', 2),
(7, 'public/img/jeans001.jpg', 'Jeans Ajustados', 3),
(8, 'public/img/jeans002.jpg', 'Jeans Ajustados', 3),
(9, 'public/img/zapatos001.jpg', 'Zapatos de Tacón', 4),
(10, 'public/img/zapatos002.jpg', 'Zapatos de Tacón', 4),
(11, 'public/img/zapatos003.jpg', 'Zapatos de Tacón', 4),
(12, 'public/img/abrigo001.jpg', 'Abrigo de Invierno', 5),
(13, 'public/img/abrigo002.jpg', 'Abrigo de Invierno', 5),
(14, 'public/img/camiseta001.jpg', 'Camiseta de Manga Corta', 6),
(15, 'public/img/camiseta002.jpg', 'Camiseta de Manga Corta', 6),
(16, 'public/img/pantalones001.jpg', 'Pantalones Cargo', 7),
(17, 'public/img/zapatillas001.jpg', 'Zapatillas Deportivas', 8),
(18, 'public/img/zapatillas002.jpg', 'Zapatillas Deportivas', 8),
(19, 'public/img/traje001.jpg', 'Traje Formal', 9),
(20, 'public/img/traje002.jpg', 'Traje Formal', 9),
(21, 'public/img/gorra001.jpg', 'Gorra de Béisbol', 10),
(22, 'public/img/gorra002.jpg', 'Gorra de Béisbol', 10),
(65, 'public/img/1665580082596b020231118010834.jpg', NULL, 16),
(66, 'public/img/16655800825b34a20231118010834.jpg', NULL, 16),
(67, 'public/img/7655801eacc91a20231118011434.jpg', NULL, 7),
(68, 'public/img/7655801eacea2d20231118011434.jpg', NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Login`
--

CREATE TABLE `Login` (
  `Id` int(11) NOT NULL,
  `Date_time` timestamp NULL DEFAULT current_timestamp(),
  `Email` varchar(100) NOT NULL,
  `Resultado` tinyint(1) NOT NULL,
  `Nota` text DEFAULT NULL,
  `Ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Login`
--

INSERT INTO `Login` (`Id`, `Date_time`, `Email`, `Resultado`, `Nota`, `Ip`) VALUES
(16, '2023-10-28 16:52:40', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(17, '2023-10-29 19:36:16', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(18, '2023-10-30 11:46:22', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(19, '2023-10-30 11:47:02', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(20, '2023-10-30 11:48:32', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(21, '2023-10-30 11:55:08', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(22, '2023-10-30 11:55:25', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(23, '2023-10-30 11:55:52', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(24, '2023-10-30 11:56:12', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(25, '2023-10-30 12:00:29', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(26, '2023-10-30 12:00:48', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(27, '2023-10-30 14:56:49', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(28, '2023-10-30 14:57:52', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(29, '2023-10-30 14:58:01', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(30, '2023-10-30 14:58:28', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(31, '2023-10-30 14:58:41', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(32, '2023-10-30 15:06:33', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(33, '2023-10-30 15:08:07', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(34, '2023-10-30 15:28:38', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(35, '2023-10-30 15:29:35', 'usuaxrio@prueba.com', 1, NULL, '127.0.0.1'),
(36, '2023-10-30 15:32:54', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(37, '2023-10-30 15:33:47', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(38, '2023-10-30 15:34:47', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(39, '2023-10-30 15:35:24', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(40, '2023-10-30 15:42:29', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(41, '2023-10-30 15:42:46', 'ola@fff.com', 0, NULL, '127.0.0.1'),
(42, '2023-10-30 15:43:11', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(43, '2023-10-30 20:00:40', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(44, '2023-10-31 10:15:47', 'usuario@prueba.com', 0, NULL, '127.0.0.1'),
(45, '2023-10-31 10:15:56', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(46, '2023-10-31 10:46:32', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(47, '2023-10-31 10:53:40', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(48, '2023-10-31 10:53:56', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(49, '2023-10-31 13:30:53', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(50, '2023-10-31 14:38:07', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(51, '2023-10-31 14:38:22', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(52, '2023-10-31 16:52:00', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(53, '2023-10-31 18:55:20', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(54, '2023-10-31 19:00:11', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(55, '2023-10-31 19:05:42', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(56, '2023-10-31 19:07:32', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(57, '2023-10-31 19:12:26', 'admin@prueba.com', 1, NULL, '::1'),
(58, '2023-10-31 19:17:39', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(59, '2023-11-01 10:33:33', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(60, '2023-11-02 14:36:49', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(61, '2023-11-03 11:19:51', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(62, '2023-11-03 11:20:18', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(63, '2023-11-03 11:24:37', 'usuario2@prueba.com', 0, NULL, '127.0.0.1'),
(64, '2023-11-03 11:25:04', 'usuario2@prueba.com', 0, NULL, '127.0.0.1'),
(65, '2023-11-03 11:25:27', 'usuario2@prueba.com', 0, NULL, '127.0.0.1'),
(66, '2023-11-03 11:25:52', 'usuario@prueba.com', 0, NULL, '127.0.0.1'),
(67, '2023-11-03 11:26:17', 'usuario2@prueba.com', 0, NULL, '127.0.0.1'),
(68, '2023-11-03 11:26:26', 'usuario2@prueba.com', 0, NULL, '127.0.0.1'),
(69, '2023-11-03 11:26:46', 'usuario2@prueba.com', 1, NULL, '127.0.0.1'),
(70, '2023-11-03 11:30:29', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(71, '2023-11-03 14:42:35', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(72, '2023-11-03 16:06:38', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(73, '2023-11-03 18:34:58', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(74, '2023-11-04 11:13:39', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(75, '2023-11-04 19:04:20', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(76, '2023-11-06 14:45:45', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(77, '2023-11-07 15:40:12', 'admin@prueba.com', 1, NULL, '::1'),
(78, '2023-11-07 15:41:45', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(79, '2023-11-07 16:01:32', 'admin@prueba.com', 1, NULL, '::1'),
(80, '2023-11-07 16:03:12', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(81, '2023-11-08 10:43:22', 'notengo@ola.com', 0, NULL, '127.0.0.1'),
(82, '2023-11-08 10:45:09', 'pedro-p-fempa@proton.me', 0, NULL, '127.0.0.1'),
(83, '2023-11-08 10:45:35', 'pedro-p-fempa@proton.me', 0, NULL, '127.0.0.1'),
(84, '2023-11-08 10:46:56', 'pedro@gmail.com', 0, NULL, '127.0.0.1'),
(85, '2023-11-08 17:28:55', 'putollamas@gmail.com', 0, NULL, '127.0.0.1'),
(86, '2023-11-08 17:35:40', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(87, '2023-11-08 19:18:04', 'llameando@gmailc.xom', 0, NULL, '127.0.0.1'),
(88, '2023-11-08 19:27:25', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(89, '2023-11-09 01:16:22', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(90, '2023-11-09 01:35:03', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(91, '2023-11-09 01:38:42', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(92, '2023-11-09 01:39:44', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(93, '2023-11-09 01:42:13', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(94, '2023-11-09 11:08:13', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(95, '2023-11-09 11:08:37', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(96, '2023-11-09 11:09:26', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(97, '2023-11-09 11:13:42', 'usuario@prueba.com', 1, NULL, '127.0.0.1'),
(98, '2023-11-09 11:30:54', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(99, '2023-11-09 15:54:37', 'admin@prueba.com', 1, NULL, '::1'),
(100, '2023-11-09 16:25:29', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(101, '2023-11-09 16:27:01', 'admin@prueba.com', 1, NULL, '::1'),
(102, '2023-11-09 17:16:08', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(103, '2023-11-10 15:51:36', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(104, '2023-11-10 16:09:22', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(105, '2023-11-12 00:31:03', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(106, '2023-11-12 19:50:15', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(107, '2023-11-13 12:55:43', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(108, '2023-11-14 15:00:01', 'admin@prueba.com', 1, NULL, '::1'),
(109, '2023-11-16 16:53:33', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(110, '2023-11-16 18:40:09', 'admin@prueba.com', 1, NULL, '::1'),
(111, '2023-11-16 18:43:51', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(112, '2023-11-17 19:38:35', 'admin@prueba.com', 1, NULL, '127.0.0.1'),
(113, '2023-11-18 00:11:24', 'admin@prueba.com', 0, NULL, '127.0.0.1'),
(114, '2023-11-18 00:14:13', 'admin@prueba.com', 1, NULL, '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ofertas`
--

CREATE TABLE `Ofertas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Comienza` date DEFAULT NULL,
  `Termina` date DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Ofertas`
--

INSERT INTO `Ofertas` (`Id`, `Nombre`, `Comienza`, `Termina`, `Descripcion`, `Oferta`) VALUES
(5, 'Otoño', '2023-10-01', '2023-11-30', 'Ofertas de otoño', 10),
(6, NULL, NULL, NULL, NULL, 20),
(7, NULL, NULL, NULL, NULL, 25),
(8, NULL, NULL, NULL, NULL, 43),
(9, NULL, NULL, NULL, NULL, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Precio` decimal(10,0) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Id_Publico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`Id`, `Nombre`, `Precio`, `Descripcion`, `Id_Publico`) VALUES
(1, 'Vestido Floral', 50, 'Vestido de flores perfecto para ocasiones especiales.', 1),
(2, 'Blusa Elegante', 30, 'Blusa elegante para lucir en cualquier evento.', 1),
(3, 'Jeans Ajustados', 40, 'Jeans ajustados y modernos para mujeres.', 1),
(4, 'Zapatos de Tacón', 60, 'Zapatos de tacón alto para complementar tu look.', 1),
(5, 'Abrigo de Invierno', 70, 'Abrigo cálido para el invierno.', 1),
(6, 'Camiseta de Manga Corta', 20, 'Camiseta cómoda para el día a día.', 2),
(7, 'Pantalones Cargo', 35, 'Pantalones con múltiples bolsillos para hombres.', 2),
(8, 'Zapatillas Deportivas', 45, 'Zapatillas deportivas para hombres activos.', 2),
(9, 'Traje Formal', 90, 'Traje formal para ocasiones especiales.', 2),
(10, 'Gorra de Béisbol', 15, 'Gorra de béisbol con estilo.', 2),
(16, 'tutu rosa', 30, 'tutu de competicion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pr_categorias`
--

CREATE TABLE `Pr_categorias` (
  `Id_Producto` int(11) NOT NULL,
  `Id_Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Pr_categorias`
--

INSERT INTO `Pr_categorias` (`Id_Producto`, `Id_Categoria`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 2),
(7, 10),
(8, 11),
(9, 12),
(10, 13),
(16, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pr_ofertas`
--

CREATE TABLE `Pr_ofertas` (
  `Id_Producto` int(11) NOT NULL,
  `Id_oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Pr_ofertas`
--

INSERT INTO `Pr_ofertas` (`Id_Producto`, `Id_oferta`) VALUES
(1, 5),
(4, 5),
(7, 5),
(16, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Publico`
--

CREATE TABLE `Publico` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Publico`
--

INSERT INTO `Publico` (`Id`, `Nombre`) VALUES
(1, 'Mujer'),
(2, 'Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Passwd` varchar(256) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `Rol` varchar(7) DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`Codigo`, `Nombre`, `Passwd`, `Email`, `Telefono`, `Rol`) VALUES
(23, 'Pedro Palomares', '$2y$10$e/Xk8aUHvZQtDz.VAvlktOSO98qpoJZ/QfYY4247j9NvMJSONNDI.', 'usuario@prueba.com', '600225522', 'User'),
(30, 'admins prueba', '$2y$10$3YdgeJT42C9tKCcaFGQVWu86BOleWaa/TznNo/7GHxCjidJzMUzYi', 'admin@prueba.com', '600883333', 'Admin'),
(32, 'Alejandro Llamas', '$2y$10$XY5WTwVyHtcki7yRtxk.Ie7p23Iom//tNnkxEaSDLbf6cdQHgD.AO', 'llamas@enllamas.com', '642525268', 'User'),
(33, 'kko', '$2y$10$zXbXC5sj7gqySacMPCctse29KjnvMVhzAV9G98Zsbg3E6bddnzzZG', 'kko@prueba.com', '6525685', 'User');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Direccion`
--
ALTER TABLE `Direccion`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Direccion_Users` (`Usuario`);

--
-- Indices de la tabla `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Productos_imagenes` (`Id_Producto`);

--
-- Indices de la tabla `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Ofertas`
--
ALTER TABLE `Ofertas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Id_Publico` (`Id_Publico`);

--
-- Indices de la tabla `Pr_categorias`
--
ALTER TABLE `Pr_categorias`
  ADD PRIMARY KEY (`Id_Producto`,`Id_Categoria`),
  ADD KEY `fk_categorias_Prcat` (`Id_Categoria`);

--
-- Indices de la tabla `Pr_ofertas`
--
ALTER TABLE `Pr_ofertas`
  ADD PRIMARY KEY (`Id_Producto`,`Id_oferta`),
  ADD KEY `fk_pr_ofertas` (`Id_oferta`);

--
-- Indices de la tabla `Publico`
--
ALTER TABLE `Publico`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `Direccion`
--
ALTER TABLE `Direccion`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `Imagenes`
--
ALTER TABLE `Imagenes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `Login`
--
ALTER TABLE `Login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `Ofertas`
--
ALTER TABLE `Ofertas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `Publico`
--
ALTER TABLE `Publico`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Direccion`
--
ALTER TABLE `Direccion`
  ADD CONSTRAINT `fk_Direccion_Users` FOREIGN KEY (`Usuario`) REFERENCES `Users` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD CONSTRAINT `fk_Productos_imagenes` FOREIGN KEY (`Id_Producto`) REFERENCES `Productos` (`Id`);

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `fk_Id_Publico` FOREIGN KEY (`Id_Publico`) REFERENCES `Publico` (`Id`);

--
-- Filtros para la tabla `Pr_categorias`
--
ALTER TABLE `Pr_categorias`
  ADD CONSTRAINT `fk_categorias_Prcat` FOREIGN KEY (`Id_Categoria`) REFERENCES `Categorias` (`Id`),
  ADD CONSTRAINT `fk_productos_Prcat` FOREIGN KEY (`Id_Producto`) REFERENCES `Productos` (`Id`);

--
-- Filtros para la tabla `Pr_ofertas`
--
ALTER TABLE `Pr_ofertas`
  ADD CONSTRAINT `fk_pr_ofertas` FOREIGN KEY (`Id_oferta`) REFERENCES `Ofertas` (`Id`),
  ADD CONSTRAINT `fk_pr_productos` FOREIGN KEY (`Id_Producto`) REFERENCES `Productos` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
