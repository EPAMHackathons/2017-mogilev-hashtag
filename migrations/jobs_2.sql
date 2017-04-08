  DROP TABLE IF EXISTS `job_types`;
  CREATE TABLE IF NOT EXISTS `job_types` (
    `id` int(11) NOT NULL,
    `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

  --
  -- Indexes for dumped tables
  --

  --
  -- Indexes for table `job_types`
  --
  ALTER TABLE `job_types`
    ADD PRIMARY KEY (`id`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `job_types`
  --
  ALTER TABLE `job_types`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


  ALTER TABLE `jobs` CHANGE `type` `type` INT(11) NOT NULL;