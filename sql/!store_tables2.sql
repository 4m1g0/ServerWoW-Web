-- Realmd database

DROP TABLE IF EXISTS `account_buyout`;
CREATE TABLE `account_buyout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `time_date` int(11) NOT NULL,
  `service_type` int(11) NOT NULL,
  `guid` int(11) NOT NULL,
  `realm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `account_buyout` VALUES (1, 1, 999001, 1, 5, 1321723881, 2, 0, 0);
INSERT INTO `account_buyout` VALUES (2, 1, 999001, 1, 5, 1321724015, 2, 1, 0);
INSERT INTO `account_buyout` VALUES (3, 1, 999002, 1, 5, 1321724131, 3, 2, 1);
INSERT INTO `account_buyout` VALUES (4, 1, 32458, 1, 650, 1321724222, 0, 1, 1);
INSERT INTO `account_buyout` VALUES (5, 1, 32458, 1, 650, 1321724455, 0, 1, 1);
INSERT INTO `account_buyout` VALUES (6, 1, 32458, 1, 650, 1321724540, 0, 2, 1);