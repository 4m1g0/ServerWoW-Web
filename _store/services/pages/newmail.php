<?php
if(!$_SESSION['cp_login']) exit();
?>
<div class="section-title">
    <span>Cambio de correo electr&oacute;nico</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta página puedes modificar tu email de contacto, recuerda que por seguridad debes autorizar esta acci&oacute;n mediante un correo de confirmaci&oacute;n.</p>
</div>
<?php
error_reporting(0);
if (isset($_POST['password'])&& isset($_POST['mail'])&& isset($_POST['newmail'])&& isset($_POST['renewmail']))
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
	    $newmail = strtolower(mysql_real_escape_string(stripslashes($_POST['newmail'])));
		$username = stripslashes($data['username']);
		$user_pass = stripslashes($_POST['password']);
    	$user_pass = sha_game($username,$user_pass);
	
	    switchConnection(1,"realmd");
		$result = dbquery("SELECT `id`, `email` FROM account WHERE username='".mysql_real_escape_string($username)."' AND sha_pass_hash='$user_pass'");

	  	if ($data=mysql_fetch_assoc($result))
		{
			if(strtolower($_POST['mail'])==strtolower($data['email']))
			{
				if(strlen($newmail) >= 5)
				{
					if($newmail==strtolower(mysql_real_escape_string($_POST['renewmail'])))
					{
						$user_code = genera_random(20);
				        $result = dbquery("INSERT INTO `cp_sent` (`acid`, `type`, `pass`, `code`)VALUES ('$data[id]', 2, '$newmail', '$user_code')");
					
						$user_code = base64_encode($user_code);
			        
				        if($result)
			        	{
				        	send_mail(''.$_SESSION['username'].'',''.$data['email'].'', $newmail, $user_code);
				        }
			        
						$value="Cambio de Correo.";
						history($value,$game_information['id']);
			
						echo'<h2>Cambio de Correo</h2>
						<p></p><div class="other_message">Tu nuevo correo ha sido actualizado</div>';
					}
					else
					{
						echo'<h2>Cambio de Correo</h2>
						<p></p><div class="other_message">Los correos no coinciden</div>';
					}
				}
				else
				{
					echo'<h2>Cambio de Correo</h2>
					<p></p><div class="other_message">El correo no es válido</div>';
				}
			}
			else
			{
				echo'<h2>Cambio de Correo</h2>
				<p></p><div class="other_message">Datos de Correo Invalidos</div>';
			}
		}		
		else
		{
			echo'<h2>Cambio de Correo</h2>
			<p></p><div class="other_message">Datos Incorrectos</div>';
		}
	}
	else
	{
		echo'<h2>Cambio de Correo</h2>
		<p></p><div class="other_message">Codigo reCaptcha Invalido</div>';
	}
}
else if (isset($_GET['code']))
{
	$code = base64_decode($_GET['code']);
	$code = mysql_real_escape_string(stripslashes($code));
	
    switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_sent WHERE code='$code' and type='2' and `activ`='0' limit 1");
	
	if (dbrows($result) != 0)
	{
		$data = dbarray($result);
		$new_mail = $data['code'];
		
		dbquery("UPDATE `cp_sent` SET `activ` = '1' WHERE `id` ='$data[id]' LIMIT 1 ");
		$resul = dbquery("UPDATE `account` SET `email` = '$new_mail' WHERE `id` ='$data[acid]' LIMIT 1 ");

		switchConnection(1,"web_db");
		dbquery("UPDATE users SET email='$new_mail' WHERE id='$data[acid]' limit 1");
		
		mysql_close();
                         
		if($resul)
		{
			echo'<h2>Cambio de Correo</h2>
			<p></p><div class="other_message">El cambio de email fue Correcto</div>';
		}
	}
	else
	{
		echo'<h2>Cambio de Correo</h2>
		<p></p><div class="other_message">La URL ha caducado.</div>';
	}

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
    <p><form name="newmail" method="post">
    <div><br /><br /><br />
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl" align="center">
	<tr>
	<td align="right">Clave de la Cuenta:</td>
	<td><input name="password" type="password" class="registration" size="15" style="width: 165px;"></td>
	</tr>
	<tr>
	<td align="right">Correo Actual:</td>
	<td><input name="mail" type="text" class="registration" size="15" style="width: 165px;"></td>
	</tr>
	<tr>
	<td align="right">Correo Nuevo:</td>
	<td><input name="newmail" type="text" class="registration" size="15" style="width: 165px;"></td>
	</tr>
	<tr>
	<td align="right">Repetir Correo Nuevo:</td>
	<td><input name="renewmail" type="text" class="registration" size="15" style="width: 165px;"></td>
	</tr>
    <tr>
    <td align="right"></td>
    <td><? echo recaptcha_get_html($captcha_publickey, $error_captcha);?><br></td>
    </tr>
	<tr>
	<td colspan="2" align="center"><label>
	<input type="submit" class="button" value="Cambiar Correo" alt="Cambiar Correo" title="Cambiar Correo">
	</label></td>
	</tr>
	</table>
	</div></form></p>
<?php } ?>
