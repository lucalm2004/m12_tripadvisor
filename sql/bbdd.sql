-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2024 a las 19:38:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tripadvisor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comida_restaurante`
--

CREATE TABLE `tbl_comida_restaurante` (
  `id_comida_restaurante` int(11) NOT NULL,
  `id_comida` int(11) DEFAULT NULL,
  `id_restaurante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_comida_restaurante`
--

INSERT INTO `tbl_comida_restaurante` (`id_comida_restaurante`, `id_comida`, `id_restaurante`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 2),
(5, 5, 2),
(7, 4, 3),
(8, 12, 3),
(9, 19, 3),
(13, 8, 5),
(14, 9, 5),
(16, 10, 6),
(17, 18, 6),
(19, 11, 7),
(20, 13, 7),
(22, 14, 8),
(23, 15, 8),
(24, 16, 8),
(25, 17, 9),
(26, 20, 9),
(28, 21, 10),
(29, 22, 10),
(30, 23, 10),
(31, 6, 4),
(32, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_restaurante`
--

CREATE TABLE `tbl_restaurante` (
  `id_restaurante` int(11) NOT NULL,
  `nombre_restaurante` varchar(45) DEFAULT NULL,
  `propietario` int(11) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `valoracion` decimal(2,1) DEFAULT NULL,
  `precio_medio` decimal(5,2) DEFAULT NULL,
  `imagen_res` varchar(20) DEFAULT NULL,
  `email_oficial` varchar(100) DEFAULT NULL,
  `imagen_banner` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_restaurante`
--

INSERT INTO `tbl_restaurante` (`id_restaurante`, `nombre_restaurante`, `propietario`, `direccion`, `valoracion`, `precio_medio`, `imagen_res`, `email_oficial`, `imagen_banner`) VALUES
(1, 'Restaurant One', 1, '123 Main St, Cityville', 4.5, 25.00, 'res1.jpg', 'info@restaurantone.com', 'ban1.jpg'),
(2, 'Restaurant Two', 2, '456 Elm St, Townsville', 3.8, 20.00, 'res2.jpg', 'info@restauranttwo.com', 'ban2.jpg'),
(3, 'Restaurant Three', 3, '789 Oak St, Villageton', 5.0, 30.00, 'res3.jpg', 'info@restaurantthree.com', 'ban3.jpg'),
(4, 'Restaurant Four', 4, '101 Pine St, Hamletown', 4.2, 35.00, 'res4.jpg', 'info@restaurantfour.com', 'ban4.jpg'),
(5, 'Restaurant Five', 5, '202 Maple St, Boroughville', 4.7, 40.00, 'res5.jpg', 'info@restaurantfive.com', 'ban5.jpg'),
(6, 'Restaurant Six', 6, '303 Cedar St, Township', 3.5, 22.00, 'res6.jpg', 'info@restaurantsix.com', 'ban6.jpg'),
(7, 'Restaurant Seven', 7, '404 Birch St, Townburg', 4.0, 28.00, 'res7.jpg', 'info@restaurantseven.com', 'ban7.jpg'),
(8, 'Restaurant Eight', 8, '505 Walnut St, Citytown', 4.9, 45.00, 'res8.jpg', 'info@restauranteight.com', 'ban8.jpg'),
(9, 'Restaurant Nine', 9, '606 Oak St, Hamletville', 4.1, 32.00, 'res9.jpg', 'info@restaurantnine.com', 'ban9.jpg'),
(10, 'Restaurant Ten', 10, '707 Pine St, Villageton', 4.6, 38.00, 'res10.jpg', 'info@restaurantten.com', 'ban10.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `es_admin` tinyint(1) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `mail`, `pwd`, `nombre_completo`, `es_admin`, `valid`) VALUES
(1, 'user1', 'user1@example.com', 'password1', 'User One', 0, 1),
(2, 'user2', 'user2@example.com', 'password2', 'User Two', 0, 1),
(3, 'user3', 'user3@example.com', 'password3', 'User Three', 0, 1),
(4, 'user4', 'user4@example.com', 'password4', 'User Four', 0, 1),
(5, 'user5', 'user5@example.com', 'password5', 'User Five', 0, 1),
(6, 'user6', 'user6@example.com', 'password6', 'User Six', 0, 1),
(7, 'user7', 'user7@example.com', 'password7', 'User Seven', 0, 1),
(8, 'user8', 'user8@example.com', 'password8', 'User Eight', 0, 1),
(9, 'user9', 'user9@example.com', 'password9', 'User Nine', 0, 1),
(10, 'user10', 'user10@example.com', 'password10', 'User Ten', 0, 1),
(11, 'admin1', 'admin1@example.com', 'adminpass1', 'Admin One', 1, 1),
(12, 'admin2', 'admin2@example.com', 'adminpass2', 'Admin Two', 1, 1),
(13, 'admin3', 'admin3@example.com', 'adminpass3', 'Admin Three', 1, 1),
(14, 'admin4', 'admin4@example.com', 'adminpass4', 'Admin Four', 1, 1),
(15, 'admin5', 'admin5@example.com', 'adminpass5', 'Admin Five', 1, 1),
(16, 'admin6', 'admin6@example.com', 'adminpass6', 'Admin Six', 1, 1),
(17, 'admin7', 'admin7@example.com', 'adminpass7', 'Admin Seven', 1, 1),
(18, 'admin8', 'admin8@example.com', 'adminpass8', 'Admin Eight', 1, 1),
(19, 'admin9', 'admin9@example.com', 'adminpass9', 'Admin Nine', 1, 1),
(20, 'admin10', 'admin10@example.com', 'adminpass10', 'Admin Ten', 1, 1),
(21, 'hank', 'albertobermejo987@gmail.com', '$2y$10$5LzBH114rWvduWQpgyBeIOXPeXx0lpryRFY/zRBbHdpsRin5RnfQ6', 'alberto', 1, 1),
(24, 'luca', 'asd@gmail.com', NULL, 'asdASD', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_valoracion`
--

CREATE TABLE `tbl_valoracion` (
  `id_valoracion` int(11) NOT NULL,
  `username` int(11) DEFAULT NULL,
  `valoracion` decimal(2,1) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `restaurante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_valoracion`
--

INSERT INTO `tbl_valoracion` (`id_valoracion`, `username`, `valoracion`, `comentario`, `restaurante`) VALUES
(21, 1, 4.5, 'Great food and atmosphere!', 1),
(22, 2, 3.8, 'Good service but food was average.', 2),
(23, 3, 5.0, 'Excellent experience overall.', 3),
(24, 4, 4.2, 'Nice place for a family dinner.', 4),
(25, 5, 4.7, 'Delicious dishes, highly recommended.', 5),
(26, 6, 3.5, 'Fairly good, could improve.', 6),
(27, 7, 4.0, 'Enjoyed the meal, will come back.', 7),
(28, 8, 4.9, 'Outstanding service and food quality.', 8),
(29, 9, 4.1, 'Decent food, but a bit pricey.', 9),
(30, 10, 4.6, 'Lovely ambiance, perfect for a date.', 10),
(31, 21, 0.0, 'jod3r estoy harto ......................', 1),
(32, 1, 4.5, '¡Excelente comida y servicio!', 1),
(33, 2, 3.8, 'La comida estuvo bien, pero el servicio fue un poco lento.', 1),
(34, 3, 4.2, 'Buena relación calidad-precio, definitivamente regresaría.', 1),
(35, 4, 4.7, 'Excelente experiencia gastronómica, altamente recomendado.', 1),
(36, 9, 4.2, 'Comida deliciosa, ambiente agradable.', 1),
(37, 10, 3.5, 'El servicio fue un poco lento, pero la comida valió la pena la espera.', 1),
(38, 11, 4.8, '¡Increíble experiencia culinaria, definitivamente lo recomendaría!', 1),
(39, 12, 3.9, 'Precios razonables y porciones generosas.', 1),
(40, 13, 4.6, 'Atención al cliente impecable, volveré pronto.', 1),
(41, 14, 4.1, 'Buena comida, pero el ambiente podría mejorar.', 1),
(42, 15, 3.7, 'El menú podría ser más variado, pero la comida era sabrosa.', 1),
(43, 16, 4.4, 'Gran lugar para una cena con amigos, ambiente animado.', 1),
(44, 17, 4.3, 'Excelente servicio al cliente, comida deliciosa.', 1),
(45, 18, 4.5, '¡Impresionante vista desde el restaurante, comida deliciosa!', 1),
(56, 9, 4.2, 'Comida deliciosa, ambiente agradable.', 1),
(57, 10, 3.5, 'El servicio fue un poco lento, pero la comida valió la pena la espera.', 1),
(58, 11, 4.8, '¡Increíble experiencia culinaria, definitivamente lo recomendaría!', 1),
(59, 12, 3.9, 'Precios razonables y porciones generosas.', 1),
(60, 13, 4.6, 'Atención al cliente impecable, volveré pronto.', 1),
(61, 14, 4.1, 'Buena comida, pero el ambiente podría mejorar.', 1),
(62, 15, 3.7, 'El menú podría ser más variado, pero la comida era sabrosa.', 1),
(63, 16, 4.4, 'Gran lugar para una cena con amigos, ambiente animado.', 1),
(64, 17, 4.3, 'Excelente servicio al cliente, comida deliciosa.', 1),
(65, 18, 4.5, '¡Impresionante vista desde el restaurante, comida deliciosa!', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comida`
--

CREATE TABLE `tipo_comida` (
  `id_comida` int(11) NOT NULL,
  `nombre_comida` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='			';

--
-- Volcado de datos para la tabla `tipo_comida`
--

INSERT INTO `tipo_comida` (`id_comida`, `nombre_comida`) VALUES
(1, 'Americana'),
(2, 'Caribeña'),
(3, 'Mediterránea'),
(4, 'Libanesa'),
(5, 'Peruana'),
(6, 'Argentina'),
(7, 'Chilena'),
(8, 'Colombiana'),
(9, 'Venezolana'),
(10, 'Ecuatoriana'),
(11, 'Árabe'),
(12, 'Alemana'),
(13, 'Rusa'),
(14, 'Nórdica'),
(15, 'Polaca'),
(16, 'Hawaiana'),
(17, 'Sudafricana'),
(18, 'Marroquí'),
(19, 'Turca'),
(20, 'Escandinava'),
(21, 'Irlandesa'),
(22, 'Australiana'),
(23, 'Austriaca'),
(24, 'Belga'),
(25, 'Suiza');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_comida_restaurante`
--
ALTER TABLE `tbl_comida_restaurante`
  ADD PRIMARY KEY (`id_comida_restaurante`),
  ADD KEY `tbl_comida_idx` (`id_comida`),
  ADD KEY `tbl_restaurante_idx` (`id_restaurante`);

--
-- Indices de la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  ADD PRIMARY KEY (`id_restaurante`),
  ADD KEY `fk_propietario_idx` (`propietario`);

--
-- Indices de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `tbl_valoracion`
--
ALTER TABLE `tbl_valoracion`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `fk_user_idx` (`username`),
  ADD KEY `fk_res_idx` (`restaurante`);

--
-- Indices de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  ADD PRIMARY KEY (`id_comida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_comida_restaurante`
--
ALTER TABLE `tbl_comida_restaurante`
  MODIFY `id_comida_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_valoracion`
--
ALTER TABLE `tbl_valoracion`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_comida_restaurante`
--
ALTER TABLE `tbl_comida_restaurante`
  ADD CONSTRAINT `tbl_comida` FOREIGN KEY (`id_comida`) REFERENCES `tipo_comida` (`id_comida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_restaurante`
--
ALTER TABLE `tbl_restaurante`
  ADD CONSTRAINT `fk_propietario` FOREIGN KEY (`propietario`) REFERENCES `tbl_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_valoracion`
--
ALTER TABLE `tbl_valoracion`
  ADD CONSTRAINT `fk_res` FOREIGN KEY (`restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username`) REFERENCES `tbl_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
