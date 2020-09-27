-- MySQL Script generated by MySQL Workbench
-- 06/06/20 08:44:53
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema sparta_city
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sparta_city` ;

-- -----------------------------------------------------
-- Schema sparta_city
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sparta_city` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci ;
USE `sparta_city` ;

-- -----------------------------------------------------
-- Table `sparta_city`.`tbladministrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tbladministrador` (
  `idadmin` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `usuario` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `cedula` INT(11) NOT NULL COMMENT '',
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `telefono` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `imagen` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `tipo` VARCHAR(13) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL DEFAULT 'Administrador' COMMENT '',
  PRIMARY KEY (`idadmin`)  COMMENT '',
  UNIQUE INDEX `cedula` (`cedula` ASC)  COMMENT '',
  UNIQUE INDEX `usuario` (`usuario` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbladministrador`
--

INSERT INTO `tbladministrador` (`idadmin`, `usuario`, `password`, `cedula`, `nombres`, `apellidos`, `telefono`, `imagen`, `tipo`) VALUES
(6, 'admin', '$2y$10$MgOq0CGI/c95p.vQZo9kh.Ss/NOHgK4lWJxZ9dlgmFAkIv95Nr3G6', 21, 'Tata', 'tata', '11', 'fotoperfil/admin/21.jpeg', 'Administrador');

-- -----------------------------------------------------
-- Table `sparta_city`.`tblcategoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblcategoria` (
  `idcategoria` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idcategoria`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tbljugador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tbljugador` (
  `idjugador` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `usuario` VARCHAR(45) CHARACTER SET 'utf8mb4' NOT NULL COMMENT '',
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `telefono` INT(11) NOT NULL COMMENT '',
  `fecha_nac` DATE NOT NULL COMMENT '',
  `posicion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `sexo` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `edad` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `tipo_doc` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `documento` INT(11) NOT NULL COMMENT '',
  `peso` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `altura` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `imagen` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `categoria_idcategoria` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`idjugador`)  COMMENT '',
  UNIQUE INDEX `documento_UNIQUE` (`documento` ASC)  COMMENT '',
  UNIQUE INDEX `usuario` (`usuario` ASC)  COMMENT '',
  INDEX `fk_jugador_categoria1_idx` (`categoria_idcategoria` ASC)  COMMENT '',
  CONSTRAINT `fk_jugador_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `sparta_city`.`tblcategoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblasistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblasistencia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `asistencia` BINARY(1) NOT NULL COMMENT '',
  `tbljugador_idjugador` INT(11) NOT NULL COMMENT '',
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tblAsistencia_tbljugador1_idx` (`tbljugador_idjugador` ASC)  COMMENT '',
  CONSTRAINT `fk_tblAsistencia_tbljugador1`
    FOREIGN KEY (`tbljugador_idjugador`)
    REFERENCES `sparta_city`.`tbljugador` (`idjugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tbltecnico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tbltecnico` (
  `idtecnico` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `cedula` INT(11) NOT NULL COMMENT '',
  `usuario` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `imagen` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `telefono` INT(11) NOT NULL COMMENT '',
  `tipo` VARCHAR(7) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL DEFAULT 'Tecnico' COMMENT '',
  `fecha_nac` DATE NOT NULL COMMENT '',
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idtecnico`)  COMMENT '',
  UNIQUE INDEX `cedula_UNIQUE` (`cedula` ASC)  COMMENT '',
  UNIQUE INDEX `usuario` (`usuario` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblcategoriatecnico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblcategoriatecnico` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `tecnico_idtecnico` INT(11) NOT NULL COMMENT '',
  `categoria_idcategoria` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tblcategoriatecnico_tecnico_idx` (`tecnico_idtecnico` ASC)  COMMENT '',
  INDEX `fk_tblcategoriatecnico_categoria1_idx` (`categoria_idcategoria` ASC)  COMMENT '',
  CONSTRAINT `fk_tblcategoriatecnico_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `sparta_city`.`tblcategoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblcategoriatecnico_tecnico`
    FOREIGN KEY (`tecnico_idtecnico`)
    REFERENCES `sparta_city`.`tbltecnico` (`idtecnico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblentrenamientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblentrenamientos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `dia_semana` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `hora_inicio` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `hora_salida` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `categoria_idcategoria` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tblEntrenamientos_categoria1_idx` (`categoria_idcategoria` ASC)  COMMENT '',
  CONSTRAINT `fk_tblEntrenamientos_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `sparta_city`.`tblcategoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblgaleria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblgaleria` (
  `idgaleria` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `foto` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idgaleria`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblgaleriainicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblgaleriainicio` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `parrafo` VARCHAR(250) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `foto` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblhistoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblhistoria` (
  `idhistoria` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NULL DEFAULT NULL COMMENT '',
  `ano` INT(4) NOT NULL COMMENT '',
  `fecha` DATE NOT NULL COMMENT '',
  `comentario` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `imagen` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idhistoria`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblintroduccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblintroduccion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `foto` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblpadre_familia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblpadre_familia` (
  `idpadre` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `telefono` INT(11) NOT NULL COMMENT '',
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `documento` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`idpadre`)  COMMENT '',
  UNIQUE INDEX `documento_UNIQUE` (`documento` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tbljugador_padre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tbljugador_padre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `padre_familia_idpadre` INT(11) NOT NULL COMMENT '',
  `jugador_idjugador` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_tblJugador_Padre_padre_familia1_idx` (`padre_familia_idpadre` ASC)  COMMENT '',
  INDEX `fk_tblJugador_Padre_jugador1_idx` (`jugador_idjugador` ASC)  COMMENT '',
  CONSTRAINT `fk_tblJugador_Padre_jugador1`
    FOREIGN KEY (`jugador_idjugador`)
    REFERENCES `sparta_city`.`tbljugador` (`idjugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblJugador_Padre_padre_familia1`
    FOREIGN KEY (`padre_familia_idpadre`)
    REFERENCES `sparta_city`.`tblpadre_familia` (`idpadre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblmensajes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblmensajes` (
  `idmsn` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `fecha` DATE NOT NULL COMMENT '',
  `mensaje` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `estado` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idmsn`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblmensualidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblmensualidad` (
  `idmensualidad` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `fechapago` DATE NOT NULL COMMENT '',
  `mensual` DATE NOT NULL COMMENT '',
  `valor` VARCHAR(11) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `jugador_idjugador` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`idmensualidad`)  COMMENT '',
  INDEX `fk_mensualidad_jugador1_idx` (`jugador_idjugador` ASC)  COMMENT '',
  CONSTRAINT `fk_mensualidad_jugador1`
    FOREIGN KEY (`jugador_idjugador`)
    REFERENCES `sparta_city`.`tbljugador` (`idjugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tblpartido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tblpartido` (
  `idpartido` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `fecha` DATE NOT NULL COMMENT '',
  `hora` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `lugar` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `equipo1` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `equipo2` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idpartido`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `sparta_city`.`tbltarifas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sparta_city`.`tbltarifas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `descripcion` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  `valor` DECIMAL(9,2) NOT NULL COMMENT '',
  `comentario` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
