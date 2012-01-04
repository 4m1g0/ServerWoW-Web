CREATE TABLE  `wow_changelog` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `revid` VARCHAR( 255 ) NOT NULL ,
 `fixid` VARCHAR( 255 ) NOT NULL ,
 `commiter` VARCHAR( 255 ) NOT NULL ,
 `description` TEXT NOT NULL ,
 `post_date` INT NOT NULL ,
PRIMARY KEY (  `id` )
);