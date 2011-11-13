<?php
// Path information, EXTREMELY IMPORTANT that you do these right or this will not work.
define(SITE_URL,"http://"); // COMPLETE url to your web site, NO TRAILING SLASH!
define(SYS_PATH,"/services?p=21"); // Path to the directory this file is in, beginning with a slash.
define(NOTIFY_URL,""); // 

// Currency information.
define(CURRENCY_CODE,"EUR"); // Currency code to be used by PayPal.
define(CURRENCY_CHAR,"$"); // Symbol representing your currency code.

// PayPal information. Use 'www.sandbox.paypal.com' if you wish to test with the sandbox.
define(PAYPAL_URL,"www.paypal.com"); // Only change this for sandbox testing.
define(PAYPAL_EMAIL,"@.com"); // The account that donations will go to.

// Mail information.
define(MAIL_SUBJECT,"Sistema PP"); // Subject of the reward mail.
define(MAIL_BODY,"Envio! ID:{$_POST['txn_id']}"); // Mail message.

//Misc
define(ACP_USERNAME,""); // Username to access the ACP
define(ACP_PASSWORD,""); // Password to access the ACP
?>
