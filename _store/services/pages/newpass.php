<?php
if(!$_SESSION['cp_login']) exit();
error_reporting(0);
if (isset($_POST['old'])&& isset($_POST['new'])&& isset($_POST['new2']))
{
	require_once("services/include/recaptchalib.php");
	//Llaves de la captcha
	$captcha_publickey = "6Len4MQSAAAAAPfimIQbu9ySzmIYadaa0lPT5AOh";
	$captcha_privatekey = "6Len4MQSAAAAAIcRIRhaEchnn6mBXWIkDq56bWSE";
	//por ahora ponemos a null el error de la captcha
	$error_captcha = NULL;
		
	$captcha_respuesta = recaptcha_check_answer($captcha_privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	
	if ($captcha_respuesta->is_valid)
	{
		include "services/include/login_functions.php";
	
		$old_pass = stripslashes($_POST['old']);
		$new_pass = stripslashes($_POST['new']);
		$new_pass_ = stripslashes($_POST['new2']);
		$user = stripslashes($account_information['username']);
    
		switchConnection(1,"realmd");
		$game_pass = sha_game($user,$old_pass);
		$result = dbquery("SELECT `id` FROM account WHERE id='".$game_information['id']."' AND sha_pass_hash='$game_pass'");
	
		if (dbrows($result) != 0)
		{
			if(strlen($new_pass) >= 6)
			{
				if($new_pass == $new_pass_)
				{
				    // Generamos pass
					$game_pass = sha_game($user,$new_pass);
					$web_pass = sha_forum($game_pass);
				
					// Cambiamos pass del game
					dbquery("UPDATE account SET sha_pass_hash='$game_pass',v=0, s=0 WHERE id='".$game_information['id']."' limit 1");
				
					// Guardamos el cambio en el historial del game
					$value="Cambio de Contraseña.";
					history($value,$game_information['id']);
				
					// Cerramos la conexion con el game y cambiamos la pass de la web
					switchConnection(1,"web_db");
					dbquery("UPDATE users SET sha_forum_hash='$web_pass' WHERE id='".$account_information['id']."' limit 1");
				
					// Guardamos el cambio en el historial del foro
					history($value,$account_information['id']);
					// Cerramos la conexion que al final del script será devuelta a la web
					mysql_close();

					?>
	                  <center>
    	              <h3><font color="green">Modificando contraseña de su cuenta</font></h3><br />
        	          <div class="loader"></div>
            	      <font color="aqua">Correcto.</font>
                	  <meta http-equiv="refresh" content="3;url=services.php"/></center>
	             <?php
				}
				else 
				{
				      ?><center>
    	              <h3><font color="red">ERROR</font></h3><br />
        	          <div class="loader"></div>
            	      <font color="aqua">Las contraseñas no coinciden.</font>
                	  <meta http-equiv="refresh" content="3"/></center>
	                  <?php
				}
			}
			else
			{
			    ?><center>
            	<h3><font color="red">ERROR</font></h3><br />
	            <div class="loader"></div>
    	        <font color="aqua">La contraseña debe tener como minimo 6 caracteres alfanumericos.</font>
        	    <meta http-equiv="refresh" content="3"/></center>
            	<?php
			}
		}
		else
		{
		    ?><center>
        	<h3><font color="red">ERROR</font></h3><br />
	        <div class="loader"></div>
    	    <font color="aqua">Datos erróneos, intentalo de nuevo.</font>
	       	<meta http-equiv="refresh" content="3"/></center>
    	    <?php
		}
	}
	else
	{
	    ?><center>
       	<h3><font color="red">ERROR</font></h3><br />
        <div class="loader"></div>
   	    <font color="aqua">Codigo reCaptcha NO valido.</font>
       	<meta http-equiv="refresh" content="3"/></center>
   	    <?php
	}
	switchConnection(1,"web_db");	
}
else
{
	require_once("services/include/recaptchalib.php");
	//Llaves de la captcha
	$captcha_publickey = "6Len4MQSAAAAAPfimIQbu9ySzmIYadaa0lPT5AOh";
	$captcha_privatekey = "6Len4MQSAAAAAIcRIRhaEchnn6mBXWIkDq56bWSE";
	//por ahora ponemos a null el error de la captcha
	$error_captcha = NULL;
?>
    <div class="section-title">
    <span>Cambiar contraseña</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta página puedes modificar tu contraseña para el juego y la web, recuerda que una contraseña segura debe contener caracteres alfanuméricos y mayusculas y minusculas</p>
    </div>
	<p><form name="newpass" method="post">
	<div><br /><br /><br />
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl" align="center">
    <tr>
    <td align="right">Clave Actual:</td>
    <td><input name="old" type="password" class="registration" size="15" style="width: 165px;"></td>
    </tr>
    <tr>
    <td align="right">Clave Nueva:</td>
    <td><input name="new" type="password" class="registration" size="15" style="width: 165px;"></td>
    </tr>
    <tr>
    <td align="right">Repetir Clave Nueva:</td>
    <td><input name="new2" type="password" class="registration" size="15" style="width: 165px;"></td>
    </tr>
    <tr>
      <td align="right"></td>
	  <td><? echo recaptcha_get_html($captcha_publickey, $error_captcha);?><br></td>
      </tr>
    <tr>
    <td colspan="2" align="center"><label>
    <input type="submit" class="button" value="Cambio de Clave" alt="Cambio de Clave" title="Cambio de Clave de Juego" >
    </label></td>
    </tr>
    </table>
    </div>
	</form></p>
	
<?php } ?>
