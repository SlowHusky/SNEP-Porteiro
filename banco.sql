CREATE TABLE IF NOT EXISTS `snep`.`senha` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `senha` VARCHAR(21) NOT NULL,
  `usuario` VARCHAR(100) NOT NULL,
  `grupo` VARCHAR(100) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`rfid` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rfid` VARCHAR(150) NOT NULL,
  `grupo` VARCHAR(100) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`tb_grupos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grupo` VARCHAR(100) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`tb_porteiro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(31) NOT NULL,
  `porta` VARCHAR(8) NOT NULL,
  `transporte` VARCHAR(12) NOT NULL,
  `mac` VARCHAR(31) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `rele1` VARCHAR(20) NOT NULL,
  `rele2` VARCHAR(20) NOT NULL,
  `ramal` VARCHAR(8) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`tb_porteirogrupos` (
  `porteiro` INT NOT NULL,
  `grupo` INT NOT NULL,
  INDEX `mac_idx` (`porteiro` ASC),
  INDEX `grupo_idx` (`grupo` ASC),
  CONSTRAINT `mac`
    FOREIGN KEY (`porteiro`)
    REFERENCES `snep`.`tb_porteiro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `grupo`
    FOREIGN KEY (`grupo`)
    REFERENCES `snep`.`tb_grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `snep`.`contador_senha` (
  `data` VARCHAR(45) NOT NULL,
  `porteiro` INT NOT NULL,
  `ramal` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(150) NOT NULL,
  `id_senha` INT NOT NULL,
  `resultado` VARCHAR(4) NOT NULL,
  INDEX `id_senha_idx` (`id_senha` ASC),
  INDEX `porteiro_idx` (`porteiro` ASC),
  CONSTRAINT `id_senha`
    FOREIGN KEY (`id_senha`)
    REFERENCES `snep`.`senha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `porteiro`
    FOREIGN KEY (`porteiro`)
    REFERENCES `snep`.`tb_porteiro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `snep`.`contador_rfid` (
  `data` VARCHAR(45) NOT NULL,
  `porteiro` INT NOT NULL,
  `ramal` VARCHAR(45) NOT NULL,
  `rfid` VARCHAR(150) NOT NULL,
  `id_rfid` INT NOT NULL,
  `resultado` VARCHAR(4) NOT NULL,
  INDEX `porteiro_idx` (`porteiro` ASC),
  INDEX `id_rfid_idx` (`id_rfid` ASC),
  CONSTRAINT `porteiro_id`
    FOREIGN KEY (`porteiro`)
    REFERENCES `snep`.`tb_porteiro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rfid_id`
    FOREIGN KEY (`id_rfid`)
    REFERENCES `snep`.`rfid` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
