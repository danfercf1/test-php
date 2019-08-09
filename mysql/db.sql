-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema phone_book
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `phone_book` ;

-- -----------------------------------------------------
-- Schema phone_book
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `phone_book` DEFAULT CHARACTER SET latin1 ;
USE `phone_book` ;

-- -----------------------------------------------------
-- Table `phone_book`.`contacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phone_book`.`contacts` ;

CREATE TABLE IF NOT EXISTS `phone_book`.`contacts` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `first_name` CHAR(255) NULL DEFAULT NULL,
  `sur_name` CHAR(255) NULL DEFAULT NULL,
  `photo` VARCHAR(500) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id` (`id` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `phone_book`.`information`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phone_book`.`information` ;

CREATE TABLE IF NOT EXISTS `phone_book`.`information` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` CHAR(255) NULL DEFAULT NULL,
  `phone_number` CHAR(50) NULL DEFAULT NULL,
  `contact_id` BIGINT(20) NOT NULL,
  UNIQUE INDEX `id` (`id` ASC),
  INDEX `Table_3_contact_idx` (`contact_id` ASC),
  CONSTRAINT `Table_3_contact`
  FOREIGN KEY (`contact_id`)
  REFERENCES `phone_book`.`contacts` (`id`))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
