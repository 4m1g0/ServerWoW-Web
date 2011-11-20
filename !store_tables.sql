-- Realmd database

DROP TABLE IF EXISTS `account_points`;
CREATE TABLE `account_points` (
  `account_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `account_points` VALUES (1, 113);

DROP TABLE IF EXISTS `paypal_history`;
CREATE TABLE `paypal_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` int(11) NOT NULL,
  `payment_date` text NOT NULL,
  `verify_sign` text NOT NULL,
  `payer_email` text NOT NULL,
  `receiver_email` text NOT NULL,
  `payer_id` text NOT NULL,
  `receiver_id` text NOT NULL,
  `item_number` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `paypal_history` VALUES (1, 3, '07:10:37 Nov 19, 2011 PST', 'AWGiKcqyKO.kzJNpOZX3Mz5Jza9.AQ-FGnvMN2pLOKmCGkr2aWQVpDw1', 'd_mast_1321714370_per@ulanovka.ru', 'd_mas_1321699272_biz@ulanovka.ru', 'JVJLX4EDSYEVE', 'G5J7C6BCDNAZN', '23770e420498faec9e107685d4afd14e28f5fd85');
INSERT INTO `paypal_history` VALUES (2, 2, '07:12:19 Nov 19, 2011 PST', 'AbImOHbDvCPku4o8ujDcurMc8cZKAsAXuxpIZa7iazJ3D4wMRQyXt25r', 'd_mast_1321714370_per@ulanovka.ru', 'd_mas_1321699272_biz@ulanovka.ru', 'JVJLX4EDSYEVE', 'G5J7C6BCDNAZN', '7707c03cc731e0af2129de2754f75224855b994d');

DROP TABLE IF EXISTS `store_session`;
CREATE TABLE `store_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date_time` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `store_session` VALUES (1, '23770e420498faec9e107685d4afd14e28f5fd85', 35, 1321715398, 1);
INSERT INTO `store_session` VALUES (2, '7707c03cc731e0af2129de2754f75224855b994d', 78, 1321715521, 1);