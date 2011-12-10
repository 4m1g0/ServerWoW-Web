<?php

// Currency information.
define('CURRENCY_CODE',"EUR"); // Currency code to be used by PayPal.
define('CURRENCY_CHAR',"$"); // Symbol representing your currency code.

// PayPal information. Use 'www.sandbox.paypal.com' if you wish to test with the sandbox.
//define('PAYPAL_URL',"sandbox.paypal.com"); // Only change this for sandbox testing. // Dead const?
define('PAYPAL_URL',"www.paypal.com"); // Only change this for sandbox testing. // Dead const?
define('PAYPAL_EMAIL',"loscaballerosvengadores@live.com"); // The account that donations will go to.

define('PP_DESCRIPTION', 'World of Warcraft Services'); // Description for item_name POST field
define('POINT_PRICE', 1); // Price for one point (PayPal)

define('SERVICE_CUSTOMIZE_CHARACTER', 1);
define('SERVICE_CHANGE_FACTION', 2);
define('SERVICE_CHANGE_RACE', 3);
//define('SERVICE_CHANGE_PASSWORD', 4);
define('SERVICE_CHARACTER_CHANGE_GENDER', 5);
define('SERVICE_RENAME_CHARACTER', 6);
define('SERVICE_POWERLEVEL', 7);
define('SERVICE_GOLD', 8);

define('STORE_POWERLEVEL_MAX', 80); // Max level user can reach with bought levels

// Constants for mail_external.subject and mail_external.message fields
// You can use some placeholders ($B, $N, etc.)
define('STORE_MAIL_SUBJECT', 'Server WoW Tienda');
define('STORE_MAIL_MESSAGE', '$N,$B Este correo contiene el item que has seleccionado en la Tienda.$B$B Gracias por usar nuestra tienda En Linea!');

define('STORE_SMS_POINTS', 1); // Points per one activated SMS code

$GLOBALS['_STORE_SERVICES'] = array(
	// array( SERVICE_ID, SERVICE_CAPTION )
	array(SERVICE_CUSTOMIZE_CHARACTER, 'Customizar Personaje'),
	array(SERVICE_CHANGE_FACTION, 'Cambiar Faccion'),
	array(SERVICE_CHANGE_RACE, 'Camnbiar Raza'),
	//array(SERVICE_CHANGE_PASSWORD, 'Cambiar Contraseña'),
	array(SERVICE_CHARACTER_CHANGE_GENDER, 'Cambiar Genero'),
	array(SERVICE_RENAME_CHARACTER, 'Renombrar Personaje'),
	array(SERVICE_POWERLEVEL, 'Comprar niveles'),
	array(SERVICE_GOLD, 'Buy gold')
);
?>