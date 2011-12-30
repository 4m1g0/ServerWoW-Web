ALTER TABLE  `wow_private_messages` ADD  `sender_guid` INT NOT NULL ,
ADD  `sender_realmId` INT NOT NULL ,
ADD  `receiver_guid` INT NOT NULL ,
ADD  `receiver_realmId` INT NOT NULL ;
TRUNCATE TABLE  `wow_private_messages`;