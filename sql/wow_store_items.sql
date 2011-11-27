DROP TABLE IF EXISTS `wow_store_items`;
CREATE TABLE `wow_store_items` (
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `in_store` smallint(1) NOT NULL DEFAULT '1',
  `service_type` int(11) NOT NULL,
  `itemset_pieces` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `wow_store_items` VALUES (32458, 8, '', '', '', 650, 1, 0, '');
INSERT INTO `wow_store_items` VALUES (999000, 9, '', '', '', 5, 1, 1, '');
INSERT INTO `wow_store_items` VALUES (999001, 9, '', '', '', 5, 1, 2, '');
INSERT INTO `wow_store_items` VALUES (999002, 9, '', '', '', 5, 1, 3, '');
INSERT INTO `wow_store_items` VALUES (999003, 9, '', '', '', 5, 1, 4, '');
INSERT INTO `wow_store_items` VALUES (999004, 10, 'Custom Itemset #1', '', '', 20, 1, 0, '32871 32872');
INSERT INTO `wow_store_items` VALUES (9990045, 9, '', '', '', 5, 1, 6, '');
INSERT INTO `wow_store_items` VALUES (99900454, 9, '', '', '', 5, 1, 5, '');
INSERT INTO `wow_store_items` VALUES (9990094, 9, '', '', '', 5, 1, 7, '');