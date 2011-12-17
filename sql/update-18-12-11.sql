ALTER TABLE  `wow_forum_category` ADD INDEX  `wfcat` (  `cat_id` );
ALTER TABLE  `wow_forum_posts` ADD INDEX  `wfp` (  `thread_id` );
ALTER TABLE  `wow_forum_threads` ADD INDEX  `wft` (  `cat_id` );