ALTER TABLE `users_permissions` ADD `server_id` INT(11) NOT NULL AFTER `job_id`;

ALTER TABLE `users_permissions` ADD UNIQUE( `user_id`, `job_id`, `server_id`);