-- Realm
ALTER TABLE paypal_history ADD account_id INT(11) NOT NULL AFTER id;
ALTER TABLE paypal_history ADD gross INT(11) NOT NULL AFTER amount;
