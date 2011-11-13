/* 
	This is Executed in Realm Database
*/

/*Table structure for table `cp_admessage` */

CREATE TABLE `cp_admessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT '0',
  `realm` smallint(2) NOT NULL,
  `ac_id` int(11) NOT NULL,
  `bug` smallint(1) DEFAULT '0',
  `wowhead` varchar(255) NOT NULL,
  `screen` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `pay_type` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT '0',
  `ip` varchar(16) NOT NULL,
  `n_answer` varchar(20) NOT NULL DEFAULT 'NONE',
  `answer` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cp_cre` */

CREATE TABLE `cp_cre` (
  `acid` int(11) NOT NULL,
  `cre` int(11) NOT NULL DEFAULT '0',
  `cre_used` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `acid` (`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cp_creproblem` */

CREATE TABLE `cp_creproblem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT '0',
  `petition` smallint(2) NOT NULL,
  `ac_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(16) NOT NULL,
  `n_answer` varchar(20) NOT NULL DEFAULT 'NONE',
  `answer` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_history` */

CREATE TABLE `cp_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL,
  `sent_id` int(11) DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `com` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(16) NOT NULL,
  `usluga` varchar(15) DEFAULT NULL,
  `bns` int(11) NOT NULL,
  `realm` smallint(2) DEFAULT NULL,
  `char_name` varchar(25) DEFAULT NULL,
  `guid` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `estado` smallint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55005 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_icons` */

CREATE TABLE `cp_icons` (
  `id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Icon Identifier',
  `iconname` varchar(255) NOT NULL DEFAULT '' COMMENT 'Icon Name',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='Icon Names';

/*Table structure for table `cp_items` */

CREATE TABLE `cp_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `item` int(11) DEFAULT '0',
  `name` varchar(40) DEFAULT NULL,
  `description` varchar(40) DEFAULT NULL,
  `price` int(11) unsigned NOT NULL,
  `level` int(3) unsigned DEFAULT '1',
  `set` int(11) NOT NULL DEFAULT '0',
  `img` varchar(11) DEFAULT NULL,
  `value1` varchar(11) DEFAULT '--',
  `value2` varchar(11) DEFAULT '--',
  `value3` varchar(11) DEFAULT '--',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_items_pp` */

CREATE TABLE `cp_items_pp` (
  `entry` int(10) DEFAULT NULL,
  `name` varchar(96) DEFAULT NULL,
  `realm` int(10) DEFAULT NULL,
  `description` blob,
  `item1` int(10) DEFAULT NULL,
  `quantity1` tinyint(3) DEFAULT NULL,
  `item2` int(10) DEFAULT NULL,
  `quantity2` tinyint(3) DEFAULT NULL,
  `item3` int(10) DEFAULT NULL,
  `quantity3` tinyint(3) DEFAULT NULL,
  `gold` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cp_log_pp` */

CREATE TABLE `cp_log_pp` (
  `entry` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(32) DEFAULT NULL,
  `txn_id` varchar(32) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `amount` float unsigned DEFAULT NULL,
  `info` blob,
  `memo` blob,
  PRIMARY KEY (`entry`)
) ENGINE=InnoDB AUTO_INCREMENT=2526 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_news` */

CREATE TABLE `cp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `news` text NOT NULL,
  `name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cp_realms_pp` */

CREATE TABLE `cp_realms_pp` (
  `entry` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`entry`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_sendpass` */

CREATE TABLE `cp_sendpass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL,
  `pass` mediumtext,
  `code` varchar(255) DEFAULT NULL,
  `activ` smallint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38874 DEFAULT CHARSET=utf8;

/*Table structure for table `cp_set_item` */

CREATE TABLE `cp_set_item` (
  `id` int(10) NOT NULL,
  `item` int(10) NOT NULL DEFAULT '0',
  `img` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`,`item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cp_sms_log` */

CREATE TABLE `cp_sms_log` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `acid` int(6) NOT NULL,
  `codigo` varchar(64) DEFAULT NULL,
  `cel` int(18) DEFAULT '0',
  `system` varchar(12) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=316846 DEFAULT CHARSET=utf8;