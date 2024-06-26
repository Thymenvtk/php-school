-- MySQL Script generated by MySQL Workbench
-- Wed Jun 19 09:17:13 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema school
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema school
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `school` DEFAULT CHARACTER SET utf8mb4 ;
USE `school` ;

-- -----------------------------------------------------
-- Table `school`.`CRUDusers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`CRUDusers` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `WW` VARCHAR(255) NULL DEFAULT NULL,
  `Age` DATE NULL DEFAULT NULL,
  `geslacht` VARCHAR(15) NULL DEFAULT NULL,
  `adres` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`userID`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `school`.`PHPform`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`PHPform` (
  `IDnummer` INT(11) NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(50) NULL DEFAULT NULL,
  `achternaam` VARCHAR(50) NULL DEFAULT NULL,
  `geboortedatum` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`IDnummer`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `school`.`opleiding`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`opleiding` (
  `opleidingscode` VARCHAR(3) NOT NULL,
  `naam` VARCHAR(30) NULL DEFAULT NULL,
  `niveau` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`opleidingscode`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `school`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`student` (
  `studentnr` VARCHAR(5) NOT NULL,
  `roepnaam` VARCHAR(10) NULL DEFAULT NULL,
  `voorletters` VARCHAR(10) NULL DEFAULT NULL,
  `tussenvoegsels` VARCHAR(8) NULL DEFAULT NULL,
  `achternaam` VARCHAR(25) NULL DEFAULT NULL,
  `adres` VARCHAR(25) NULL DEFAULT NULL,
  `postcode` VARCHAR(7) NULL DEFAULT NULL,
  `woonplaats` VARCHAR(25) NULL DEFAULT NULL,
  `geslacht` CHAR(20) NULL DEFAULT NULL,
  `telefoon` VARCHAR(11) NULL DEFAULT NULL,
  `geboortedatum` DATE NULL DEFAULT NULL,
  `uitgeschreven` DATE NULL DEFAULT NULL,
  `schoolgeld` DECIMAL(6,2) NULL DEFAULT NULL,
  `betaald` DECIMAL(6,2) NULL DEFAULT NULL,
  PRIMARY KEY (`studentnr`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `school`.`studentopleiding`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `school`.`studentopleiding` (
  `opleiding_opleidingscode` VARCHAR(3) NOT NULL,
  `student_studentnr` VARCHAR(5) NOT NULL,
  `startdatum` DATE NULL DEFAULT NULL,
  `einddatum` DATE NULL DEFAULT NULL,
  `diploma` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`opleiding_opleidingscode`, `student_studentnr`),
  INDEX `fk_opleiding_has_student_student_idx` (`student_studentnr` ASC) VISIBLE,
  INDEX `fk_opleiding_has_student_opleiding1_idx` (`opleiding_opleidingscode` ASC) VISIBLE,
  CONSTRAINT `fk_opleiding_has_student_opleiding1`
    FOREIGN KEY (`opleiding_opleidingscode`)
    REFERENCES `school`.`opleiding` (`opleidingscode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_opleiding_has_student_student`
    FOREIGN KEY (`student_studentnr`)
    REFERENCES `school`.`student` (`studentnr`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
