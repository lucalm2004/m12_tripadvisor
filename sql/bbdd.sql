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
(25, 'Suiza'),
(26, 'Portuguesa'),
(27, 'Húngara'),
(28, 'Sueca'),
(29, 'Danesa'),
(30, 'Finlandesa'),
(31, 'Italiana'),
(32, 'Mexicana'),
(33, 'Española'),
(34, 'China'),
(35, 'Japonesa'),
(36, 'Francesa'),
(37, 'Americana'),
(38, 'Caribeña'),
(39, 'Mediterránea'),
(40, 'Libanesa'),
(41, 'Peruana'),
(42, 'Argentina'),
(43, 'Chilena'),
(44, 'Colombiana'),
(45, 'Venezolana'),
(46, 'Ecuatoriana'),
(47, 'Árabe'),
(48, 'Alemana'),
(49, 'Rusa'),
(50, 'Nórdica'),
(51, 'Polaca'),
(52, 'Hawaiana'),
(53, 'Sudafricana'),
(54, 'Marroquí'),
(55, 'Turca'),
(56, 'Escandinava'),
(57, 'Irlandesa'),
(58, 'Australiana'),
(59, 'Austriaca'),
(60, 'Belga'),
(61, 'Suiza'),
(62, 'Portuguesa'),
(63, 'Húngara'),
(64, 'Sueca'),
(65, 'Danesa'),
(66, 'Finlandesa'),
(67, 'Italiana'),
(68, 'Mexicana'),
(69, 'Española'),
(70, 'China'),
(71, 'Japonesa'),
(72, 'Francesa');

INSERT INTO `tbl_user` (`id_user`, `username`, `mail`, `pwd`, `nombre_completo`, `es_admin`, `valid`) VALUES
(2, 'user2', 'user2@example.com', 'password2', 'User Two', 0, 1),
(3, 'user3', 'user3@example.com', 'password3', 'User Three', 0, 1),
(4, 'user4', 'user4@example.com', 'password4', 'User Four', 0, 1),
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
(20, 'admin10', 'admin10@example.com', 'adminpass10', 'Admin Ten', 1, 1);

INSERT INTO `tbl_restaurante` (`id_restaurante`, `nombre_restuarante`, `propietario`, `direccion`, `valoracion`, `precio_medio`, `imagen_res`, `email_oficial`) VALUES
(1, 'Restaurant One', 1, '123 Main St, Cityville', 4.5, 25.00, 'res1.jpg', 'info@restaurantone.com'),
(2, 'Restaurant Two', 2, '456 Elm St, Townsville', 3.8, 20.00, 'res2.jpg', 'info@restauranttwo.com'),
(3, 'Restaurant Three', 3, '789 Oak St, Villageton', 5.0, 30.00, 'res3.jpg', 'info@restaurantthree.com'),
(4, 'Restaurant Four', 4, '101 Pine St, Hamletown', 4.2, 35.00, 'res4.jpg', 'info@restaurantfour.com'),
(5, 'Restaurant Five', 5, '202 Maple St, Boroughville', 4.7, 40.00, 'res5.jpg', 'info@restaurantfive.com'),
(6, 'Restaurant Six', 6, '303 Cedar St, Township', 3.5, 22.00, 'res6.jpg', 'info@restaurantsix.com'),
(7, 'Restaurant Seven', 7, '404 Birch St, Townburg', 4.0, 28.00, 'res7.jpg', 'info@restaurantseven.com'),
(8, 'Restaurant Eight', 8, '505 Walnut St, Citytown', 4.9, 45.00, 'res8.jpg', 'info@restauranteight.com'),
(9, 'Restaurant Nine', 9, '606 Oak St, Hamletville', 4.1, 32.00, 'res9.jpg', 'info@restaurantnine.com'),
(10, 'Restaurant Ten', 10, '707 Pine St, Villageton', 4.6, 38.00, 'res10.jpg', 'info@restaurantten.com');

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
(30, 10, 4.6, 'Lovely ambiance, perfect for a date.', 10);

INSERT INTO `tbl_comida_restaurante` (`id_comida_restaurante`, `id_comida`, `id_resturante`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 32, 1),
(4, 2, 2),
(5, 5, 2),
(6, 31, 2),
(7, 4, 3),
(8, 12, 3),
(9, 19, 3),
(10, 6, 4),
(11, 7, 4),
(12, 30, 4),
(13, 8, 5),
(14, 9, 5),
(15, 28, 5),
(16, 10, 6),
(17, 18, 6),
(18, 34, 6),
(19, 11, 7),
(20, 13, 7),
(21, 33, 7),
(22, 14, 8),
(23, 15, 8),
(24, 16, 8),
(25, 17, 9),
(26, 20, 9),
(27, 35, 9),
(28, 21, 10),
(29, 22, 10),
(30, 23, 10);

