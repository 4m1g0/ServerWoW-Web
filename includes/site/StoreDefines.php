<?php

// Currency information.
define('CURRENCY_CODE',"EUR"); // Currency code to be used by PayPal.
define('CURRENCY_CHAR',"$"); // Symbol representing your currency code.

// PayPal information. Use 'www.sandbox.paypal.com' if you wish to test with the sandbox.
define('PAYPAL_URL',"sandbox.paypal.com"); // Only change this for sandbox testing. // Dead const?
define('PAYPAL_EMAIL',"d_mas_1321699272_biz@ulanovka.ru"); // The account that donations will go to.

define('PP_DESCRIPTION', 'World of Warcraft Services'); // Description for item_name POST field
define('POINT_PRICE', 0.5); // Price for one point (PayPal)

define('SERVICE_CUSTOMIZE_CHARACTER', 1);
define('SERVICE_CHANGE_FACTION', 2);
define('SERVICE_CHANGE_RACE', 3);
define('SERVICE_CHANGE_PASSWORD', 4);
define('SERVICE_CHARACTER_CHANGE_GENDER', 5);
define('SERVICE_RENAME_CHARACTER', 6);
define('SERVICE_POWERLEVEL', 7);

define('STORE_POWERLEVEL_MAX', 80); // Max level user can reach with bought levels

// Constants for mail_external.subject and mail_external.message fields
// You can use some placeholders ($B, $N, etc.)
define('STORE_MAIL_SUBJECT', 'World of Warcraft Store');
define('STORE_MAIL_MESSAGE', '$N,$B this mail contains the item you bought.$B$BThank you for using our online store!');

define('STORE_SMS_POINTS', 100); // Points per one activated SMS code

$GLOBALS['_STORE_SERVICES'] = array(
	// array( SERVICE_ID, SERVICE_CAPTION )
	array(SERVICE_CUSTOMIZE_CHARACTER, 'Customize Character'),
	array(SERVICE_CHANGE_FACTION, 'Change Character Faction'),
	array(SERVICE_CHANGE_RACE, 'Change Character Race (without faction change)'),
	array(SERVICE_CHANGE_PASSWORD, 'Change Account Password'),
	array(SERVICE_CHARACTER_CHANGE_GENDER, 'Change Character Gender'),
	array(SERVICE_RENAME_CHARACTER, 'Rename Character'),
	array(SERVICE_POWERLEVEL, 'Buy Levels')
);
?>