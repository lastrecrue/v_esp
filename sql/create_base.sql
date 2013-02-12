SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `v_esp` ;
CREATE SCHEMA IF NOT EXISTS `v_esp` DEFAULT CHARACTER SET latin1 ;
USE `v_esp` ;

-- -----------------------------------------------------
-- Table `v_esp`.`commune`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`commune` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`commune` (
  `idcommune` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(45) NULL DEFAULT NULL ,
  `nom` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcommune`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`douare`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`douare` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`douare` (
  `iddouare` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(45) NULL DEFAULT NULL ,
  `nom` VARCHAR(45) NOT NULL ,
  `gps_alt` FLOAT NULL DEFAULT NULL ,
  `gps_lan` FLOAT NULL DEFAULT NULL ,
  `commune_idcommune` INT(11) NOT NULL ,
  PRIMARY KEY (`iddouare`, `commune_idcommune`) ,
  INDEX `fk_douare_commune1_idx` (`commune_idcommune` ASC) ,
  CONSTRAINT `fk_douare_commune1`
    FOREIGN KEY (`commune_idcommune` )
    REFERENCES `v_esp`.`commune` (`idcommune` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `v_esp`.`packtage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`packtage` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`packtage` (
  `idpacktage` INT NOT NULL ,
  PRIMARY KEY (`idpacktage`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `v_esp`.`expedition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`expedition` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`expedition` (
  `idexpedition` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(45) NOT NULL ,
  `date_init` DATE NOT NULL ,
  `date_reel` DATE NULL DEFAULT NULL ,
  `nb_famille` INT(11) NULL DEFAULT NULL ,
  `packtage_idpacktage` INT NOT NULL ,
  PRIMARY KEY (`idexpedition`) ,
  INDEX `fk_expedition_packtage1_idx` (`packtage_idpacktage` ASC) ,
  CONSTRAINT `fk_expedition_packtage1`
    FOREIGN KEY (`packtage_idpacktage` )
    REFERENCES `v_esp`.`packtage` (`idpacktage` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`expedition_has_douare`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`expedition_has_douare` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`expedition_has_douare` (
  `expedition_idexpedition` INT(11) NOT NULL ,
  `douare_iddouare` INT(11) NOT NULL ,
  `douare_commune_idcommune` INT(11) NOT NULL ,
  PRIMARY KEY (`expedition_idexpedition`, `douare_iddouare`, `douare_commune_idcommune`) ,
  INDEX `fk_expedition_has_douare_douare1_idx` (`douare_iddouare` ASC, `douare_commune_idcommune` ASC) ,
  INDEX `fk_expedition_has_douare_expedition1_idx` (`expedition_idexpedition` ASC) ,
  CONSTRAINT `fk_expedition_has_douare_expedition1`
    FOREIGN KEY (`expedition_idexpedition` )
    REFERENCES `v_esp`.`expedition` (`idexpedition` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_expedition_has_douare_douare1`
    FOREIGN KEY (`douare_iddouare` , `douare_commune_idcommune` )
    REFERENCES `v_esp`.`douare` (`iddouare` , `commune_idcommune` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`personne`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`personne` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`personne` (
  `idpersonne` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NOT NULL ,
  `prenom` VARCHAR(45) NULL DEFAULT NULL ,
  `date_naissance` DATE NULL DEFAULT NULL ,
  `adresse` VARCHAR(200) NULL DEFAULT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  `mail` VARCHAR(45) NULL DEFAULT NULL ,
  `commune_idcommune` INT(11) NOT NULL ,
  PRIMARY KEY (`idpersonne`) ,
  INDEX `fk_personne_commune1_idx` (`commune_idcommune` ASC) ,
  CONSTRAINT `fk_personne_commune1`
    FOREIGN KEY (`commune_idcommune` )
    REFERENCES `v_esp`.`commune` (`idcommune` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`type` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`type` (
  `idtype` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idtype`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`type_has_personne`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`type_has_personne` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`type_has_personne` (
  `type_idtype` INT(11) NOT NULL ,
  `personne_idpersonne` INT(11) NOT NULL ,
  `expedition_idexpedition` INT(11) NOT NULL ,
  PRIMARY KEY (`type_idtype`, `personne_idpersonne`) ,
  INDEX `fk_type_has_personne_personne1_idx` (`personne_idpersonne` ASC) ,
  INDEX `fk_type_has_personne_type_idx` (`type_idtype` ASC) ,
  INDEX `fk_type_has_personne_expedition1_idx` (`expedition_idexpedition` ASC) ,
  CONSTRAINT `fk_type_has_personne_type`
    FOREIGN KEY (`type_idtype` )
    REFERENCES `v_esp`.`type` (`idtype` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_type_has_personne_personne1`
    FOREIGN KEY (`personne_idpersonne` )
    REFERENCES `v_esp`.`personne` (`idpersonne` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_type_has_personne_expedition1`
    FOREIGN KEY (`expedition_idexpedition` )
    REFERENCES `v_esp`.`expedition` (`idexpedition` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `v_esp`.`produit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`produit` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`produit` (
  `idproduit` INT NOT NULL ,
  `label` VARCHAR(45) NOT NULL ,
  `nom` VARCHAR(45) NULL ,
  `unite_mesure` VARCHAR(45) NULL ,
  `quantite` INT NULL ,
  PRIMARY KEY (`idproduit`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `v_esp`.`packtage_has_produit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`packtage_has_produit` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`packtage_has_produit` (
  `packtage_idpacktage` INT NOT NULL ,
  `produit_idproduit` INT NOT NULL ,
  `nb_produit` INT NULL ,
  PRIMARY KEY (`packtage_idpacktage`, `produit_idproduit`) ,
  INDEX `fk_packtage_has_produit_produit1_idx` (`produit_idproduit` ASC) ,
  INDEX `fk_packtage_has_produit_packtage1_idx` (`packtage_idpacktage` ASC) ,
  CONSTRAINT `fk_packtage_has_produit_packtage1`
    FOREIGN KEY (`packtage_idpacktage` )
    REFERENCES `v_esp`.`packtage` (`idpacktage` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_packtage_has_produit_produit1`
    FOREIGN KEY (`produit_idproduit` )
    REFERENCES `v_esp`.`produit` (`idproduit` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `v_esp`.`multimedia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `v_esp`.`multimedia` ;

CREATE  TABLE IF NOT EXISTS `v_esp`.`multimedia` (
  `idmultimedia` INT NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(45) NULL ,
  `path` VARCHAR(200) NULL ,
  `type_idtype` INT(11) NOT NULL ,
  PRIMARY KEY (`idmultimedia`, `type_idtype`) ,
  INDEX `fk_multimedia_type1_idx` (`type_idtype` ASC) ,
  CONSTRAINT `fk_multimedia_type1`
    FOREIGN KEY (`type_idtype` )
    REFERENCES `v_esp`.`type` (`idtype` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `v_esp` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
