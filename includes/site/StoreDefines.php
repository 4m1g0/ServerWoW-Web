<?php

// Path information, EXTREMELY IMPORTANT that you do these right or this will not work.
define('SITE_URL',"http://"); // COMPLETE url to your web site, NO TRAILING SLASH!
define('SYS_PATH',"/services?p=21"); // Path to the directory this file is in, beginning with a slash.
define('NOTIFY_URL',""); // 

// Currency information.
define('CURRENCY_CODE',"EUR"); // Currency code to be used by PayPal.
define('CURRENCY_CHAR',"$"); // Symbol representing your currency code.

// PayPal information. Use 'www.sandbox.paypal.com' if you wish to test with the sandbox.
define('PAYPAL_URL',"www.paypal.com"); // Only change this for sandbox testing.
define('PAYPAL_EMAIL',"@.com"); // The account that donations will go to.

// Mail information.
define('MAIL_SUBJECT',"Sistema PP"); // Subject of the reward mail.
define('MAIL_BODY',"Envio! ID: " . (isset($_POST['txn_id']) ? $_POST['txn_id'] : '')); // Mail message.

//Misc
define('ACP_USERNAME',""); // Username to access the ACP
define('ACP_PASSWORD',""); // Password to access the ACP

define('SERVICE_CUSTOMIZE_CHARACTER', 1);
define('SERVICE_CHANGE_FACTION', 2);
define('SERVICE_CHANGE_RACE', 3);
define('SERVICE_CHANGE_PASSWORD', 4);
define('SERVICE_CHARACTER_ACCOUNT_TRANSFER', 5);
define('SERVICE_RENAME_CHARACTER', 6);

$GLOBALS['_STORE_SERVICES'] = array(
	// array( SERVICE_ID, SERVICE_CAPTION )
	array(SERVICE_CUSTOMIZE_CHARACTER, 'Customize Character'),
	array(SERVICE_CHANGE_FACTION, 'Change Character Faction'),
	array(SERVICE_CHANGE_RACE, 'Change Character Race (without faction change)'),
	array(SERVICE_CHANGE_PASSWORD, 'Change Account Password'),
	array(SERVICE_CHARACTER_ACCOUNT_TRANSFER, 'Transfer Character to Account'),
	array(SERVICE_RENAME_CHARACTER, 'Rename Charactet')
);
?>