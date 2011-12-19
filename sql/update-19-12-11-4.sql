CREATE TABLE `wow_private_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `send_date` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `read` smallint(1) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `sender_id` (`sender_id`,`receiver_id`,`send_date`),
  KEY `read` (`read`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;