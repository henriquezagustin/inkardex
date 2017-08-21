-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2017 a las 05:56:50
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inkardexdb`
--

use `inkardexdb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_grupo`
--

CREATE TABLE `estados_rol` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_usuario`
--

CREATE TABLE `estados_usuario` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_usuario`
--

CREATE TABLE `roles_usuario` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `estado_rol_id` int(4) NOT NULL,
  `nombre_rol` varchar(150) NOT NULL,
  `nivel_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `archivo_nombre` varchar(255) NOT NULL,
  `archivo_tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(4) NOT NULL,
  `media_id` int(4) NULL DEFAULT 0,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(4) NOT NULL,
  `precio_compra` decimal(25,0) NOT NULL,
  `precio_venta` decimal(25,0) NOT NULL,
  `fecha` datetime NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_categoria_producto FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`),
  CONSTRAINT fk_media_producto FOREIGN KEY (`media_id`) REFERENCES `media`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_usuario_id` int(4) NOT NULL,
  `rol_usuario_id` int(4) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `imagen` varchar(255) NULL,
  `ultimo_login` datetime NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_estado_usuario FOREIGN KEY (`estado_usuario_id`) REFERENCES `estados_usuario`(`id`),
  CONSTRAINT fk_rol_usuario FOREIGN KEY (`rol_usuario_id`) REFERENCES `roles_usuario`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `producto_id` int(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(25,0) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_producto_venta FOREIGN KEY (`producto_id`) REFERENCES `productos`(`id`),
  CONSTRAINT fk_usuario_venta FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Inicializando la tabla `estados_rol`
--

INSERT INTO `estados_rol` (`nombre`) VALUES ('activo');
INSERT INTO `estados_rol` (`nombre`) VALUES ('no activo');

-- --------------------------------------------------------

--
-- Inicializando la tabla `estados_usuario`
--

INSERT INTO `estados_usuario` (`nombre`) VALUES ('activo');
INSERT INTO `estados_usuario` (`nombre`) VALUES ('no activo'); 

-- --------------------------------------------------------

--
-- Inicializando la tabla `roles_usuario`
--

INSERT INTO `roles_usuario` (`estado_rol_id`, `nombre_rol`, `nivel_rol`) VALUES (1, 'administrador', 1);
INSERT INTO `roles_usuario` (`estado_rol_id`, `nombre_rol`, `nivel_rol`) VALUES (1, 'supervisor', 2);
INSERT INTO `roles_usuario` (`estado_rol_id`, `nombre_rol`, `nivel_rol`) VALUES (1, 'usuario', 3);

-- --------------------------------------------------------

--
-- Inicializando la tabla `usuarios`
--

INSERT INTO `usuarios` (`estado_usuario_id`, `rol_usuario_id`, `nombre`, `usuario`, `clave`, `imagen`, `ultimo_login`)	-- user 1
	VALUES (1, 1, 'administrador', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', null, null);

INSERT INTO `usuarios` (`estado_usuario_id`, `rol_usuario_id`, `nombre`, `usuario`, `clave`, `imagen`, `ultimo_login`)	-- user 1
	VALUES (1, 2, 'supervisor', 'super', 'f865b53623b121fd34ee5426c792e5c33af8c227', null, null);
-- --------------------------------------------------------

--
-- Cargando data de muestra para la tabla `categorias`
--

INSERT INTO `categorias` (`nombre`) VALUES ('audio, video y redes');	-- cat 1
INSERT INTO `categorias` (`nombre`) VALUES ('automotriz');				-- cat 2
INSERT INTO `categorias` (`nombre`) VALUES ('baños');					-- cat 3
INSERT INTO `categorias` (`nombre`) VALUES ('bombas y calentadores');	-- cat 4
INSERT INTO `categorias` (`nombre`) VALUES ('cerrajeria');				-- cat 5
INSERT INTO `categorias` (`nombre`) VALUES ('electrico');				-- cat 6
INSERT INTO `categorias` (`nombre`) VALUES ('electrodomesticos');		-- cat 7
INSERT INTO `categorias` (`nombre`) VALUES ('exteriores');				-- cat 8
INSERT INTO `categorias` (`nombre`) VALUES ('ferreteria');				-- cat 9
INSERT INTO `categorias` (`nombre`) VALUES ('fontaneria');				-- cat 10
INSERT INTO `categorias` (`nombre`) VALUES ('herramientas electricas');	-- cat 11
INSERT INTO `categorias` (`nombre`) VALUES ('herramientas manuales');	-- cat 12
INSERT INTO `categorias` (`nombre`) VALUES ('hogar');					-- cat 13
INSERT INTO `categorias` (`nombre`) VALUES ('iluminacion y ventilacion');	-- cat 14
INSERT INTO `categorias` (`nombre`) VALUES ('indrustrial');				-- cat 15
INSERT INTO `categorias` (`nombre`) VALUES ('jardineria');				-- cat 16	
INSERT INTO `categorias` (`nombre`) VALUES ('limpieza');				-- cat 17
INSERT INTO `categorias` (`nombre`) VALUES ('maquinaria de jardin');	-- cat 18
INSERT INTO `categorias` (`nombre`) VALUES ('materiales de construccion');	-- cat 19
INSERT INTO `categorias` (`nombre`) VALUES ('pintura');					-- cat 20

-- --------------------------------------------------------

--
-- Cargando data de muestra para la tabla `media`
--

INSERT INTO `media` (`archivo_nombre`, `archivo_tipo`) VALUES ('sin imagen', 'image/jpeg');		-- media 1

-- --------------------------------------------------------

--
-- Cargando data de muestra para la tabla `productos`
--

INSERT INTO `productos` (`categoria_id`, `media_id`, `nombre`, `cantidad`, `precio_compra`, `precio_venta`, `fecha`)
	VALUES (20, 1, 'pintura pro latex laguna', 100, 59, 65, now());											-- prod 1
INSERT INTO `productos` (`categoria_id`, `media_id`, `nombre`, `cantidad`, `precio_compra`, `precio_venta`, `fecha`)
	VALUES (20, 1, 'pintura high standard latex amarillo', 100, 108, 115, now());							-- prod 2

-- --------------------------------------------------------

--
-- Cargando data de muestra para la tabla `ventas`
--

INSERT INTO `ventas` (`producto_id`, `usuario_id`, `cantidad`, `precio`, `fecha`)
	VALUES (1, 1, 2, 130, now());
INSERT INTO `ventas` (`producto_id`, `usuario_id`, `cantidad`, `precio`, `fecha`)
	VALUES (1, 1, 1, 65, now());
INSERT INTO `ventas` (`producto_id`, `usuario_id`, `cantidad`, `precio`, `fecha`)
	VALUES (1, 2, 3, 345, now());



