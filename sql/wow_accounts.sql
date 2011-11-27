DROP TABLE IF EXISTS `wow_accounts`;
CREATE TABLE `wow_accounts` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `access_level` int(11) NOT NULL,
  `forums_name` varchar(64) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `wow_user_groups`;
CREATE TABLE `wow_user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(32) NOT NULL,
  `group_mask` int(11) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `wow_user_groups` VALUES (1, 'Admin', 11);
INSERT INTO `wow_user_groups` VALUES (2, 'Moderator', 6);
INSERT INTO `wow_user_groups` VALUES (3, 'MVP', 4);
INSERT INTO `wow_user_groups` VALUES (5, 'Bugtracker', 8);