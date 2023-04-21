/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - senatimat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`senatimat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `senatimat`;

/*Table structure for table `cargos` */

DROP TABLE IF EXISTS `cargos`;

CREATE TABLE `cargos` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(30) NOT NULL,
  PRIMARY KEY (`idcargo`),
  UNIQUE KEY `uk_cargo_crg` (`cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cargos` */

insert  into `cargos`(`idcargo`,`cargo`) values 
(4,'Asist. Academico'),
(3,'Asist. Administrativo'),
(6,'Coordinador CIS'),
(5,'Coordinador ETI'),
(1,'Instructor'),
(2,'Jefe Centro');

/*Table structure for table `carreras` */

DROP TABLE IF EXISTS `carreras`;

CREATE TABLE `carreras` (
  `idcarrera` int(11) NOT NULL AUTO_INCREMENT,
  `idescuela` int(11) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  PRIMARY KEY (`idcarrera`),
  UNIQUE KEY `uk_carrera_car` (`carrera`),
  KEY `fk_idescuela_car` (`idescuela`),
  CONSTRAINT `fk_idescuela_car` FOREIGN KEY (`idescuela`) REFERENCES `escuelas` (`idescuela`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `carreras` */

insert  into `carreras`(`idcarrera`,`idescuela`,`carrera`) values 
(1,1,'Diseño Gráfico Digital'),
(2,1,'Ingeniería de Software con IA'),
(3,1,'Cyberseguridad'),
(4,2,'Administración de empresas'),
(5,2,'Administración Industrial'),
(6,2,'Prevencionista de Riesgo'),
(7,3,'Soldador Universal'),
(8,3,'Mecánico de mantenimiento'),
(9,3,'Soldador estructuras metálicas');

/*Table structure for table `colaboradores` */

DROP TABLE IF EXISTS `colaboradores`;

CREATE TABLE `colaboradores` (
  `idcolaborador` int(11) NOT NULL AUTO_INCREMENT,
  `idcargo` int(11) NOT NULL,
  `idsede` int(11) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `telefono` char(9) NOT NULL,
  `tipocontrato` char(1) NOT NULL DEFAULT 'P',
  `cv` varchar(100) DEFAULT NULL,
  `direccion` varchar(60) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaupdate` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcolaborador`),
  KEY `fk_idcargo_clb` (`idcargo`),
  KEY `fk_idsede_clb` (`idsede`),
  CONSTRAINT `fk_idcargo_clb` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`idcargo`),
  CONSTRAINT `fk_idsede_clb` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`idsede`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `colaboradores` */

insert  into `colaboradores`(`idcolaborador`,`idcargo`,`idsede`,`apellidos`,`nombres`,`telefono`,`tipocontrato`,`cv`,`direccion`,`fecharegistro`,`fechaupdate`,`estado`) values 
(1,1,1,'Gutierrez Maldonado','Juan','987654321','P',NULL,'Calle Random','2023-04-17 15:59:46',NULL,'1'),
(2,2,2,'Castillo Torres','Yisus','963258741','P',NULL,'Calle Lima','2023-04-17 15:59:46',NULL,'1'),
(3,3,3,'Puma Huaman','Andres','951263478','C',NULL,'Calle Brazil','2023-04-17 16:18:59',NULL,'1'),
(4,5,1,'Downey Jr','Robert John','957486321','P','70cca67c87e3abd813288bfda7f800e6de0d8dcc.pdf','New York City','2023-04-21 10:58:38',NULL,'1');

/*Table structure for table `escuelas` */

DROP TABLE IF EXISTS `escuelas`;

CREATE TABLE `escuelas` (
  `idescuela` int(11) NOT NULL AUTO_INCREMENT,
  `escuela` varchar(50) NOT NULL,
  PRIMARY KEY (`idescuela`),
  UNIQUE KEY `uk_escuela_esc` (`escuela`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `escuelas` */

insert  into `escuelas`(`idescuela`,`escuela`) values 
(2,'Administración'),
(1,'ETI'),
(3,'Metal mecánica');

/*Table structure for table `estudiantes` */

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `idestudiante` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `tipodocumento` char(1) NOT NULL DEFAULT 'D',
  `nrodocumento` char(8) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `idcarrera` int(11) NOT NULL,
  `idsede` int(11) NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaupdate` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idestudiante`),
  UNIQUE KEY `uk_nrodocumento_est` (`tipodocumento`,`nrodocumento`),
  KEY `fk_idcarrera_est` (`idcarrera`),
  KEY `fk_idsede_est` (`idsede`),
  CONSTRAINT `fk_idcarrera_est` FOREIGN KEY (`idcarrera`) REFERENCES `carreras` (`idcarrera`),
  CONSTRAINT `fk_idsede_est` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`idsede`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `estudiantes` */

insert  into `estudiantes`(`idestudiante`,`apellidos`,`nombres`,`tipodocumento`,`nrodocumento`,`fechanacimiento`,`idcarrera`,`idsede`,`fotografia`,`fecharegistro`,`fechaupdate`,`estado`) values 
(1,'Martinez','Carlos','D','44445555','2000-01-01',1,1,NULL,'2023-04-17 07:56:46',NULL,'1'),
(2,'Ochoa','Fiorella','D','77778888','2000-10-10',4,2,NULL,'2023-04-17 07:56:46',NULL,'1'),
(3,'Perez','Roxana','D','88881111','2001-03-03',7,3,NULL,'2023-04-17 07:56:46',NULL,'1'),
(4,'Quintana','Tania','D','33334444','2001-05-05',9,4,NULL,'2023-04-17 07:56:46',NULL,'1'),
(5,'Perez Napa','Fiorella','D','99776655','2000-01-01',1,1,NULL,'2023-04-17 09:08:01',NULL,'1'),
(6,'fsad','agds','D','8843366','2023-04-05',5,1,NULL,'2023-04-17 09:47:04',NULL,'1'),
(7,'quesada','miguel','D','55887711','2000-04-05',4,4,NULL,'2023-04-17 11:06:56',NULL,'1'),
(9,'Apolaya Yataco','Zara','D','88776655','2000-04-05',2,1,NULL,'2023-04-17 11:28:07',NULL,'1'),
(10,'Hemsworth','Chris','D','85214769','2001-01-01',4,1,'de0c2407beb1c2b74ff0cd5cfe8cbbb81a66ea5d.jpg','2023-04-17 17:12:20',NULL,'1');

/*Table structure for table `sedes` */

DROP TABLE IF EXISTS `sedes`;

CREATE TABLE `sedes` (
  `idsede` int(11) NOT NULL AUTO_INCREMENT,
  `sede` varchar(40) NOT NULL,
  PRIMARY KEY (`idsede`),
  UNIQUE KEY `uk_sede_sde` (`sede`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sedes` */

insert  into `sedes`(`idsede`,`sede`) values 
(4,'Ayacucho'),
(1,'Chincha'),
(3,'Ica'),
(2,'Pisco');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `claveacceso` varchar(80) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usuario_user` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`usuario`,`claveacceso`,`estado`) values 
(1,'El Random','$2y$10$OQQxsU/5eFqY2q3Z.gLViOR83gUbL0mU5NoR3k6n4ZArcCjpKc.vS','1'),
(2,'Jhon Francia','$2y$10$0N4ks0g.Ny9OS4rhO/gjwu2/xXI8q/xfC2NGN0yV5dVW7G5ztuBZO','1');

/* Procedure structure for procedure `spu_cargos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cargos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cargos_listar`()
BEGIN
	SELECT * FROM cargos ORDER BY 2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_carreras_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_carreras_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_carreras_listar`(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_colaboradores_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_colaboradores_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_colaboradores_eliminar`(IN _idcolaborador INT)
BEGIN
	DELETE FROM colaboradores
	WHERE idcolaborador = _idcolaborador;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_colaboradores_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_colaboradores_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_colaboradores_listar`()
BEGIN
	SELECT	CLB.idcolaborador,CLB.apellidos,CLB.nombres,
				CRG.cargo,SED.sede,
				CLB.telefono,CLB.tipocontrato,
				CLB.cv,CLB.direccion
		FROM colaboradores CLB
		INNER JOIN cargos CRG ON CRG.idcargo = CLB.idcargo
		INNER JOIN sedes SED ON SED.idsede = CLB.idsede
		WHERE CLB.estado = '1';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_colaboradores_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_colaboradores_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_colaboradores_registrar`(
	in _idcargo				INT,
	in _idsede				INT,
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _telefono			CHAR(9),
	IN _tipocontrato		CHAR(1),
	IN _cv					varchar(100),
	IN _direccion 			varchar(60)
)
BEGIN
	-- Validar el contenido de _cv
	IF _cv = '' THEN 
		SET _cv = NULL;
	END IF;
	INSERT INTO colaboradores 
	(idcargo, idsede, apellidos, nombres, telefono, tipocontrato, cv, direccion) VALUES
	(_idcargo, _idsede, _apellidos, _nombres, _telefono, _tipocontrato, _cv, _direccion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cv_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cv_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cv_eliminar`(IN idcolaborador_ INT)
BEGIN
	SELECT cv FROM colaboradores WHERE idcolaborador = idcolaborador_;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_escuelas_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_escuelas_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_escuelas_listar`()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_estudiantes_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_estudiantes_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_estudiantes_listar`()
BEGIN
	SELECT	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_estudiantes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_estudiantes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_estudiantes_registrar`(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;
	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_estudiante_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_estudiante_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_estudiante_eliminar`(IN idestudiante_ INT)
BEGIN
	DELETE FROM estudiantes
	WHERE idestudiante = idestudiante_;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_fotografia_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_fotografia_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_fotografia_eliminar`(IN idestudiante_ INT)
BEGIN
	SELECT fotografia FROM estudiantes WHERE idestudiante = idestudiante_;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_sedes_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_sedes_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_sedes_listar`()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuario_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuario_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuario_login`(IN _usuario VARCHAR(30))
BEGIN
	SELECT 	idusuario, usuario, claveacceso
	FROM usuarios
	WHERE usuario = _usuario AND estado = '1';
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
