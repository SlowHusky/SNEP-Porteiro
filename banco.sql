CREATE TABLE IF NOT EXISTS `snep`.`rfid` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rfid` VARCHAR(150) NOT NULL,
  `grupo` VARCHAR(100) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`senha` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `senha` VARCHAR(21) NOT NULL,
  `usuario` VARCHAR(100) NOT NULL,
  `grupo` VARCHAR(100) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`tb_porteiro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(31) NOT NULL,
  `transporte` VARCHAR(12) NOT NULL,
  `mac` VARCHAR(31) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `rele1` VARCHAR(20) NOT NULL,
  `rele2` VARCHAR(20) NOT NULL,
  `cadastro` VARCHAR(50) NOT NULL,
  `atualizado` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `snep`.`tb_grupos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grupo` VARCHAR(100) NOT NULL,
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
