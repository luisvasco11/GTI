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
  `correo` varchar(100) DEFAULT NULL,
  `correo_personal` varchar(100) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `new_personas` 
CHARACTER SET = utf8 , COLLATE = utf8_spanish_ci ;
ALTER TABLE `new_personas` 
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `proyecto` `proyecto` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `cargo` `cargo` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `jefe` `jefe` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `correo` `correo` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `correo_personal` `correo_personal` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `celular` `celular` VARCHAR(45) NULL DEFAULT NULL ;


CREATE TABLE `new_proyectos` (
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `registro_actividad` 
DROP FOREIGN KEY `contratoFK`;

ALTER TABLE `registro_actividad` 
CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ,
DROP INDEX `id_contrato` ;

ALTER TABLE `registro_actividad` CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ;

ALTER TABLE `usuario` ADD COLUMN `fecha_control` DATE NULL AFTER `habilidades`;

-- update usuario set fecha_control = "<fecha de control>"; aplicar como fecha de control


-- Carlos lopez 06/03/2017 - aplicado arus
-- Carlos lopez 06/03/2017 - aplicado casa


ALTER SCHEMA `<db>`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_spanish_ci ;

ALTER TABLE `registro_actividad` 
CHARACTER SET = utf8 , COLLATE = utf8_unicode_ci ;

ALTER TABLE `new_proyectos` 
CHARACTER SET = utf8 , COLLATE = utf8_unicode_ci ;

ALTER TABLE `usuario` 
COLLATE = utf8_unicode_ci ;

-- proceso de creación de usuarios

-- 1. renombrar table usuario a usuario_tmp
ALTER TABLE `usuario` RENAME TO  `usuario_tmp` ;
-- 2. se crea tabla new_usuario con los campos de usuario
create table new_usuario as SELECT u.id,p.cedula,p.correo,u.cargo_id as rol,u.password,u.estado,u.fecha_control,u.area FROM new_personas p ,usuario_tmp u where u.correo = p.correo;
-- 3. se altera la tabla de registro_actividad incluyendo la cedula del usuario
ALTER TABLE `registro_actividad` ADD COLUMN `cedula` VARCHAR(45) NULL AFTER `tiempo_calculado`;
-- 4. actualizar cedulas en registro_actividad
update registro_actividad p set cedula = (select u.cedula from new_usuario u where u.id = p.user_id )

ALTER TABLE `gti`.`registro_actividad` 
CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ;


-- Carlos lopez 07/03/2017 - aplicado arus
