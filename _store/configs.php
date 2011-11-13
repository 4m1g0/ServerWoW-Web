<?php

include("services/lang/esES.php");

// SEO Para el Website
$website = Array(
 	'name' => " ",	    // web name
	'title' => "",	    // web name
	'custom_title' => "",	    // web name
	'address' => "http://",			// 'http://url/foldername/' or 'http://url/'
	'description' => "", // Descripcion de Sitio
	'keywords' => "", // General keywords, will appear all over the page
	'lang' => "es", // lang of the Website
	);

// SEO para el Foro en SUBDOMINIO
$foros_cfg = Array(
 	'name' => "",	    // web name
	'title' => "",	    // web name
	'custom_title' => "",	    // web name
	'address' => "http://",			// 'http://url/foldername/' or 'http://url/'
	'description' => "", // Descripcion de Sitio
	'keywords' => "", // General keywords, will appear all over the page
	'lang' => "es", // lang of the Website
	);

$web_db = Array(
	'addr' => "localhost:3306",	    // Ip del Servidor MySQL:Puerto
	'user' => "",			    // User Login MySQL
	'pass' => "",			    // PASS Login MySQL
	'name' => "",		    	// Realmlist DB
	);

//Configuracion del Tema
$template="cataclysm";        // cataclysm, navidad, halloween

// configuración de cache
$cache = Array(
	'timeout' => 10,
	);

// WoWHead
$wowhead=true;                  // WoWHead Parser?
$wowheadjs='<script src="http://es.wowhead.com/widgets/power.js" language="JavaScript"></script>';  // JS de ejecucion
$wowheadlink="http://es.wowhead.com/?item=";  // Parser para Items

// Reinos
$reinos = Array(
				"0" => array("1", "", "3.3.5a", "PvE"),
				"1" => array("2", "", "3.3.5a", "PvP"),
				"2" => array("3", "", "3.3.5a", "PvE"),
				"3" => array("4", "", "4.0.6a", "PvE"),
				);

$core_ver="3.3.5a"; //Soportado
$realmlist="logon.serverwow.com"; //realmlist

// Informacion del Administrador
$admin_wowlcv = Array(
  "" => array(                                     // Nombre Identificador
                        "1",                                // ID
                        "",                        // Nombre
                        "",                     // Pais
                        "",  // Cargo
                        "",     // Correo
                        ),
);

// Encoding
$encoding = "utf8";

$connection_setup = mysql_connect($web_db['addr'],$web_db['user'],$web_db['pass'])or die(mysql_error());
mysql_select_db($web_db['name'],$connection_setup)or die(mysql_error());
mysql_query("SET NAMES '$encoding'");

if(isset($_SESSION['username']) != "")
{
	$username = mysql_real_escape_string($_SESSION['username']);
	$lbrspa = mysql_query("SELECT * FROM users WHERE username = '".$username."'");
	$account_information = mysql_fetch_assoc($lbrspa);
	
	if ((time() - $account_information['last_login']) > 1200)
		$_SESSION['cp_login'] = FALSE;

	if ($account_information['banned'])
    {
		session_unset();
		session_destroy();
	}
}

// SEO Friendly URLs
function seoUrl($string)
{
	$string = str_replace(array('quot'), array(''), $string);
    $string = preg_replace('/&([a-z]{1,2})(?:acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i','\1', htmlentities($string, ENT_COMPAT, "UTF-8"));
    $string = preg_replace(array('/[^a-z0-9-]+/i', '`[-]+`'), '-', html_entity_decode($string, ENT_COMPAT, "UTF-8"));
    $string = preg_replace('/-+/', '-', $string);
    $string = strtolower(trim($string, '-'));
    $string = preg_replace('/-$/i', '', $string);
    $string = preg_replace('/^-/i', '', $string);

	return $string;
}

function check_if_spider()
{  
	// Add as many spiders you want in this array  
	$spiders = array(
		'/Googlebot/i', '/Google Desktop/i', '/AdsBot-Google/i', '/Feedfetcher-Google/i',
		'/Googlebot-Mobile/i', '/Mediapartners-Google/i', '/AppEngine-Google/i',
		'/Yahoo/i', '/Yahoo Slurp/i', '/Yahoo! Slurp/i', '/Slurp/i', '/msnbot/i',
		'/AltaVista/i', '/Scooter/i', '/alexa/i', '/Lycos/i', '/FAST-WebCrawler/i',
		'/Twitterbot/i', '/facebookexternalhit/i', '/W3C_*Validator/i', '/teoma/i'
	);

	// Loop through each spider and check if it appears in  
	// the User Agent  
	foreach ($spiders as $spider)  
	{  
		if (preg_match($spider, $_SERVER['HTTP_USER_AGENT'])){
			return TRUE;  
		}else{
			return FALSE;
		}
	}  
}

function IsLoggedIn2()
{
	return GetSessionInfo2('wow_serverwow_sid') != null;
}
	
function GetSessionInfo2($info)
{
	if(!isset($_SESSION[$info]))
	{
		return null;
	}
	return $_SESSION[$info];
}
?>