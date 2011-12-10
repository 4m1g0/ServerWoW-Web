-- this update is for `wow` database

CREATE TABLE  `contents` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `url` VARCHAR( 255 ) NOT NULL ,
 `data` TEXT NOT NULL ,
 `locale` VARCHAR( 4 ) NOT NULL ,
 `editInfo` TEXT NOT NULL ,
 `access` TEXT NOT NULL ,
PRIMARY KEY (  `id` )
);