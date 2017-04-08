ALTER TABLE `admin_users` ADD PRIMARY KEY(`id`);
ALTER TABLE `admin_users` CHANGE `id` `id` INT(111) NOT NULL AUTO_INCREMENT;
ALTER TABLE `admin_users` ADD INDEX(`login`);
ALTER TABLE `admin_users` ADD INDEX(`active`);
UPDATE `telehelp`.`admin_users` SET `pwd` = '7bcb7bdedb320d2b4373db1bcbdec487' WHERE `admin_users`.`id` = 1;

ALTER TABLE `user` ADD `active` TINYINT(1) NOT NULL AFTER `updated_at`;
ALTER TABLE `user` CHANGE `active` `active` TINYINT(1) NOT NULL DEFAULT '0';