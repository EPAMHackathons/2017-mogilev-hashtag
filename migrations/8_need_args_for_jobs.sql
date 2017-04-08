ALTER TABLE `jobs` ADD `need_args` TINYINT(1) NOT NULL DEFAULT '0' AFTER `active`;
ALTER TABLE `jobs` ADD `telegegram_cmd` VARCHAR(255) NULL DEFAULT NULL AFTER `need_args`;