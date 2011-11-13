/* 
	This is Executed in Every Characters Database
*/

create table `mail_external` (
	`id` int (20),
	`acct` bigint (20),
	`receiver` bigint (20),
	`subject` varchar (600),
	`message` varchar (1500),
	`money` bigint (20),
	`item` bigint (20),
	`item_count` bigint (20),
	`date` date ,
	`sent` tinyint (4)
); 