ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `description` JSON NULL DEFAULT NULL AFTER `name`;

ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `slug` VARCHAR(20) NOT NULL AFTER `id`;

ALTER TABLE `laravel`.`diseases` 
ADD COLUMN `type` CHAR(1) NOT NULL AFTER `description`;

ALTER TABLE `laravel`.`allergies` 
ADD COLUMN `severity` INT NULL DEFAULT 0 AFTER `description`;

ALTER TABLE `laravel`.`diets` 
ADD COLUMN `type` INT NOT NULL AFTER `description`,
ADD COLUMN `amount` VARCHAR(10) NOT NULL AFTER `type`,
ADD COLUMN `brand` VARCHAR(20) NULL AFTER `amount`,
ADD COLUMN `information` VARCHAR(300) NULL AFTER `brand`,
CHANGE COLUMN `description` `description` VARCHAR(300) NULL ;

ALTER TABLE `laravel`.`walk_routines` 
ADD COLUMN `intensity` INT NULL DEFAULT 0 AFTER `time`,
ADD COLUMN `route` VARCHAR(300) NULL AFTER `description`;

ALTER TABLE `laravel`.`walk_routines` 
ADD COLUMN `duration` INT NULL AFTER `description`;