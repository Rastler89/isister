ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `description` JSON NULL DEFAULT NULL AFTER `name`;

ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `slug` VARCHAR(20) NOT NULL AFTER `id`;

ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `type` CHAR(1) NOT NULL AFTER `description`;

ALTER TABLE `laravel`.`allergies` 
ADD COLUMN `severity` INT NULL DEFAULT 0 AFTER `description`;