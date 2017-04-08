ALTER TABLE `servers` ADD `active` TINYINT(1) NOT NULL DEFAULT '1' AFTER `ip`;
ALTER TABLE `servers_credentials` ADD `active` TINYINT(1) NOT NULL DEFAULT '1' AFTER `id`;