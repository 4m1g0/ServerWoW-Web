ALTER TABLE  `wow_news` ADD  `comments_count` INT NOT NULL ,
ADD  `allow_comments` SMALLINT( 1 ) DEFAULT  '1' NOT NULL ;
ALTER TABLE  `wow_blog_comments` ADD  `blizzard` SMALLINT( 1 ) NOT NULL ,
ADD  `mvp` SMALLINT( 1 ) NOT NULL ;
