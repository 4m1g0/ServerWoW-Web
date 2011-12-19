CREATE TABLE `wow_lag_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(16) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `timers` text NOT NULL,
  `date_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;