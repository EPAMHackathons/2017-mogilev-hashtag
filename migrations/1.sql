CREATE TABLE `admin_users` (
`id` int(111) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pwd` char(32) NOT NULL,
  `is_root` tinyint(1) NOT NULL,
  `permissions` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `login`, `pwd`, `is_root`, `permissions`, `active`) VALUES
(1, 'root', 'acf7ef943fdeb3cbfed8dd0d8f584731', 1, '', 1);