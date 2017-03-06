CREATE TABLE `new_lider_contratos` (
  `codigo` varchar(45) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `id_lider` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`,`id_lider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `new_personas` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `proyecto` varchar(100) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `jefe` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `new_proyectos` (
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `bitacora`.`registro_actividad` 
DROP FOREIGN KEY `contratoFK`;

ALTER TABLE `bitacora`.`registro_actividad` 
CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ,
DROP INDEX `id_contrato` ;

ALTER TABLE `bitacora`.`registro_actividad` CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ;

ALTER TABLE `bitacora`.`usuario` ADD COLUMN `fecha_control` DATE NULL AFTER `habilidades`;

-- update usuario set fecha_control = "<fecha de control>"; aplicar como fecha de control

ALTER TABLE `bitacora`.`registro_actividad` 
DROP FOREIGN KEY `contratoFK`;

-- Carlos lopez 06/03/2017 - aplicado
