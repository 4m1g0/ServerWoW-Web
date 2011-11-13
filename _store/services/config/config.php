<?php

$realm_db = Array(
	'addr' => "0.0.0.0:3306",	    // Ip del Servidor MySQL:Puerto
	'user' => "",			    // User Login MySQL
	'pass' => "",			    // PASS Login MySQL
	'name' => "",		    	// Realmlist DB
	);

$world_db = Array(
	"" => array(				// Nombre Identificador
			"1",					// Realm ID
			"",			        // SQL server login this DB located on
			"",		        // SQL server pass this DB located on
			"0.0.0.0:3306",	    // SQL server IP:port this DB located on
			"",			    // World Database name
   	  		"0.0.0.0:8085" 	    // IP y Puerto de Servidor
			),
	"" => array(		        // Nombre Identificador
			"2",				    // Realm ID
			"",			        // SQL server login this DB located on
			"",			    // SQL server pass this DB located on
			"0.0.0.0:3306",	    // SQL server IP:port this DB located on
			"",		      	// World Database name
      		"0.0.0.0:8085"	 	// IP y Puerto de Servidor
			),
	"" => array(		        // Nombre Identificador
			"3",				    // Realm ID
			"",			        // SQL server login this DB located on
			"",			    // SQL server pass this DB located on
			"0.0.0.0:3306",	    // SQL server IP:port this DB located on
			"",		      	// World Database name
      		"0.0.0.0:8127"	 	// IP y Puerto de Servidor
			),	
);

$characters_db = Array(
  "" => array(				// Nombre Identificador
			"1",				    // Realm ID
			"",			        // SQL server login this DB located on
			"",			    // SQL server pass this DB located on
			"0.0.0.0:3306",     	// SQL server IP:port this DB located on
			"",		   			// Characters Database name
			),
  "" => array(		        // Nombre Identificador
			"2",				    // Realm ID
			"",		            // SQL server login this DB located on
			"",		        // SQL server pass this DB located on
			"0.0.0.0:3306",     	// SQL server IP:port this DB located on
			"",					// Characters Database name
			),
  "" => array(		        // Nombre Identificador
			"3",				    // Realm ID
			"",		            // SQL server login this DB located on
			"",		        // SQL server pass this DB located on
			"0.0.0.0:3306",     	// SQL server IP:port this DB located on
			"",					// Characters Database name
			),
);

// URL
$cp_url = "http://";
// PROMO SMS
$promo = 0;
// Configuracion de Correo
$email_body_sendmail='<p>Hola [USERNAME]</p>
<p>[MESSAGE]</p>
<p>IP: [REMOTE_ADDR]</p>
<p>[SITE_URL]</p>';

// Configuracion de Correo
$email_subject_sendpass="Recuperacion de Contraseña"; // Asunto del Correo para recuperacion de PASS
// Body
$email_body_sendpass='<p>Hola,  [USERNAME]</p>
<p>Fecha: [DATE] desde IP: [REMOTE_ADDR]</p>
<p>Recuperacion de Contraseña, Acontinuacion Encontraras tu Nueva Clave</p>
<p><b>Clave Nueva: [USERPASS]</p></b>
<p><b> Activar Clave Nueva : <a href="'.$cp_url.'recover_pass.php?code=[USERCODE]">Activar</a></p></b>
<p></p>
<p>Cordialmente</p>
<p>Administracion WoW LCV</p>
<p></p>
<p>Ir a la Web Oficial - <a href="[SITE_URL]">Ir</a></p>';

// Configuracion de Correo
$email_subject_changemail="Cambio de correo";

$email_body_changepass='<p>Hola,  [USERNAME]</p>
<p>Fecha: [DATE] desde IP: [REMOTE_ADDR]</p>
<p>Se ha solicitado un cambio de email para tu cuenta que debes confirmar pulsando el link a continuación</p>
<p><b>Nueva dirección de correo: [USERMAIL]</p></b>
<p><b> Activar nuevo correo: <a href="'.$cp_url.'recover_pass.php?code=[USERCODE]">Activar</a></p></b>
<p></p>
<p>Cordialmente</p>
<p>Administracion WoW LCV</p>
<p></p>
<p>Ir a la Web Oficial - <a href="[SITE_URL]">Ir</a></p>';

///////////////////////////////////////

// Configuracion de Registro
$expansion=2;  // Expansion 0=> WOW 1=> TBC 2=> Wotlk
///////////////////////////////////////

// Utils
$repair_aurs_clean=true;  // Auras
$repair_groups_clean=true;  // Grupos
$repair_instance_clean=false;    // Instances
$repair_add_sicknes=true; // Añadir Sicknes?
$repair_tele_home=true;    // Regresar a Casa
/////////////////////////////

// Shop (Reward Prices)
$cre_reward = Array(
"rename" => array("10"),  // Cambiar Nombre
"sex" => array("10"),     // Cambiar Sexo
"race" => array("25"),    // Cambiar Raza
"facc" => array("30"),    // Cambiar Faccion
"cacc" => array("12"),    // Customizar Personaje
"acc" => array("10"),     // Cambiar de Cuenta
"proff" => array("25"),  		// Profesiones
"proff_sec" => array("20"),   	// Profesiones Sec
"gold" => array("0"),     // Oro
"lvl" => array("0"),      // Level
"gift" => array("0"),     // Regalos
"notuse" => array("50")   // Dejar En estado SIN USO
);
////////////////////////////////

// Funcion SIN USO
$notuse_month=4;  // Meses Disponibles
$notuse_after=10;  // Sin uso despues de?
$notuse_rate=Array(
  "10" => "2",       // Calcular el Presio del personaje en Lvl
  "20" => "2",
  "30" => "2",
  "40" => "2",
  "50" => "3",
  "60" => "4",
  "70" => "4.28",
  "80" => "6",
 );
//////////////////////////////

// Costo en Cre por cada 2 lvl
$lvlRate = array("1"=>.5,"2" =>.5, "3" =>.5);
// Two Side accounts Accept?
$CharactersTwoSide=false;
// Personajes por Cuenta
$CharactersPerAccount=10;
// Mail Sender
$mailsender = 1000;

include "services/include/functions.php";
if(isset($_SESSION['cp_login']))
{
    switchConnection(1,"realmd");
	$username = mysql_real_escape_string($_SESSION['username']);
	$lbrspa = mysql_query("SELECT `id`, `email`, `last_login`, `joindate`, `failed_logins`,  `online`, `expansion`, `locale` FROM `account` WHERE `username` = '".$username."'");
	$game_information = mysql_fetch_assoc($lbrspa);
	
	$lbrspa = mysql_query("SELECT `cre` FROM `cp_cre` WHERE `acid` = '".$game_information['id']."' LIMIT 1");
	$cre = mysql_fetch_assoc($lbrspa);
	if($game_information['cre']!=$cre['cre'])
	{
		$change_cre=1;
		$game_information['cre']=$cre['cre'];
	}
}
?>
