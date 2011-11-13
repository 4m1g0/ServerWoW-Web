<?php
function sha_game($user,$pass)
{
	$user = strtoupper($user);
	$pass = strtoupper($pass);
	return SHA1($user.':'.$pass);
}
function sha_forum($sha_game)
{
	return SHA1('ª'.$sha_game);
}
function genera_random($longitud)
{
	$exp_reg="[^A-Z0-9]";  
	return substr(eregi_replace($exp_reg, "", md5(rand())) .  
	eregi_replace($exp_reg, "", md5(rand())) .  
	eregi_replace($exp_reg, "", md5(rand())),  0, $longitud);
}

function check_logins_by_ip()
{
      $query = mysql_query("SELECT `logins`, `last_login` FROM `failed_logins` WHERE `ip` = '".$_SERVER[REMOTE_ADDR]."'");
      if ($failed_login=mysql_fetch_array($query))
      {
	    if ($failed_login['logins']>2)
	    {
		  if (time()-$failed_login['last_login'] < 900)
			return 0;
		  else
			mysql_query("UPDATE `failed_logins` SET `logins` = 0 WHERE `ip`= '".$_SERVER[REMOTE_ADDR]."'");
	    }
      }
      else
      {
	    mysql_query("INSERT INTO `failed_logins` (`ip`, `logins`, `last_login`) VALUES ('".$_SERVER[REMOTE_ADDR]."', 0, ".time().")");
      }
      return 1;
}

function curPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on")
	{
		$pageURL .= "s";
	}
 
 	$pageURL .= "://";
 	
	if ($_SERVER["SERVER_PORT"] != "80")
	{
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER['SCRIPT_NAME'];
 	}
	else
	{
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER['SCRIPT_NAME'];
 	}
	
	return $pageURL;
}

function email($username, $accountPass, $email, $activateLink, $title, $host){
  global $from;
  $url = curPageURL();
  $subject = 'Activacion de cuenta - "'.$username.'"';
  
  $from = "registro@serverwow.com";
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=utf-8\r\n";
  $headers .= "X-Mailer: PHP's mail() Function\r\n";
  $headers .= "From: $from\r\n";
  
  $to = $email;
  
  $message = '
      <html>
      <head>
        <title>'.$title.'</title>
      </head>
      <body>
      <h2>Hola</h2>
<br>
<br>	  
       <b>Cuenta:</b> '.$username.'<br>
       <b>Password :</b> </strong>'.base64_decode($accountPass).'<br>
       <b>Email :</b> </strong>'.$email.'<br>
       <b>Realmlist :</b> </strong>set realmlist logon.serverwow.com<br><br>
       <b>Link de Activacion:</b><br> '.$activateLink.' <br><br><br>   
       <b>Por favor haga click en el link de activación para activar su cuenta.</b><br><br>  
       <b>Si el link no funciona copielo e introduzcalo en la barra web de su explorador.</b><br><br><br>  
	<b>Puedes Acceder a la Administracion de cuenta en '.$host.'servicios.php. <br><br><br> Todo el equipo de Server WoW, Te desea lo mejor, esperamos te diviertas siendo parte de esta gran familia.</b><br><br>

<br>
<b>Nache<br> 
<b>Director General.<br> 
<b>Server WoW Realms - 2008-2011.<br> 
      </p>
      </body>
      </html>';
  
  @mail("$to", "$subject", "$message", "$headers");
  return;
}
?>