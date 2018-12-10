-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-12-2018 a las 03:23:29
-- Versión del servidor: 10.2.12-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id7035083_bd_inmobiliaria`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spBajaTerreno` (IN `id` INT)  BEGIN
	IF EXISTS (SELECT * FROM INM_TERRENO WHERE TER_CVE = id) THEN
    BEGIN
		UPDATE INM_TERRENO SET TER_ESTATUS = 0
    
	WHERE TER_CVE = id;

		SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;

END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spBuscarTerrenos` (IN `ESTADO` VARCHAR(50), IN `TIPO` VARCHAR(50))  BEGIN
IF (ESTADO!='' OR TIPO!='')THEN
  BEGIN
	SELECT A.TER_CVE ID, CONCAT(A.TER_CALLE,' ', A.TERR_COLONIA,' ', A.TER_MUNICIPIO,' ', A.TER_ESTADO)
 DIRECCION,
 CONCAT(A.TER_LARGO,' X ', A.TER_ANCHO,' Superficie ', A.TER_TOTAL,' mts^2 ') MEDIDAS,
 
	A.TER_PRECIO PRECIO, A.TER_DESC DESCRIPCION, 
    TER_FECHA_REG FECHA_REGISTRO,
    
    C.TIPO_NOMBRE TIPO

FROM INM_TERRENO A, INM_TIPO_TERRENO C

WHERE (A.TER_ESTATUS = 1  AND A.TER_TIPO_CVE = TIPO_CVE AND 
(A.TER_ESTADO = ESTADO OR C.TIPO_NOMBRE = TIPO))  ORDER BY TER_FECHA_REG;

END;
    ELSE
    SELECT A.TER_CVE ID, CONCAT(A.TER_CALLE,' ', A.TERR_COLONIA,' ', A.TER_MUNICIPIO,' ', A.TER_ESTADO)
 DIRECCION,
 CONCAT(A.TER_LARGO,' X ', A.TER_ANCHO,' Superficie ', A.TER_TOTAL,' mts^2 ') MEDIDAS,
 
	A.TER_PRECIO PRECIO, A.TER_DESC DESCRIPCION, 
    TER_FECHA_REG FECHA_REGISTRO,
    
    C.TIPO_NOMBRE TIPO

FROM INM_TERRENO A, INM_TIPO_TERRENO C

WHERE TER_ESTATUS = 1  AND TER_TIPO_CVE = TIPO_CVE  ORDER BY TER_FECHA_REG;
    END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spEditarPerfil` (IN `id` INT, IN `NOMUSU` VARCHAR(50), IN `CON` VARCHAR(50), IN `TELEFONO` VARCHAR(50), IN `EMAIL` VARCHAR(80), IN `CALLE` VARCHAR(50), IN `COLONIA` VARCHAR(80), IN `MUNICIPIO` VARCHAR(50), IN `ESTADO` VARCHAR(50), IN `PAGOCVE` VARCHAR(50))  BEGIN
IF EXISTS(SELECT USU_CVE_ID FROM INM_USUARIO  WHERE USU_CVE_ID = id) THEN
BEGIN
UPDATE INM_PERFIL, INM_USUARIO SET PER_TELEFONO = TELEFONO, 
    PER_EMAIL = EMAIL,PER_CALLE = CALLE,PER_COLONIA = COLONIA,
    PER_MUNICIPIO = MUNICIPIO,PER_ESTADO = ESTADO,PER_PAGO_CVE = PAGOCVE,USU_USUARIO = NOMUSU, USU_CONTRASENA = CON
    
WHERE PER_USU_CVE_ID = id AND USU_CVE_ID = id;

SELECT "1" CLAVE;
END;
ELSE
SELECT "0" CLAVE;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spEditarTerreno` (IN `id` INT, IN `CALLE` VARCHAR(50), IN `COLONIA` VARCHAR(50), IN `MUNICIPIO` VARCHAR(50), IN `ESTADO` VARCHAR(50), IN `LARGO` VARCHAR(50), IN `ANCHO` VARCHAR(50), IN `PRECIO` VARCHAR(50), IN `DESCRIPCION` VARCHAR(500), IN `TIPOCVE` VARCHAR(50))  BEGIN
IF EXISTS(SELECT TER_CVE FROM INM_TERRENO  WHERE TER_CVE = id) THEN
BEGIN
UPDATE INM_TERRENO SET TER_CALLE = CALLE,TERR_COLONIA = COLONIA,
    TER_MUNICIPIO = MUNICIPIO,TER_ESTADO = ESTADO,
    TER_LARGO = LARGO, TER_ANCHO = ANCHO, TER_TOTAL = (LARGO*ANCHO), TER_PRECIO = PRECIO,
    TER_DESC = DESCRIPCION, TER_FECHA_REG = NOW(), TER_TIPO_CVE = TIPOCVE
    
WHERE TER_CVE = id;

SELECT "1" CLAVE;
END;
ELSE
SELECT "0" CLAVE;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spEliminarTerreno` (IN `id` INT)  BEGIN
	IF EXISTS (SELECT * FROM INM_TERRENO  WHERE TER_CVE = id) THEN
    BEGIN
		DELETE FROM INM_TERRENO 
	WHERE TER_CVE =  id;

		SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;

END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spEliminarUsuario` (IN `id` INT)  BEGIN
	IF EXISTS (SELECT * FROM INM_USUARIO WHERE USU_CVE_ID = id) THEN
    BEGIN
		DELETE FROM INM_USUARIO 
	WHERE USU_CVE_ID =  id;

		SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;

END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarDatos` (IN `id` INT)  BEGIN

IF EXISTS(SELECT PER_CVE FROM INM_PERFIL  WHERE PER_CVE = id) THEN

SELECT B.PER_TELEFONO TELEFONO, B.PER_EMAIL CORREO, B.PER_CALLE CALLE, B.PER_COLONIA COLONIA,
B.PER_MUNICIPIO MUNICIPIO, B.PER_ESTADO ESTADO, B.PER_PAGO_CVE PAGO 

FROM INM_PERFIL B  WHERE B.PER_CVE = id;

ELSE 
SELECT "0" CV;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarPerfil` (IN `id` INT)  BEGIN

IF EXISTS(SELECT USU_CVE_ID FROM INM_USUARIO  WHERE USU_CVE_ID = id) THEN

SELECT A.USU_NOMBRE NOMBRE, A.USU_APELLIDO_PATERNO APELLIDO_PATERNO,
A.USU_APELLIDO_MATERNO APELLIDO_MATERNO, A.USU_USUARIO NOMBRE_USUARIO,

B.PER_TELEFONO TELEFONO, B.PER_EMAIL CORREO, B.PER_CALLE CALLE, B.PER_COLONIA COLONIA,
B.PER_MUNICIPIO MUNICIPIO, B.PER_ESTADO ESTADO,

C.PAGO_FORMA FORMA_PAGO

FROM INM_USUARIO A, INM_PERFIL B, INM_TIPO_PAGO C  
WHERE A.USU_CVE_ID = id 
AND B.PER_USU_CVE_ID = id
AND B.PER_PAGO_CVE = C.PAGO_CVE;
ELSE 
SELECT "0" CV;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarTerreno` (IN `id` INT)  BEGIN

IF EXISTS(SELECT TER_USU_CVE FROM INM_TERRENO WHERE TER_USU_CVE = id) 
THEN

SELECT A.TER_CVE ID, A.TER_CALLE CALLE, A.TERR_COLONIA COLONIA, A.TER_MUNICIPIO MUNICIPIO, A.TER_ESTADO ESTADO,
A.TER_LARGO LARGO, A.TER_ANCHO ANCHO, A.TER_TOTAL SUPERFICIE, A.TER_PRECIO PRECIO,
A.TER_DESC DESCRIPCION, A.TER_FECHA_REG FECHA,

B.TIPO_NOMBRE TIPO

FROM INM_TERRENO A, INM_TIPO_TERRENO B
WHERE A.TER_USU_CVE = id AND A.TER_ESTATUS = 1 AND A.TER_TIPO_CVE = B.TIPO_CVE;
ELSE 
SELECT "0" CLAVE;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarTerrenosReg` (IN `id` INT)  BEGIN

IF EXISTS(SELECT USU_CVE_ROL FROM INM_USUARIO WHERE USU_CVE_ID = id AND USU_CVE_ROL = 1 ) 
THEN

SELECT A.TER_CVE ID, CONCAT(A.TER_CALLE,' ', A.TERR_COLONIA,' ', A.TER_MUNICIPIO,' ', A.TER_ESTADO)
 DIRECCION,
 CONCAT(A.TER_LARGO,' X ', A.TER_ANCHO,' Superficie ', A.TER_TOTAL,' mts^2 ') MEDIDAS,
 
	A.TER_PRECIO PRECIO, A.TER_DESC DESCRIPCION, TER_ESTATUS ESTATUS, 
    TER_FECHA_REG FECHA_REGISTRO,

	CONCAT(B.USU_NOMBRE,' ', B.USU_APELLIDO_PATERNO,' ', B.USU_APELLIDO_MATERNO) PROPIETARIO,
    
    C.TIPO_NOMBRE TIPO

FROM INM_TERRENO A, INM_USUARIO B, INM_TIPO_TERRENO C

WHERE A.TER_USU_CVE = B.USU_CVE_ID AND TER_TIPO_CVE = TIPO_CVE  ORDER BY TER_FECHA_REG;

ELSE 

SELECT "0" CLAVE;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarUsuario` (IN `id` INT)  BEGIN

IF EXISTS(SELECT USU_CVE_ID FROM INM_USUARIO  WHERE USU_CVE_ID = id) THEN

SELECT A.USU_NOMBRE NOMBRE, A.USU_APELLIDO_PATERNO APELLIDO_PATERNO,
A.USU_APELLIDO_MATERNO APELLIDO_MATERNO, A.USU_USUARIO NOMBRE_USUARIO

FROM INM_USUARIO A WHERE A.USU_CVE_ID = id ;

ELSE 
SELECT "0" CV;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spMostrarUsuariosReg` (IN `id` INT)  BEGIN

IF EXISTS(SELECT USU_CVE_ROL FROM INM_USUARIO WHERE USU_CVE_ID = id AND USU_CVE_ROL = 1) 
THEN

SELECT A.USU_CVE_ID ID, CONCAT(A.USU_NOMBRE,' ', A.USU_APELLIDO_PATERNO,' ', A.USU_APELLIDO_MATERNO) NOMBRE,
A.USU_USUARIO USUARIO, USU_ESTATUS ESTATUS, USU_FECHA_REGISTRO FECHA_REGISTRO,

B.ROL_NOMBRE ROL

FROM INM_USUARIO A, INM_ROL B 

WHERE A.USU_CVE_ROL = B.ROL_CVE ORDER BY USU_CVE_ROL;
ELSE 

SELECT "0" CLAVE;
END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spRegistrarAdmin` (IN `NOMBRE` VARCHAR(50), IN `APELLIDOPAT` VARCHAR(50), IN `APELLIDOMAT` VARCHAR(50), IN `NOMUSU` VARCHAR(50), IN `PASS` VARCHAR(50))  BEGIN
	IF NOT EXISTS (SELECT * FROM INM_USUARIO
		WHERE USU_USUARIO = NOMUSU) THEN
	BEGIN
    INSERT INTO INM_USUARIO VALUES (NULL,1, NOMBRE, APELLIDOPAT, APELLIDOMAT, NOMUSU, PASS, 1, NOW());
    SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spRegistrarPerfil` (IN `TELEFONO` VARCHAR(50), IN `EMAIL` VARCHAR(80), IN `CALLE` VARCHAR(50), IN `COLONIA` VARCHAR(80), IN `MUNICIPIO` VARCHAR(50), IN `ESTADO` VARCHAR(50), IN `USUCVE` VARCHAR(50), IN `PAGOCVE` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
	IF NOT EXISTS (SELECT * FROM INM_PERFIL
		WHERE PER_EMAIL = EMAIL) THEN
	BEGIN
    INSERT INTO INM_PERFIL VALUES (NULL,TELEFONO, EMAIL, CALLE, COLONIA, MUNICIPIO, ESTADO, USUCVE,PAGOCVE);
    SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spRegistrarTerreno` (IN `CALLE` VARCHAR(50), IN `COLONIA` VARCHAR(50), IN `MUNICIPIO` VARCHAR(50), IN `ESTADO` VARCHAR(50), IN `LARGO` VARCHAR(50), IN `ANCHO` VARCHAR(50), IN `PRECIO` VARCHAR(50), IN `DESCRIPCION` VARCHAR(500), IN `USUCVE` VARCHAR(50), IN `TIPOCVE` VARCHAR(50))  BEGIN
	IF NOT EXISTS (SELECT * FROM INM_TERRENO
		WHERE TER_CALLE = CALLE 
        AND TERR_COLONIA = COLONIA 
        AND TER_MUNICIPIO = MUNICIPIO
        AND TER_ESTADO = ESTADO) THEN
	BEGIN
    INSERT INTO INM_TERRENO VALUES (NULL,CALLE, COLONIA, MUNICIPIO, ESTADO, LARGO,
    ANCHO, (LARGO*ANCHO), PRECIO,DESCRIPCION, 1, NOW(), USUCVE, TIPOCVE);
    SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spRegistrarUsuarios` (IN `NOMBRE` VARCHAR(50), IN `APELLIDOPAT` VARCHAR(50), IN `APELLIDOMAT` VARCHAR(50), IN `NOMUSU` VARCHAR(50), IN `PASS` VARCHAR(50))  MODIFIES SQL DATA
BEGIN
	IF NOT EXISTS (SELECT * FROM INM_USUARIO
		WHERE USU_USUARIO = NOMUSU) THEN
	BEGIN
    INSERT INTO INM_USUARIO VALUES (NULL,2, NOMBRE, APELLIDOPAT, APELLIDOMAT, NOMUSU, PASS, 1, NOW());
    SELECT '1' CLAVE;
    END;
    ELSE 
		SELECT '0' CLAVE;
	END IF;
END$$

CREATE DEFINER=`id7035083_pepe`@`%` PROCEDURE `spValidarAccesoAdm` (IN `usuario` VARCHAR(50), IN `contra` VARCHAR(50))  BEGIN
IF EXISTS(SELECT * FROM INM_USUARIO WHERE USU_USUARIO=usuario AND USU_CONTRASENA = contra) THEN 
SELECT A.USU_CVE_ID CLAVE, concat(A.USU_NOMBRE," ",A.USU_APELLIDO_PATERNO," ",A.USU_APELLIDO_MATERNO) NOMBRE,
B.ROL_NOMBRE ROL
from INM_USUARIO A, INM_ROL B
WHERE A.USU_USUARIO=usuario
AND A.USU_CONTRASENA = contra
AND A.USU_CVE_ROL= B.ROL_CVE
AND A.USU_ESTATUS=1;
ELSE
SELECT '0' CLAVE;
END IF;      
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_ESTADO`
--

CREATE TABLE `INM_ESTADO` (
  `ESTADO_CVE` int(11) NOT NULL,
  `ESTADO_NOMBRE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_ESTADO`
--

INSERT INTO `INM_ESTADO` (`ESTADO_CVE`, `ESTADO_NOMBRE`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Coahuila'),
(6, 'Colima'),
(7, 'Chiapas'),
(8, 'Chihuahua'),
(9, 'CDMX'),
(10, 'Durango'),
(11, 'Guanajuato'),
(12, 'Guerrero'),
(13, 'Hidalgo'),
(14, 'Jalisco'),
(15, 'Mexico'),
(16, 'Michoacan'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo Leon'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Queretaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosi'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_FOTO`
--

CREATE TABLE `INM_FOTO` (
  `FOTO_CVE` int(11) NOT NULL,
  `FOTO_NOMBRE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO_FOTO` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO_TER_CVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_PERFIL`
--

CREATE TABLE `INM_PERFIL` (
  `PER_CVE` int(11) NOT NULL,
  `PER_TELEFONO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_EMAIL` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_CALLE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_COLONIA` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_MUNICIPIO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_ESTADO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PER_USU_CVE_ID` int(11) DEFAULT NULL,
  `PER_PAGO_CVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_PERFIL`
--

INSERT INTO `INM_PERFIL` (`PER_CVE`, `PER_TELEFONO`, `PER_EMAIL`, `PER_CALLE`, `PER_COLONIA`, `PER_MUNICIPIO`, `PER_ESTADO`, `PER_USU_CVE_ID`, `PER_PAGO_CVE`) VALUES
(1, '5512345678', 'jessica@mail.com', 'Fernando Montes de Oca', 'Sto. Tomas', 'Tizayuca', 'Hidalgo', 8, 5),
(2, '7711234567', 'maria@gmail.com', 'Sur #1', 'Hidalgo', 'Gomez Farias', 'Coahuila', 5, 4),
(3, '552468010', 'alberto@gmail.com', 'Sto Domingo', 'Barrio Alto', 'Zacatecas', 'Zacatecas', 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_ROL`
--

CREATE TABLE `INM_ROL` (
  `ROL_CVE` int(11) NOT NULL,
  `ROL_NOMBRE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ROL_DESCRIPCION` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ROL_ESTATUS` int(11) NOT NULL,
  `ROL_FECHA_REGISTRO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_ROL`
--

INSERT INTO `INM_ROL` (`ROL_CVE`, `ROL_NOMBRE`, `ROL_DESCRIPCION`, `ROL_ESTATUS`, `ROL_FECHA_REGISTRO`) VALUES
(1, 'Administrador', 'Administrador del sitio', 1, '2018-10-21 18:04:09'),
(2, 'Vendedor', 'Vende un bien inmobiliario', 1, '2018-11-19 05:14:46'),
(3, 'Comprador', 'Compra un bien inmobiliario', 1, '2018-11-19 05:14:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_TERRENO`
--

CREATE TABLE `INM_TERRENO` (
  `TER_CVE` int(11) NOT NULL,
  `TER_CALLE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TERR_COLONIA` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_MUNICIPIO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_ESTADO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_LARGO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_ANCHO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_TOTAL` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_PRECIO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TER_DESC` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `TER_ESTATUS` int(11) DEFAULT NULL,
  `TER_FECHA_REG` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TER_USU_CVE` int(11) DEFAULT NULL,
  `TER_TIPO_CVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_TERRENO`
--

INSERT INTO `INM_TERRENO` (`TER_CVE`, `TER_CALLE`, `TERR_COLONIA`, `TER_MUNICIPIO`, `TER_ESTADO`, `TER_LARGO`, `TER_ANCHO`, `TER_TOTAL`, `TER_PRECIO`, `TER_DESC`, `TER_ESTATUS`, `TER_FECHA_REG`, `TER_USU_CVE`, `TER_TIPO_CVE`) VALUES
(1, 'Norte #3', 'Lomas Altas', 'Ecatepec', 'Mexico', '120', '40', '4800', '50000', 'Terreno amplio apto para bodega', 1, '2018-12-03 08:44:06', 8, 6),
(2, 'Zurich', 'Mazarik', 'Benito Juarez', 'CDMX', '20', '40', '800', '120000', 'Excelente Ubicacion', 1, '2018-12-03 08:45:33', 8, 2),
(3, 'Juarez #34', 'Periodistas', 'Cancun', 'Quintana Roo', '120', '132', '15840', '120000', 'Terreno a la orilla de la playa', 1, '2018-12-03 15:34:21', 5, 3),
(4, 'Fernando Montes de Oca #4', 'Centro', 'Juarez', 'Tamaulipas', '132', '15', '1980', '530000', 'Departamento amplio, permite mascotas', 1, '2018-12-03 15:36:03', 5, 2),
(5, 'Benito Juarez #7', 'Norte 2', 'Cuautla', 'Morelos', '50', '50', '2500', '36000', 'Excelente lugar para almacenar productos agricolas', 1, '2018-12-03 15:38:13', 5, 6),
(6, 'Niños Heroes', 'Barrio San Martin', 'Colima', 'Colima', '30', '20', '600', '156000', 'Rento local comercial', 0, '2018-12-03 15:45:58', 6, 5),
(7, 'San Antonio #5', 'Villas de Hermosillo', 'Hermosillo', 'Sonora', '100', '200', '20000', '200000', 'Rento oficinas para diferentes despachos', 1, '2018-12-03 15:45:33', 6, 4),
(8, 'Sto Domingo', 'Norte 2', 'San Ignacio', 'Oaxaca', '560', '450', '252000', '120000', 'Vendo oficina para consultorio o despacho medico', 1, '2018-12-03 16:17:41', 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_TIPO_PAGO`
--

CREATE TABLE `INM_TIPO_PAGO` (
  `PAGO_CVE` int(11) NOT NULL,
  `PAGO_FORMA` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_TIPO_PAGO`
--

INSERT INTO `INM_TIPO_PAGO` (`PAGO_CVE`, `PAGO_FORMA`) VALUES
(1, 'Tarjeta de credito'),
(2, 'Tarjeta de Debito'),
(3, 'Credito Hipotecario'),
(4, 'Deposito Bancario'),
(5, 'Transferencia Bancaria'),
(6, 'Paypal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_TIPO_TERRENO`
--

CREATE TABLE `INM_TIPO_TERRENO` (
  `TIPO_CVE` int(11) NOT NULL,
  `TIPO_NOMBRE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_TIPO_TERRENO`
--

INSERT INTO `INM_TIPO_TERRENO` (`TIPO_CVE`, `TIPO_NOMBRE`) VALUES
(1, 'Casa'),
(2, 'Departamento'),
(3, 'Terreno'),
(4, 'Oficina'),
(5, 'Local'),
(6, 'Bodega'),
(7, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INM_USUARIO`
--

CREATE TABLE `INM_USUARIO` (
  `USU_CVE_ID` int(11) NOT NULL,
  `USU_CVE_ROL` int(11) NOT NULL,
  `USU_NOMBRE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `USU_APELLIDO_PATERNO` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `USU_APELLIDO_MATERNO` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `USU_USUARIO` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `USU_CONTRASENA` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `USU_ESTATUS` int(11) NOT NULL,
  `USU_FECHA_REGISTRO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `INM_USUARIO`
--

INSERT INTO `INM_USUARIO` (`USU_CVE_ID`, `USU_CVE_ROL`, `USU_NOMBRE`, `USU_APELLIDO_PATERNO`, `USU_APELLIDO_MATERNO`, `USU_USUARIO`, `USU_CONTRASENA`, `USU_ESTATUS`, `USU_FECHA_REGISTRO`) VALUES
(1, 1, 'Zalma', 'Castro', 'Rosas', 'Zalma', 'zalma123', 1, '2018-12-03 08:28:43'),
(2, 1, 'Alicia', 'Martinez', 'Martinez', 'Alicia', 'alicia123', 1, '2018-12-03 08:28:43'),
(3, 1, 'Angel', 'Ambriz', 'Hernandez', 'Angel', 'angel123', 1, '2018-12-03 08:28:43'),
(4, 1, 'Fredy', 'Solis', 'Portilla', 'Fredy', 'fredy123', 1, '2018-12-03 08:28:43'),
(5, 2, 'Maria', 'Lopez', 'Garcia', 'Maria', 'maria123', 1, '2018-12-03 08:36:16'),
(6, 2, 'Alberto', 'Cruz', 'Teofilo', 'Alberto', 'alberto123', 1, '2018-12-03 08:36:16'),
(7, 2, 'Luis', 'Gonzalez', 'Lechuga', 'Luis', 'luis123', 1, '2018-12-03 08:36:16'),
(8, 2, 'Jessica', 'Elizalde', 'Ortega', 'Jessica', 'jessica123', 1, '2018-12-03 08:36:16'),
(9, 2, 'Eduardo', 'Martinez', 'Perez', 'Eduardo', 'eduardo123', 1, '2018-12-03 08:36:16'),
(10, 2, 'Mario', 'Moreno', 'Alarcon', 'Mario', 'mario123', 1, '2018-12-03 15:24:00'),
(11, 2, 'Marco', 'Acosta', 'Lopez', 'Marco', '12345', 1, '2018-12-08 07:22:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('','facebook','google','twitter') COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `INM_ESTADO`
--
ALTER TABLE `INM_ESTADO`
  ADD PRIMARY KEY (`ESTADO_CVE`);

--
-- Indices de la tabla `INM_FOTO`
--
ALTER TABLE `INM_FOTO`
  ADD PRIMARY KEY (`FOTO_CVE`);

--
-- Indices de la tabla `INM_PERFIL`
--
ALTER TABLE `INM_PERFIL`
  ADD PRIMARY KEY (`PER_CVE`);

--
-- Indices de la tabla `INM_ROL`
--
ALTER TABLE `INM_ROL`
  ADD PRIMARY KEY (`ROL_CVE`);

--
-- Indices de la tabla `INM_TERRENO`
--
ALTER TABLE `INM_TERRENO`
  ADD PRIMARY KEY (`TER_CVE`);

--
-- Indices de la tabla `INM_TIPO_PAGO`
--
ALTER TABLE `INM_TIPO_PAGO`
  ADD PRIMARY KEY (`PAGO_CVE`);

--
-- Indices de la tabla `INM_TIPO_TERRENO`
--
ALTER TABLE `INM_TIPO_TERRENO`
  ADD PRIMARY KEY (`TIPO_CVE`);

--
-- Indices de la tabla `INM_USUARIO`
--
ALTER TABLE `INM_USUARIO`
  ADD PRIMARY KEY (`USU_CVE_ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `INM_ESTADO`
--
ALTER TABLE `INM_ESTADO`
  MODIFY `ESTADO_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `INM_FOTO`
--
ALTER TABLE `INM_FOTO`
  MODIFY `FOTO_CVE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `INM_PERFIL`
--
ALTER TABLE `INM_PERFIL`
  MODIFY `PER_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `INM_ROL`
--
ALTER TABLE `INM_ROL`
  MODIFY `ROL_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `INM_TERRENO`
--
ALTER TABLE `INM_TERRENO`
  MODIFY `TER_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `INM_TIPO_PAGO`
--
ALTER TABLE `INM_TIPO_PAGO`
  MODIFY `PAGO_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `INM_TIPO_TERRENO`
--
ALTER TABLE `INM_TIPO_TERRENO`
  MODIFY `TIPO_CVE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `INM_USUARIO`
--
ALTER TABLE `INM_USUARIO`
  MODIFY `USU_CVE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

