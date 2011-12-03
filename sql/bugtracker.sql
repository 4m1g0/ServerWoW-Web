ALTER TABLE  `wow_bugtracker_items` ADD  `title` VARCHAR( 255 ) NOT NULL AFTER  `item_id` ;
ALTER TABLE  `wow_bugtracker_items` ADD  `admin_id` INT NOT NULL AFTER  `admin_response` ;
CREATE TABLE `wow_bugtracker_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;