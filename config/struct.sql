CREATE SCHEMA IF NOT EXISTS `ddb_camagru` DEFAULT CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `ddb_camagru`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `salt` VARCHAR(18) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `birthdate` DATE NOT NULL,
  `notification` BOOLEAN NOT NULL DEFAULT '1',
  `tokenValidated` VARCHAR(100) NULL,
  `tokenLost` VARCHAR(100) NULL, 
  `dateCreated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `pseudo_UNIQUE` (`pseudo` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));

CREATE TABLE IF NOT EXISTS `ddb_camagru`.`selfie` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT UNSIGNED NOT NULL,
  `src` VARCHAR(100) NOT NULL,
  `dateCreated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `id_user`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`src` ASC));

CREATE TABLE IF NOT EXISTS `ddb_camagru`.`comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` VARCHAR(1000) NOT NULL,
  `id_selfie` INT UNSIGNED NOT NULL,
  `id_user` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `id_selfie`, `id_user`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE IF NOT EXISTS `ddb_camagru`.`likes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT UNSIGNED NOT NULL,
  `id_selfie` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `id_user`, `id_selfie`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));