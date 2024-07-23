CREATE TABLE IF NOT EXISTS `Zoo`.`personel` (
  `idpersonel` INT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `email` VARCHAR(255) NULL,
  `mot_de_passe` VARCHAR(255) NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`idpersonel`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`habitat` (
  `idhabitat` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `description` LONGTEXT NULL,
  `commentaire` LONGTEXT NULL,
  PRIMARY KEY (`idhabitat`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`animal` (
  `idanimal` INT NOT NULL,
  `prenom` VARCHAR(45) NULL,
  `etat` LONGTEXT NULL,
  `description` LONGTEXT NULL,
  `mode_de_vie` VARCHAR(255) NULL,
  `information` LONGTEXT NULL,
  `habitat_idhabitat` INT NOT NULL,
  `race` VARCHAR(255) NULL,
  `image` TEXT NULL,
  PRIMARY KEY (`idanimal`),
  INDEX `fk_animal_habitat1_idx` (`habitat_idhabitat` ASC) ,
  CONSTRAINT `fk_animal_habitat1`
    FOREIGN KEY (`habitat_idhabitat`)
    REFERENCES `Zoo`.`habitat` (`idhabitat`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `Zoo`.`Rapport` (
  `idRapport` INT NULL AUTO_INCREMENT,
  `date` DATE NULL,
  `details` LONGTEXT NULL,
  `personel_idpersonel` INT NOT NULL,
  `animal_idanimal` INT NOT NULL,
  `etat` LONGTEXT NULL,
  `nourriture` VARCHAR(255) NULL,
  `grammage` DECIMAL(5,2) NULL,
  PRIMARY KEY (`idRapport`),
  INDEX `fk_Rapport_personel_idx` (`personel_idpersonel` ASC) ,
  INDEX `fk_Rapport_animal1_idx` (`animal_idanimal` ASC) ,
  CONSTRAINT `fk_Rapport_personel`
    FOREIGN KEY (`personel_idpersonel`)
    REFERENCES `Zoo`.`personel` (`idpersonel`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rapport_animal1`
    FOREIGN KEY (`animal_idanimal`)
    REFERENCES `Zoo`.`animal` (`idanimal`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `Zoo`.`image` (
  `idimage` INT NOT NULL AUTO_INCREMENT,
  `image_top` TEXT NULL,
  `image_slide` TEXT NULL,
  `image_présentation` TEXT NULL,
  `imagecol` VARCHAR(45) NULL,
  PRIMARY KEY (`idimage`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`service` (
  `idservice` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NULL,
  `description` LONGTEXT NULL,
  `idimage` TEXT NULL,
  `type` VARCHAR(255) NULL,
  PRIMARY KEY (`idservice`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`avis` (
  `idavis` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `description` LONGTEXT NULL,
  `verification` TINYINT NULL,
  PRIMARY KEY (`idavis`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`image_has_habitat` (
  `image_idimage` INT NOT NULL,
  `habitat_idhabitat` INT NOT NULL,
  PRIMARY KEY (`image_idimage`, `habitat_idhabitat`),
  INDEX `fk_image_has_habitat_habitat1_idx` (`habitat_idhabitat` ASC),
  INDEX `fk_image_has_habitat_image1_idx` (`image_idimage` ASC),
  CONSTRAINT `fk_image_has_habitat_image1`
    FOREIGN KEY (`image_idimage`)
    REFERENCES `Zoo`.`image` (`idimage`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_image_has_habitat_habitat1`
    FOREIGN KEY (`habitat_idhabitat`)
    REFERENCES `Zoo`.`habitat` (`idhabitat`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`image_has_animal` (
  `image_idimage` INT NOT NULL,
  `animal_idanimal` INT NOT NULL,
  PRIMARY KEY (`image_idimage`, `animal_idanimal`),
  INDEX `fk_image_has_animal_animal1_idx` (`animal_idanimal` ASC),
  INDEX `fk_image_has_animal_image1_idx` (`image_idimage` ASC),
  CONSTRAINT `fk_image_has_animal_image1`
    FOREIGN KEY (`image_idimage`)
    REFERENCES `Zoo`.`image` (`idimage`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_image_has_animal_animal1`
    FOREIGN KEY (`animal_idanimal`)
    REFERENCES `Zoo`.`animal` (`idanimal`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Zoo`.`nourriture` (
  `idnourriture` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `nourriture` VARCHAR(255) NOT NULL,
  `quantité` DECIMAL(5,2) NOT NULL,
  `animal_idanimal` INT NOT NULL,
  PRIMARY KEY (`idnourriture`),
  INDEX `fk_nourriture_animal1_idx` (`animal_idanimal` ASC),
  CONSTRAINT `fk_nourriture_animal1`
    FOREIGN KEY (`animal_idanimal`)
    REFERENCES `Zoo`.`animal` (`idanimal`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;