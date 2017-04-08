ALTER TABLE `users_permissions` ADD `credential_id` INT(11) NOT NULL AFTER `server_id`;
ALTER TABLE `servers_jobs` CHANGE `script_id` `job_id` INT(10) UNSIGNED NOT NULL;

ALTER TABLE `servers_jobs` ADD UNIQUE( `server_id`, `job_id`);