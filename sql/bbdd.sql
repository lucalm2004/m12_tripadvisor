-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_tripadvisor
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_tripadvisor` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;


USE `db_tripadvisor` ;

-- -----------------------------------------------------
-- Table `db_tripadvisor`.`tbl_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_tripadvisor`.`tbl_user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL,
  `mail` VARCHAR(100) NULL,
  `pwd` VARCHAR(100) NULL,
  `nombre_completo` VARCHAR(100) NULL,
  `es_admin` TINYINT(1) NOT NULL,
  `valid` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_tripadvisor`.`tbl_restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_tripadvisor`.`tbl_restaurante` (
  `id_restaurante` INT NOT NULL AUTO_INCREMENT,
  `nombre_restuarante` VARCHAR(45) NULL,
  `propietario` INT NULL,
  `direccion` TEXT NULL,
  `valoracion` DECIMAL(2,1) NULL,
  `precio_medio` DECIMAL(5,2) NULL,
  `imagen_res` VARCHAR(20) NULL,
  `email_oficial` VARCHAR(100) NULL,
  PRIMARY KEY (`id_restaurante`),
  CONSTRAINT `fk_propietario`
    FOREIGN KEY (`propietario`)
    REFERENCES `db_tripadvisor`.`tbl_user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_propietario_idx` ON `db_tripadvisor`.`tbl_restaurante` (`propietario` ASC);


-- -----------------------------------------------------
-- Table `db_tripadvisor`.`tbl_valoracion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_tripadvisor`.`tbl_valoracion` (
  `id_valoracion` INT NOT NULL AUTO_INCREMENT,
  `username` INT NULL,
  `valoracion` DECIMAL(2,1) NULL,
  `comentario` TEXT NULL,
  `restaurante` INT NULL,
  PRIMARY KEY (`id_valoracion`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`username`)
    REFERENCES `db_tripadvisor`.`tbl_user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_res`
    FOREIGN KEY (`restaurante`)
    REFERENCES `db_tripadvisor`.`tbl_restaurante` (`id_restaurante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_user_idx` ON `db_tripadvisor`.`tbl_valoracion` (`username` ASC);

CREATE INDEX `fk_res_idx` ON `db_tripadvisor`.`tbl_valoracion` (`restaurante` ASC);


-- -----------------------------------------------------
-- Table `db_tripadvisor`.`tipo_comida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_tripadvisor`.`tipo_comida` (
  `id_comida` INT NOT NULL AUTO_INCREMENT,
  `nombre_comida` VARCHAR(45) NULL,
  PRIMARY KEY (`id_comida`))
ENGINE = InnoDB
COMMENT = '			';


-- -----------------------------------------------------
-- Table `db_tripadvisor`.`tbl_comida_restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_tripadvisor`.`tbl_comida_restaurante` (
  `id_comida_restaurante` INT NOT NULL AUTO_INCREMENT,
  `id_comida` INT NULL,
  `id_resturante` INT NULL,
  PRIMARY KEY (`id_comida_restaurante`),
  CONSTRAINT `tbl_comida`
    FOREIGN KEY (`id_comida`)
    REFERENCES `db_tripadvisor`.`tipo_comida` (`id_comida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tbl_restaurante`
    FOREIGN KEY (`id_resturante`)
    REFERENCES `db_tripadvisor`.`tbl_restaurante` (`id_restaurante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `tbl_comida_idx` ON `db_tripadvisor`.`tbl_comida_restaurante` (`id_comida` ASC);

CREATE INDEX `tbl_restaurante_idx` ON `db_tripadvisor`.`tbl_comida_restaurante` (`id_resturante` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Americana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Caribeña');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Mediterránea');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Libanesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Peruana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Argentina');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Chilena');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Colombiana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Venezolana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Ecuatoriana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Árabe');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Alemana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Rusa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Nórdica');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Polaca');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Hawaiana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Sudafricana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Marroquí');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Turca');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Escandinava');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Irlandesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Australiana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Austriaca');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Belga');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Suiza');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Portuguesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Húngara');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Sueca');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Danesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Finlandesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Italiana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Mexicana');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Española');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('China');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Japonesa');
INSERT INTO `db_tripadvisor`.`tipo_comida` (`nombre_comida`) VALUES ('Francesa');

